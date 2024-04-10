<?php

namespace App\Http\Controllers\cruds;

include_once(app_path().'/sql/queries/filter_order_paginate.php');
include_once(app_path().'/sql/queries/inner_moves.php');
include_once(app_path().'/sql/helpers/update_bulk.php');
include_once(app_path().'/sql/helpers/create_bulk.php');
include_once(app_path().'/sql/helpers/delete_bulk.php');

include_once(app_path().'/helpers/pure_php/get_columns.php');
include_once(app_path().'/helpers/get_filler_rows.php');
include_once(app_path().'/helpers/session_setif.php');
include_once(app_path().'/helpers/is_the_same_route.php');

use App\Http\Requests\cruds\InnerMove\InnerMoveCreateBulkRequest;
use App\Http\Requests\cruds\InnerMove\InnerMoveUpdateBulkRequest;
use App\Models\Product;
use App\Models\ProductMove;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;




class InnerMoveController extends Controller
{
    public function index(Request $request): View
    {
        [$view_fields, $headers] = get_columns([
            ['date', 'Дата'],

            ['product_move_type', 'Тип'],
            ['storage_id', 'Склад (изначальный)'],
            ['new_storage_id', 'Склад (конечный)'],

            ['product_id', 'Товар'],
            ['quantity', 'Кол-во'],
            ['price', 'Цена'],

            ['comment', 'Комментарий'],
        ]);
        if (!is_the_same_route()){ Session::forget(['ordered_orders', 'per_page', 'current_page', 'search_targets']); }
        $session_items = session_setif([
            'ordered_orders' => [
                session('ordered_orders'),
                [['created_at', 'asc']]
            ],
        ]);

        $inner_moves = filter_order_paginate(inner_moves(ProductMove::query()), $view_fields);

        return view('pages/cruds/inner-moves-crud', [
            'paginator' => $inner_moves,
            'ProductMove' => ProductMove::class,
            'products' => Product::select('id', 'name')->get(),
            'storages' => Storage::select('id', 'name')->get(),
            'filler_rows' => get_filler_rows($inner_moves),
            'search_targets' => session('search_targets')

        ] + $session_items + compact('view_fields', 'headers'));
    }


    public function create_bulk(InnerMoveCreateBulkRequest $request): void {
        create_bulk(ProductMove::class, $request->new_rows, $request->no_view_fields);
    }


    public function update_bulk(InnerMoveUpdateBulkRequest $request): void {
        update_bulk(ProductMove::class, $request->updated_rows);
    }


    public function delete_bulk(Request $request): void {
        delete_bulk(ProductMove::class, $request->deleted_rows);
    }
}
