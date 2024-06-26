<?php

include(app_path().'/helpers/post_to_get_route.php');

use App\Http\Controllers\cruds\InnerMoveController;
use App\Http\Controllers\cruds\ProductController;
use App\Http\Controllers\cruds\PurchaseController;
use App\Http\Controllers\cruds\SaleController;
use App\Http\Controllers\cruds\StorageController;
use App\Http\Controllers\cruds\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\reports\TotalsByMonth;
use App\Http\Controllers\reports\TotalsByMoveType;
use App\Http\Middleware\HasSiteAccess;
use Illuminate\Support\Facades\Route;

/**
 * @var string $post_to_get_route
 */




Route::group(['middleware' => ['auth', HasSiteAccess::class]], function () use($post_to_get_route) {
    /*Home*/
    Route::get('home', [HomeController::class, 'index'])
        ->name('home');
    Route::get('', [HomeController::class, 'index'])
        ->name('home');


    /*Info*/
    Route::get('hotkeys_info', fn() => view('pages.hotkeys_info'))
        ->name('hotkeys_info');

    Route::get('info', fn() => view('pages.info'))
        ->name('info');


    /*Cruds &| Catalogs*/
    Route::group(['namespace' => 'App\Http\Controllers\cruds'], function() {
        Route::get('product_moves/purchases/crud', [PurchaseController::class, 'index'])
            ->name('product_moves.purchases.crud');

        Route::get('product_moves/sales/crud', [SaleController::class, 'index'])
            ->name('product_moves.sales.crud');

        Route::get('product_moves/inner_moves/crud', [InnerMoveController::class, 'index'])
            ->name('product_moves.inner_moves.crud');

        Route::get('products/crud', [ProductController::class, 'index'])
            ->name('products.crud');

        Route::get('storages/crud', [StorageController::class, 'index'])
            ->name('storages.crud');

        Route::group(['middleware' => ['can:access user page']], function() {
            Route::get('users/crud', [UserController::class, 'index'])
                ->name('users.crud');
        });
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
        Route::post('save_crud', 'SaveCrud')
            ->name('save_crud');

        Route::post('set_pagination_options', 'SetPaginationOptions')
            ->name('set_pagination_options');

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
