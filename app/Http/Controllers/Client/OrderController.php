<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Show all orders for the logged-in user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.product')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('Client.orders.index', compact('orders'));
    }

    // Show details for a single order
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
                      ->with('items.product')
                      ->findOrFail($id);

        return view('Client.orders.show', compact('order'));
    }

    // Create a new order from the cart
    public function store(Request $request)
    {
        $cartItems = $request->input('cart'); // Example: array of ['product_id' => 1, 'quantity' => 2]

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        DB::transaction(function() use ($cartItems) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_amount' => 0, // Will calculate below
            ]);

            $total = 0;

            foreach ($cartItems as $item) {
                $product = Product::findOrFail($item['product_id']);
                $quantity = $item['quantity'];
                $price = $product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $total += $price * $quantity;
            }

            $order->update(['total_amount' => $total]);
        });

        return redirect()->route('client.orders.index')->with('success', 'Order placed successfully!');
    }
}
