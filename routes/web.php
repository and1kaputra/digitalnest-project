<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UsersController;
use App\Models\Product;
use App\Models\Tools;
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
Route::get('/list-product',[FrontController::class, 'list_product'])->name('front.list_product');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/suspend', [FrontController::class, "suspend"])->name('front.suspend');
Route::get('/sort', [FrontController::class, 'sort_product'])->name('front.sort_product');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/{user}', [ProfileController::class, 'update_photo_profile'])->name('profile.update_photo');

    Route::get('/checkout/{product:slug}', [CheckoutController::class, 'checkout'])->name('front.checkout');
    Route::post('/checkout/store/{product:slug}', [CheckoutController::class, 'store'])->name('front.checkout.store');


    Route::middleware('role:admin')->group(function () {
        Route::prefix('superadmin')->name('superadmin.')->group(function(){
            Route::resource("categories", CategoryController::class);
        });
        Route::prefix('superadmin')->name('superadmin.')->group(function(){
            Route::resource("tools", ToolController::class);
        });
        Route::prefix('superadmin')->name('superadmin.')->group(function(){
            Route::resource("users", UsersController::class);
            Route::get('/users/suspend/{user}', [UsersController::class, 'suspend'])->name('users.suspend');
            Route::get('/users/recovery/{user}', [UsersController::class, 'recovery'])->name('users.recovery');
        });
      
    });

    Route::middleware('role:user')->group(function () {
        Route::prefix('creator')->name('creator.')->group(function(){
            Route::resource('products', ProductController::class);
            Route::resource('product_orders', ProductOrderController::class);

            Route::get('/transactions', [ProductOrderController::class, 'transactions'])->name('product_orders.transactions');
            Route::get('/transactions/details/{productOrder}', [ProductOrderController::class, 'transactions_details'])->name('product_orders.transactions.details');

            Route::get('/download/file/{productOrder}', [ProductOrderController::class, 'download_file'])->name('product_orders.download')->middleware('throttle:1,1');

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::put('/declined/{productOrder}', [ProductOrderController::class, "declined"])->name('product_orders.declined');
            Route::post('/rating/{product}', [ProductController::class, "rating"])->name('review.rating');
            
            Route::get('/products/product-tools/{product}', [ProductController::class, "product_tools"])->name("product.tools");
            Route::post('/products/product-tools-store/{product}', [ProductController::class, "product_tool_store"])->name("product.tools_store");
            Route::delete('/products/product-tools-delete/{productTool}', [ProductController::class, "destroy_product_tool"])->name("product.tools_destroy");
        });
    });

});

require __DIR__.'/auth.php';
