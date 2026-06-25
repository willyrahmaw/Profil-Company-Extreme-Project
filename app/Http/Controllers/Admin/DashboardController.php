<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
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

        // Recent data
        $latestProducts = Product::orderBy('created_at', 'desc')->paginate(5, ['*'], 'products_page')->withQueryString();
        $latestShops    = Shop::orderBy('created_at', 'desc')->take(4)->get();

        return view('admin.dashboard', compact(
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
        ));
    }
}
