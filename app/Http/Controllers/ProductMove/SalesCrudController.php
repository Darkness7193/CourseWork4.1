<?php

namespace App\Http\Controllers\ProductMove;

include_once(app_path().'/helpers/filter_order_paginate.php');
include_once(app_path().'/helpers/EmptyRow.php');

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Models\ProductMove;
use App\Models\Product;
use App\Models\Storage;


class SalesCrudController extends Controller
{
    public function __invoke(Request $request): View
    {
        if ($request->per_page) {
            $request->session()->put('per_page', $request->per_page);
        }

        return view('pages/sales-crud', [
            'sales' => filter_order_paginate(ProductMove::where('product_move_type', 'selling'), $request),
            'view_fields' => ProductMove::view_fields(),
            'products' => Product::select('id', 'name')->get(),
            'storages' => Storage::select('id', 'name')->get(),
            'max_id' => ProductMove::max('id'),
        ]);
    }
}
