<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of all orders.
     */
    public function index()
    {
        // Get all orders with their related user and items
        $orders = \App\Models\Order::with(['user', 'items.product'])
            ->orderBy('updated_at', 'desc') // <-- use orderBy instead of latest()
            ->paginate(10); // you can use ->get() if you don’t need pagination

        return view('Admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing (changing status, etc.)
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the order (e.g. change status).
     */
   public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,completed',
            'items' => 'required|array',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            $order = Order::find($id);

            if (!$order) {
                return redirect()->route('admin.orders.index')
                    ->with('error', 'Order not found.');
            }

            // Update order status
            $order->status = $request->status;

            $total = 0;

            if ($request->has('items') && is_array($request->items)) {
                foreach ($request->items as $itemId => $itemData) {
                    $orderItem = $order->items()->find($itemId);

                    if ($orderItem) {
                        $orderItem->quantity = $itemData['quantity'] ?? $orderItem->quantity;
                        $orderItem->price = $orderItem->product->price ?? $orderItem->price; // price fixed
                        $orderItem->save();

                        $total += $orderItem->quantity * $orderItem->price;
                    }
                }
            }

            // Update total
            $order->total_amount = $total;
            $order->save();

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            // Log the error if needed: \Log::error($e);
            return redirect()->route('admin.orders.index')
                ->with('error', 'Something went wrong while updating the order.');
        }
    }
    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
