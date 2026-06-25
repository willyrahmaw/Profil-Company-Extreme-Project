<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Auth\LoginController;
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
    return view('welcome', compact('products', 'shops'));
})->name('home');

// Admin Auth Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// Secure Admin Dashboard & CRUD Group
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::resource('products', ProductController::class);
    Route::resource('shops', ShopController::class);
});
