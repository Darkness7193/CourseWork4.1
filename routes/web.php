<?php

include(app_path().'/helpers/post_to_get_route.php');

use App\Http\Controllers\cruds\InnerMoveController;
use App\Http\Controllers\cruds\ProductController;
use App\Http\Controllers\cruds\PurchaseController;
use App\Http\Controllers\cruds\SaleController;
use App\Http\Controllers\cruds\StorageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\reports\TotalsByMonth;
use App\Http\Controllers\reports\TotalsByMoveType;
use Illuminate\Support\Facades\Route;

/**
 * @var string $post_to_get_route
 */




Route::middleware('auth')->group(function () use($post_to_get_route) {
    /*Home*/
    Route::get('', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])
        ->name('home');


    /*Cruds &| Catalogs*/
    Route::group(['namespace' => 'App\Http\Controllers\cruds'], function() {
        Route::get('product_moves/purchases_crud', [PurchaseController::class, 'index'])
            ->name('product_moves.purchases_crud');

        Route::get('product_moves/sales_crud', [SaleController::class, 'index'])
            ->name('product_moves.sales_crud');

        Route::get('product_moves/inner_moves_crud', [InnerMoveController::class, 'index'])
            ->name('product_moves.inner_moves_crud');

        Route::get('products/crud', [ProductController::class, 'index'])
            ->name('products.crud');

        Route::get('storages/crud', [StorageController::class, 'index'])
            ->name('storages.crud');
    });


    /*Reports*/
    Route::group(['namespace' => 'App\Http\Controllers\reports'], function() {
        Route::get('product_moves/totals_by_move_type', [TotalsByMoveType::class, 'index'])
            ->name('product_moves.totals_by_move_type');

        Route::get('product_moves/totals_by_month', [TotalsByMonth::class, 'index'])
            ->name('product_moves.totals_by_month');
    });


    /*Commands*/
    Route::post('post_to_get_route', $post_to_get_route)
        ->name('post_to_get_route');

    Route::group(['namespace' => 'App\Http\Controllers\TableViewCommands'], function() {
        Route::post('create_bulk', 'CreateBulk')
            ->name('create_bulk');

        Route::post('update_bulk', 'UpdateBulk')
            ->name('update_bulk');

        Route::post('delete_bulk', 'DeleteBulk')
            ->name('delete_bulk');

        Route::post('set_filter', 'SetFilter')
            ->name('set_filter');

        Route::post('set_order', 'SetOrder')
            ->name('set_order');
    });


    /*Profiles*/
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';
