<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Product metrics
        $totalProducts  = Product::count();
        $coilsCount     = Product::where('category', 'coil')->count();
        $cottonsCount   = Product::where('category', 'cotton')->count();
        $lowStockCount  = Product::where('stock', '<', 10)->count();
        $outOfStockCount = Product::where('stock', 0)->count();
        $totalStockValue = Product::selectRaw('SUM(price * stock) as total')->value('total') ?? 0;
        $totalStockUnits = Product::sum('stock');

        // Shop metrics
        $totalShops     = Shop::count();
        $activeShops    = Shop::where('is_active', true)->count();

        // Order Analytics
        $totalOrders     = Order::count();
        $totalRevenue    = Order::sum('total_price') ?? 0;
        $recentOrders    = Order::with('items')->orderBy('created_at', 'desc')->take(8)->get();
        $topProducts     = \App\Models\OrderItem::select('product_title', \Illuminate\Support\Facades\DB::raw('SUM(quantity) as total_qty'), \Illuminate\Support\Facades\DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy('product_title')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        // Recent data
        $latestProducts = Product::orderBy('created_at', 'desc')->paginate(5, ['*'], 'products_page')->withQueryString();
        $latestShops    = Shop::orderBy('created_at', 'desc')->take(4)->get();

        $now = now();
        $activeEvent = Event::where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $now);
            })
            ->first();

        return view('admin.dashboard', compact(
            'activeEvent',
            'totalProducts',
            'coilsCount',
            'cottonsCount',
            'lowStockCount',
            'outOfStockCount',
            'totalStockValue',
            'totalStockUnits',
            'totalShops',
            'activeShops',
            'latestProducts',
            'latestShops',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'topProducts',
        ));
    }
}
