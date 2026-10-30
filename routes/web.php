<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// HOME 
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// PRODUK 
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// CART 
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// CHECKOUT (WAJIB LOGIN) 
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('auth')->name('checkout.store');

// PESANAN SAYA / STATUS PESANAN (WAJIB LOGIN) 
Route::middleware('auth')->group(function () {
    Route::get('/pesanan-saya', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan-saya/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/pesanan-saya/{id}/bukti-bayar', [OrderController::class, 'uploadBukti'])->name('orders.uploadBukti');
});

// HAMPERS 
Route::get('/hampers', [HampersController::class, 'index'])->name('hampers.index');

// ULASAN 
Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

// SOCIAL & MARKETPLACE 
Route::prefix('social')->group(function () {
    Route::get('/whatsapp', [SocialController::class, 'whatsapp'])->name('social.whatsapp');
    Route::get('/instagram', [SocialController::class, 'instagram'])->name('social.instagram');
    Route::get('/facebook', [SocialController::class, 'facebook'])->name('social.facebook');
    Route::get('/youtube', [SocialController::class, 'youtube'])->name('social.youtube');
    Route::get('/tiktok', [SocialController::class, 'tiktok'])->name('social.tiktok');
    Route::get('/shopeefood', [SocialController::class, 'shopeefood'])->name('social.shopeefood');
    Route::get('/gofood', [SocialController::class, 'gofood'])->name('social.gofood');
    Route::get('/grabfood', [SocialController::class, 'grabfood'])->name('social.grabfood');
    Route::get('/links', [SocialController::class, 'links'])->name('social.links');
});

// DASHBOARD (REDIRECT KE HOME) 
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

// PROFILE (BAWAAN BREEZE)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// AUTH (BAWAAN BREEZE) 
require __DIR__.'/auth.php';

// AUTH (MANUAL) 
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    
    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    
    return back()->with('error', 'Email atau password salah!');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8'
    ]);
    
    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);
    
    auth()->login($user);
    
    return redirect('/');
});

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

// ADMIN (LOGIN & DASHBOARD TERPISAH DARI PELANGGAN) 
Route::prefix('admin')->name('admin.')->group(function () {

    // Login admin, guard 'admin', hanya bisa diakses kalau belum login sebagai admin
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');
    });

    // Area admin, wajib login sebagai admin (guard 'admin')
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Daftar pelanggan & riwayat pesanan mereka
        Route::get('/pelanggan', [AdminCustomerController::class, 'index'])->name('customers.index');
        Route::get('/pelanggan/{id}', [AdminCustomerController::class, 'show'])->name('customers.show');

        // Kelola pesanan
        Route::get('/pesanan', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/pesanan/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/pesanan/{id}', [AdminOrderController::class, 'update'])->name('orders.update');
        Route::patch('/pesanan/{id}/pembayaran', [AdminOrderController::class, 'updatePayment'])->name('orders.updatePayment');
        Route::delete('/pesanan/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

        // Kelola produk (foto, stok, harga, dll)
        Route::get('/produk', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/produk/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/produk', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/produk/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/produk/{id}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/produk/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

        // NOTIFICATIONS 
        Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/notifications', [App\Http\Controllers\CheckoutController::class, 'getNotifications'])->name('notifications.get');
        Route::post('/notifications/{id}/read', [App\Http\Controllers\CheckoutController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [App\Http\Controllers\CheckoutController::class, 'markAllAsRead'])->name('notifications.read-all');
    });
    });
});