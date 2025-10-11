<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        // Empty constructor
    }

    // Show admin dashboard
    public function index()
    {
        $orders = \App\Models\Order::with(['user', 'items.product'])
            ->latest()
            ->take(10) // Show only latest 5 orders
            ->get();
            
            // Raw query for dashboard stats
                $stats = DB::selectOne("
                    SELECT 
                        (SELECT COUNT(*) FROM products) AS total_products,
                        (SELECT COUNT(*) FROM orders) AS total_orders,
                        (SELECT IFNULL(SUM(total_amount),0) FROM orders WHERE status = 'completed') AS total_revenue,
                        (SELECT IFNULL(SUM(oi.quantity),0)
                        FROM order_items oi
                        JOIN orders o ON o.id = oi.order_id
                        WHERE o.status = 'completed') AS total_sales
                ");

                // Cast object to array for Blade
                $stats = (array) $stats;

                return view('Admin.dashboard', [
                    'orders' => $orders,
                    'totalProducts' => $stats['total_products'],
                    'totalOrders' => $stats['total_orders'],
                    'totalRevenue' => $stats['total_revenue'],
                    'totalSales' => $stats['total_sales'],
                ]);
    }

    public function showLogin()
    {
        return view('Admin.auth.login');
    }
}
