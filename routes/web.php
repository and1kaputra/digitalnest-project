<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\ReviewController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/category/{category}', [FrontController::class, 'category'])->name('front.category');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout/{product:slug}', [CheckoutController::class, 'checkout'])->name('front.checkout');
    Route::post('/checkout/store/{product:slug}', [CheckoutController::class, 'store'])->name('front.checkout.store');

    Route::middleware('role:admin')->group(function () {
        Route::prefix('superadmin')->name('creator.')->group(function(){
            Route::get('/dashboard', [FrontController::class, 'index'])->name('superadmin.dashboard');
            Route::resource("categories", CategoryController::class);
        });
    });

    Route::prefix('creator')->name('creator.')->group(function(){
        Route::resource('products', ProductController::class);
        Route::resource('product_orders', ProductOrderController::class);

        Route::get('/transactions', [ProductOrderController::class, 'transactions'])->name('product_orders.transactions');
        Route::get('/transactions/details/{productOrder}', [ProductOrderController::class, 'transactions_details'])->name('product_orders.transactions.details');

        Route::get('/download/file/{productOrder}', [ProductOrderController::class, 'download_file'])->name('product_orders.download')->middleware('throttle:1,1');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::put('/declined/{productOrder}', [ProductOrderController::class, "declined"])->name('product_orders.declined');
        Route::post('/rating/{product}', [ProductController::class, "rating"])->name('review.rating');

    });
});

require __DIR__.'/auth.php';
