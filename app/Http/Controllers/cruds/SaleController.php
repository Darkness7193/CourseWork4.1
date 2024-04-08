<?php

namespace App\Http\Controllers\cruds;

include_once(app_path().'/sql/queries/filter_order_paginate.php');
include_once(app_path().'/sql/helpers/update_bulk.php');
include_once(app_path().'/sql/helpers/create_bulk.php');
include_once(app_path().'/sql/helpers/delete_bulk.php');

include_once(app_path().'/helpers/pure_php/get_columns.php');
include_once(app_path().'/helpers/get_filler_rows.php');
include_once(app_path().'/helpers/session_setif.php');
include_once(app_path().'/helpers/is_the_same_route.php');

use App\Http\Requests\cruds\Sale\SaleCreateBulkRequest;
use App\Http\Requests\cruds\Sale\SaleUpdateBulkRequest;
use App\Models\Product;
use App\Models\ProductMove;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;




class SaleController extends Controller
{
    public function index(Request $request): View
    {
        [$view_fields, $headers] = get_columns([
            ['date', 'Продано'],

            ['product_id', 'Товар'],
            ['quantity', 'Кол-во'],
            ['price', 'Цена'],

            ['storage_id', 'Склад'],
            ['comment', 'Комментарий']
        ]);
        if (!is_the_same_route()) { Session::forget(['ordered_orders', 'per_page', 'current_page', 'search_targets']); }
        $session_items = session_setif([
            'ordered_orders' => [
                session('ordered_orders'),
                [['created_at', 'asc']]
            ],
            'per_page' => $request->per_page,
            'current_page' => $request->current_page
        ]);

        $sales = filter_order_paginate(ProductMove::where('product_move_type', 'selling'), $view_fields);

        return view('pages/cruds/sales-crud', [
            'paginator' => $sales,
            'ProductMove' => ProductMove::class,
            'products' => Product::select('id', 'name', 'selling_price')->get(),
            'storages' => Storage::select('id', 'name')->get(),
            'filler_rows' => get_filler_rows($sales),
            'search_targets' => session('search_targets')

        ] + $session_items + compact('view_fields', 'headers'));
    }


    public function create_bulk(SaleCreateBulkRequest $request): void {
        create_bulk(ProductMove::class, $request->new_rows, $request->no_view_fields);
    }


    public function update_bulk(SaleUpdateBulkRequest $request): void {
        update_bulk(ProductMove::class, $request->updated_rows);
    }


    public function delete_bulk(Request $request): void {
        delete_bulk(ProductMove::class, $request->deleted_rows);
    }
}
