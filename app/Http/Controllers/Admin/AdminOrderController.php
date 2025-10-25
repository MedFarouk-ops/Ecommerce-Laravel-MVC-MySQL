<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\WebsiteInfo;

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
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        
        return view('Admin.orders.index', compact('orders','websiteInfo'));
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        return view('admin.orders.show', compact('order','websiteInfo'));
    }

    /**
     * Show the form for editing (changing status, etc.)
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $websiteInfo = WebsiteInfo::first(); // Get the first (and only) website info record
        return view('admin.orders.edit', compact('order','websiteInfo'));
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
            $order = Order::with('items.product')->find($id);

            if (!$order) {
                return redirect()->route('admin.orders.index')
                    ->with('error', 'Order not found.');
            }

            $oldStatus = $order->status; // Save old status
            $newStatus = $request->status;

            $total = 0;

            if ($request->has('items') && is_array($request->items)) {
                foreach ($request->items as $itemId => $itemData) {
                    $orderItem = $order->items()->find($itemId);

                    if ($orderItem) {
                        $orderItem->quantity = $itemData['quantity'] ?? $orderItem->quantity;
                        $orderItem->price = $orderItem->product->price ?? $orderItem->price;
                        $orderItem->save();

                        $total += $orderItem->quantity * $orderItem->price;
                    }
                }
            }

            // Handle stock changes
            $this->handleStockChange($order, $oldStatus, $newStatus);

            // Update order total and status
            $order->total_amount = $total;
            $order->status = $newStatus;
            $order->save();

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            // Optional: log error
            \Log::error($e);

            return redirect()->route('admin.orders.index')
                ->with('error', 'Something went wrong while updating the order.');
        }
    }

    /**
     * Handle stock when order status changes.
     */
    private function handleStockChange(Order $order, string $oldStatus, string $newStatus)
    {
        if ($oldStatus !== 'completed' && $newStatus === 'completed') {
            // Reduce stock for completed orders
            $this->reduceProductStock($order);
        } elseif ($oldStatus === 'completed' && $newStatus !== 'completed') {
            // Restore stock if order changed from completed to something else
            $this->restoreProductStock($order);
        }
    }

    /**
     * Reduce stock for all products in the order.
     */
    private function reduceProductStock(Order $order)
    {
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock = max(0, $product->stock - $item->quantity);
                $product->save();
            }
        }
    }

    /**
     * Restore stock for all products in the order.
     */
    private function restoreProductStock(Order $order)
    {
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock += $item->quantity;
                $product->save();
            }
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

    // Search order by user name
    public function search(Request $request)
    {
        $query = $request->input('query');

        $orders = \App\Models\Order::with(['user', 'items.product'])
            ->where(function ($q) use ($query) {
                // Search in order fields
                $q->where('first_name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%")
                ->orWhere('phone', 'like', "%{$query}%");
            })
            ->orWhereHas('user', function ($q) use ($query) {
                // Search in related user
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%");
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // Preserve query in pagination links
        $orders->appends(['query' => $query]);

        return view('Admin.orders.index', compact('orders', 'query'));
    }

    

}
