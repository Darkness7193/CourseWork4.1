<?php

namespace App\Http\Controllers\reports;

include_once(app_path().'/helpers/get_used_years_of.php');
include_once(app_path().'/helpers/session_setif.php');
include_once(app_path().'/helpers/session_get.php');
include_once(app_path().'/helpers/is_the_same_route.php');
include_once(app_path().'/helpers/pure_php/get_columns.php');

include_once(app_path().'/sql/queries/filter_order_paginate.php');
include_once(app_path().'/sql/queries/report_totals/totals_by_months.php');

use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;




class TotalsByMonth extends Controller
{
    public function index(Request $request) {
        [$view_fields, $headers] = get_columns([
            ['product_name', 'Товар'],
            ['year_totals', 'Год'],

            ['month_1_totals',  'Янв'],
            ['month_2_totals',  'Фев'],
            ['month_3_totals',  'Мар'],
            ['month_4_totals',  'Апр'],
            ['month_5_totals',  'Май'],
            ['month_6_totals',  'Июн'],
            ['month_7_totals',  'Июл'],
            ['month_8_totals',  'Авг'],
            ['month_9_totals',  'Сен'],
            ['month_10_totals', 'Окт'],
            ['month_11_totals', 'Ноя'],
            ['month_12_totals', 'Дек']
        ]);
        if (!is_the_same_route()) { Session::forget(['ordered_orders', 'per_page', 'current_page', 'search_targets']); }
        $session_items = session_setif([
            'report_storage' => [
                $request->report_storage_id ? Storage::find($request->report_storage_id) : null,
                Storage::first() ?? (object)['id'=>null, 'name'=>'Складов нет']
            ],
            'report_year' => [
                $request->report_storage_id !== session('report_storage_id') ? $request->report_year : null,
            ],
            'is_cost_report' => [
                (bool)$request->is_cost_report,
                false
            ],
            'current_report_type' => [$request->current_report_type, 'quantities'],
            'ordered_orders' => [
                session('ordered_orders'),
                [['product_name', 'asc']]
            ]
        ]);

        $totals = totals_by_months(
            session()->get('report_storage')->id,
            session('report_year'),
            session('is_cost_report'),
            session('current_report_type'
        ));

        return view('pages/reports/totals-by-month', [
            'paginator' => filter_order_paginate($totals, $view_fields),
            'used_years' => get_used_years_of(session()->get('report_storage')->id),
            'Storage' => Storage::class,

        ] + $session_items + compact('view_fields', 'headers')
        );
    }
}

