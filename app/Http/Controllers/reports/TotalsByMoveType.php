<?php

namespace App\Http\Controllers\reports;

include_once(app_path().'/helpers/get_used_years_of.php');
include_once(app_path().'/sql/queries/report_totals/totals_by_move_type.php');
include_once(app_path().'/helpers/session_setif.php');
include_once(app_path().'/helpers/pure_php/get_columns.php');
include_once(app_path().'/helpers/is_the_same_route.php');

include_once(app_path().'/sql/queries/filter_order_paginate.php');

use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;




class TotalsByMoveType extends Controller
{
    public function index(Request $request): View {
        $headers = [
            'product_id' => 'Товар',

            'purchases_totals' => 'Закупка',
            'sales_totals' => 'Продажа',
            'quantity_totals' => 'Остаток',
            'liquidating_totals' => 'Утилизация',
            'inventory_totals' => 'Инвентаризация',
            'import_totals' => 'Импорт',
            'write_off_totals' => 'Списание',
        ];
        $view_fields = array_keys($headers);

        if (!is_the_same_route()) { Session::forget(['report_storage', 'report_year', 'is_cost_report']); }
        session_setif([
            'report_storage' => [
                $request->report_storage_id ? Storage::find($request->report_storage_id) : null,
                Storage::first() ?? (object)['id'=>null, 'name'=>'Складов нет']
            ],
        ]);
        $used_years = get_used_years_of(session()->get('report_storage')->id);
        $session_items = session_setif([
            'begin_date' => $request->begin_date,
            'end_date' => $request->end_date,
            'is_cost_report' => [
                (bool)$request->is_cost_report,
                false
            ],
            'ordered_orders' => [
                session('ordered_orders'),
                [['product_name', 'asc']]
            ]
        ]);

        $totals = totals_by_move_type(
            session()->get('report_storage')->id,
            session('begin_date'),
            session('end_date'),
            session('is_cost_report')
        );

        return view('pages/reports/totals-by-move-type', [
            'paginator' => filter_order_paginate($totals, $view_fields),
            'used_years' => $used_years,
            'Storage' => Storage::class,
            'report_storage' => session('report_storage')

        ] + $session_items + compact('view_fields', 'headers'));
    }
}
