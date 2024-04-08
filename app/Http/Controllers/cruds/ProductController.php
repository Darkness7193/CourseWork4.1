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

use App\Http\Requests\cruds\Product\ProductCreateBulkRequest;
use App\Http\Requests\cruds\Product\ProductUpdateBulkRequest;
use App\Models\Product;
use App\Models\ProductMove;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;




class ProductController extends Controller
{
    public function index(Request $request): View
    {
        [$view_fields, $headers] = get_columns([
            ['name', 'Наименование'],

            ['manufactor', 'Производитель'],
            ['purchase_price', 'Цена закупки'],
            ['selling_price', 'Цена продажи'],

            ['comment', 'Комментарий'],
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

        $products = filter_order_paginate(Product::query(), $view_fields);

        return view('pages/cruds/products-crud', [
            'paginator' => $products,
            'Product' => Product::class,
            'filler_rows' => get_filler_rows($products),
            'search_targets' => session('search_targets')

        ] + $session_items + compact('view_fields', 'headers'));
    }


    public function create_bulk(ProductCreateBulkRequest $request): void {
        create_bulk(Product::class, $request->new_rows, $request->no_view_fields);
    }


    public function update_bulk(ProductUpdateBulkRequest $request): void {
        update_bulk(Product::class, $request->updated_rows);
    }


    public function delete_bulk(Request $request): void {
        delete_bulk(Product::class, $request->deleted_rows);
    }
}
