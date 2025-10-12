<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            ->take(10)
            ->get();
            
        // General Stats
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

        $stats = (array) $stats;

        // Revenue insights
        $revenueToday      = $this->getRevenueToday();
        $revenueYesterday  = $this->getRevenueYesterday();
        $revenueLast7Days  = $this->getRevenueLast7Days();
        $revenueLast28Days = $this->getRevenueLast28Days();
        $revenueThisMonth  = $this->getRevenueThisMonth();
        $revenueLastMonth  = $this->getRevenueLastMonth();
        $growthTodayVsYesterday = $this->calculateGrowthPercentage($revenueToday, $revenueYesterday);
        $growthThisMonthVsLastMonth = $this->calculateGrowthPercentage($revenueThisMonth, $revenueLastMonth);
        $outOfStock = $this->getOutOfStockProducts();
        $lowStock = $this->getLowStockProducts(); 

        // Top selling products
        $topSelling = $this->getTopSellingProducts();

        return view('Admin.dashboard', [
            'orders'           => $orders,
            'totalProducts'    => $stats['total_products'],
            'totalOrders'      => $stats['total_orders'],
            'totalRevenue'     => $stats['total_revenue'],
            'totalSales'       => $stats['total_sales'],
            'revenueToday'     => $revenueToday,
            'revenueYesterday' => $revenueYesterday,
            'revenueLast7Days' => $revenueLast7Days,
            'revenueLast28Days'=> $revenueLast28Days,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueLastMonth' => $revenueLastMonth,
            'topSelling'       => $topSelling,
            'growthTodayVsYesterday' => $growthTodayVsYesterday,
            'growthThisMonthVsLastMonth' => $growthThisMonthVsLastMonth,
            'outOfStock' => $outOfStock,
            'lowStock'   => $lowStock,
        ]);
    }

    public function showLogin()
    {
        return view('Admin.auth.login');
    }


    // Advanced Revenue Calcualtion
      //  Revenue Today
    private function getRevenueToday()
    {
        return DB::table('orders')
            ->where('status', 'completed')
            ->whereDate('created_at', Carbon::today())
            ->sum('total_amount');
    }

    //  Revenue Yesterday
    private function getRevenueYesterday()
    {
        return DB::table('orders')
            ->where('status', 'completed')
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('total_amount');
    }

    //  Revenue Last 7 Days (including today)
    private function getRevenueLast7Days()
    {
        return DB::table('orders')
            ->where('status', 'completed')
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
            ->sum('total_amount');
    }

    //  Revenue Last 28 Days (including today)
    private function getRevenueLast28Days()
    {
        return DB::table('orders')
            ->where('status', 'completed')
            ->whereBetween('created_at', [Carbon::now()->subDays(27), Carbon::now()])
            ->sum('total_amount');
    }

    //  Revenue This Month
    private function getRevenueThisMonth()
    {
        return DB::table('orders')
            ->where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');
    }

    //  Revenue Last Month
    private function getRevenueLastMonth()
    {
        $lastMonth = Carbon::now()->subMonth();

        return DB::table('orders')
            ->where('status', 'completed')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('total_amount');
    }

    //  Top Selling Products (paginated)
    private function getTopSellingProducts()
    {
        return DB::table('order_items AS oi')
            ->join('orders AS o', 'o.id', '=', 'oi.order_id')
            ->join('products AS p', 'p.id', '=', 'oi.product_id')
            ->select('p.id', 'p.name', DB::raw('SUM(oi.quantity) AS total_sold'))
            ->where('o.status', 'completed')
            ->groupBy('p.id', 'p.name')
            ->orderByDesc('total_sold')
            ->paginate(5);
    }

    // Calcualet Growth percentage
    private function calculateGrowthPercentage($current, $previous)
    {
        // Avoid division by zero
        if ($previous == 0) {
            // If there was no previous value but now there is a value, growth is infinite — we'll just return 100
            return $current > 0 ? 100 : 0;
        }

        // Calculate percentage difference
        $growth = (($current - $previous) / $previous) * 100;

        // Round for cleaner output
        return round($growth, 2);
    }

    // Products Out of Stock
    private function getOutOfStockProducts()
    {
        return DB::table('products')
            ->where('stock', 0)
            ->select('id', 'name', 'stock','photo1')
            ->orderBy('name')
            ->paginate(5);
    }

    // Products Low in Stock (less than 10)
    private function getLowStockProducts($threshold = 10)
    {
        return DB::table('products')
            ->where('stock', '<', $threshold)
            ->where('stock', '>', 0) // exclude already out of stock
            ->select('id', 'name', 'stock','photo1')
            ->orderBy('stock')
            ->paginate(5);
    }

}
