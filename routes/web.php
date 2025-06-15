<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', IsUser::class])->group(function () {
    // Route untuk user dashboard
    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');
    Route::get('/products/{produk}', [ProductController::class, 'show'])->name('products.show');

   
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process');
Route::get('/payment/{order}', [OrderController::class, 'showPayment'])->name('payment.show');

Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{order}/mark-prepared', [OrderController::class, 'markPrepared'])->name('orders.markPrepared');


});

Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    // Admin Dashboard - Menampilkan data dari controller
    Route::get('/', [OrderController::class, 'dashboard'])->name('admin.dashboard');

    // Produk (CRUD tanpa show)
    Route::resource('products', ProductController::class)->except(['show']);

    // Order list admin
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Detail order admin
    Route::get('/orders/{order}', [OrderController::class, 'showAdmin'])->name('orders.show');

    // Update status order admin
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard'); // Redirect ke halaman admin
    }

    return redirect()->route('user.dashboard'); // Redirect ke halaman user
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
