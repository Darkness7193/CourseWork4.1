<?php

include_once(app_path().'/sql/helpers/paginate.php');
include_once(app_path().'/sql/helpers/on.php');
include_once(app_path().'/sql/queries/subqueries/import_totals.php');

use App\Models\ProductMove;
use Illuminate\Support\Facades\DB;




function select_month_totals($q, $month, $quantity_or_cost) {
    return $q->selectRaw(/**@lang SQL*/
    "
        Sum(If(month(date) = $month,
            If(this.product_move_type in ('purchasing', 'inventory'), $quantity_or_cost, -$quantity_or_cost),
            0
        )) + Ifnull(import_totals.month_{$month}_totals, 0) As month_{$month}_totals
    ");
}


function totals_by_months(?int $report_storage_id, ?int $report_year, bool $is_cost_report, $report_move_type=null) {
    if ($report_storage_id === null or $report_year === null) { return ProductMove::first()->where('id', '=', 'asdf'); }
    $quantity_or_cost = $is_cost_report ? 'this.quantity*this.price' : 'this.quantity';

    $totals = $q = DB::table('product_moves as this')
        ->when($report_move_type !== 'quantities', fn($q)=>$q
            ->where('product_move_type', '=', $report_move_type))
        ->where('this.storage_id', '=', $report_storage_id)
        ->where(DB::raw('year(this.date)'), '=', $report_year)

        ->leftJoinSub(import_totals($report_storage_id, $is_cost_report, $report_year), 'import_totals',
            on('this.product_id', '=', 'import_totals.product_id'))

        ->groupBy('this.product_id')
        ->selectRaw("(Select name From products Where id = this.product_id) As product_name")
        ->selectRaw(/**@lang SQL*/"
            Sum(If(this.product_move_type In ('purchasing', 'inventory'), $quantity_or_cost, -$quantity_or_cost))
                + Ifnull(import_totals.year_totals, 0) As year_totals");
            for ($i=1; $i<13; $i++) {
                select_month_totals($q, $i, $quantity_or_cost); }

    return ProductMove::query()->fromSub($totals, 'some_name');
}
