<?php

namespace App\Http\Controllers\cruds;

include_once(app_path().'/sql/queries/filter_order_paginate.php');
include_once(app_path().'/sql/helpers/update_bulk.php');
include_once(app_path().'/sql/helpers/create_bulk.php');

include_once(app_path().'/helpers/pure_php/get_columns.php');
include_once(app_path().'/helpers/get_filler_rows.php');
include_once(app_path().'/helpers/session_setif.php');
include_once(app_path().'/helpers/is_the_same_route.php');

use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;




class StorageController extends Controller
{
    public function index(Request $request): View
    {
        [$view_fields, $headers] = get_columns([
            ['name', 'Наименование'],

            ['address', 'Адрес'],
            ['phone_number', 'Номер'],
            ['email', 'Эл. почта'],

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

        $storages = filter_order_paginate(Storage::query(), $view_fields);

        return view('pages/cruds/storages-crud', [
            'paginator' => $storages,
            'Storage' => Storage::class,
            'filler_rows' => get_filler_rows($storages),
            'search_targets' => session('search_targets')

        ] + $session_items + compact('view_fields', 'headers'));
    }


    public function update_bulk(Request $request): void
    {
        update_bulk(Storage::class, $request->updated_rows);
    }


    public function create_bulk(Request $request): void
    {
        create_bulk(Storage::class, $request->new_rows, $request->no_view_fields);
    }
}
