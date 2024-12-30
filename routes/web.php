<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/vendeur', function () {
    return view('vendeur.dashboard');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/orders', [OrderController::class, 'orderHistory'])->name('orders.history');
    Route::get('/allOrders', [OrderController::class, 'allOrder'])->name('orders.allOrder');
});

Route::prefix('vendor')->middleware(['auth'])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('vendor.products.index');
    Route::post('products', [ProductController::class, 'store'])->name('vendor.products.store');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('vendor.products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('vendor.products.destroy');
});