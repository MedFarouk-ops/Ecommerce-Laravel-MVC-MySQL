<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the client's orders.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->simplePaginate(3); // Only 3 orders per page

        return view('client.cart.orders', compact('orders'));
    }


    /**
     * Show the form for creating a new resource (checkout form).
     */
    public function create()
    {
        return view('client.orders.create'); // your checkout page
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer.firstName' => 'required|string|max:255',
            'customer.lastName' => 'required|string|max:255',
            'customer.phone' => 'required|string|max:20',
            'customer.email' => 'nullable|email',
            'customer.address' => 'required|string',
            'customer.city' => 'required|string',
            'customer.postalCode' => 'nullable|string|max:10',
            'customer.notes' => 'nullable|string',
            'payment' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        $c = $validated['customer'];

        // Create the order (like Product::create)
        $order = Order::create([
            'user_id' => auth()->id(),
            'first_name' => $c['firstName'],
            'last_name' => $c['lastName'],
            'phone' => $c['phone'],
            'email' => $c['email'] ?? null,
            'address' => $c['address'],
            'city' => $c['city'],
            'postal_code' => $c['postalCode'] ?? null,
            'notes' => $c['notes'] ?? null,
            'payment_method' => $validated['payment'],
            'total_amount' => $validated['total'],
            'status' => 'pending',
        ]);

        // Create related items
        foreach ($validated['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Order placed successfully!']);
    }


    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $order = auth()->user()->orders()->with('items.product')->findOrFail($id);
        return view('client.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the order.
     * (Typically clients cannot edit orders after placing, so you may return 403)
     */
    public function edit(string $id)
    {
        abort(403, 'You cannot edit an order after placing it.');
    }

    /**
     * Update the specified order.
     * (Clients usually cannot update orders; admins can)
     */
    public function update(Request $request, string $id)
    {
        abort(403, 'You cannot update this order.');
    }

    /**
     * Remove the specified order.
     * (Clients may or may not be able to cancel; implement if needed)
     */
    public function destroy(string $id)
    {
        $order = auth()->user()->orders()->findOrFail($id);

        // Optional: allow cancellation only if status is pending
        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Cannot cancel this order.'], 403);
        }

        $order->delete();

        return response()->json(['message' => 'Order cancelled successfully.']);
    }
}
