<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\LearnGuideController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Event;
use App\Models\Product;
use App\Models\Shop;
use App\Support\LoginIpBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/banned', function (Request $request) {
    return view('security.banned', [
        'ban' => LoginIpBan::status($request),
    ]);
})->name('banned');
// Public Landing Page
Route::get('/', function () {
    $products = Product::orderBy('created_at', 'desc')->get();
    $shops = Shop::where('is_active', true)->orderBy('created_at', 'asc')->get();
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
    $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('created_at', 'desc')->get();
    return view('welcome', compact('products', 'shops', 'activeEvent', 'testimonials'));
})->name('home');

// Admin Auth Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/admin/logout', [LoginController::class, 'logout']);

// Secure Admin Dashboard & CRUD Group
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::resource('products', ProductController::class);
    Route::patch('/products/{product}/stock', [ProductController::class, 'updateStock'])->name('products.update-stock');
    Route::resource('shops', ShopController::class);
    Route::resource('events', EventController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('guides', LearnGuideController::class);
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('surveys', \App\Http\Controllers\Admin\SurveyController::class)->only(['index', 'show', 'destroy']);
});

// Public Survey / Quiz Research Routes
Route::get('/research', [\App\Http\Controllers\SurveyController::class, 'show'])->name('research.show');
Route::post('/research', [\App\Http\Controllers\SurveyController::class, 'store'])->name('research.store');

// Public Educational Guide Routes
Route::get('/learn', function () {
    $guides = \App\Models\LearnGuide::where('is_active', true)->orderBy('order_position', 'asc')->get();
    return view('learn', compact('guides'));
})->name('learn');

// Order Logging API Route
Route::post('/api/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('api.orders.store');

// SEO Robots.txt Route
Route::get('/robots.txt', function () {
    $sitemapUrl = url('/sitemap.xml');
    return response("User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /admin\nDisallow: /api/\n\nSitemap: {$sitemapUrl}", 200)
        ->header('Content-Type', 'text/plain');
});

// SEO Sitemap.xml Route
Route::get('/sitemap.xml', function () {
    $now = now()->toAtomString();
    $siteUrl = config('app.url');
    
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
    $xml .= '<url>';
    $xml .= '<loc>' . url('/') . '</loc>';
    $xml .= '<lastmod>' . $now . '</lastmod>';
    $xml .= '<changefreq>daily</changefreq>';
    $xml .= '<priority>1.0</priority>';
    $xml .= '</url>';
    
    $xml .= '<url>';
    $xml .= '<loc>' . url('/admin/login') . '</loc>';
    $xml .= '<lastmod>' . $now . '</lastmod>';
    $xml .= '<changefreq>monthly</changefreq>';
    $xml .= '<priority>0.3</priority>';
    $xml .= '</url>';
    
    $xml .= '</urlset>';
    
    return response($xml, 200)
        ->header('Content-Type', 'application/xml');
});


