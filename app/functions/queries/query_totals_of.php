<?php

include_once(app_path().'/helpers/eloquent/paginate.php');

use App\Models\Storage;
use Illuminate\Support\Facades\DB;


function on($value_1, $operator, $value_2) {
    return function($join) use($value_1, $operator, $value_2) {$join->on($value_1, $operator, $value_2); };
}


function all_time_totals($report_storage_id, $quantity_or_cost) {
    return DB::table('product_moves')
        ->where('storage_id', '=', $report_storage_id)
        ->where('product_move_type', '=', 'transfering')
        ->groupBy('product_id')

        ->select('product_id As product_id')
        ->selectRaw("Sum(If(product_move_type In ('purchasing', 'inventory'), $quantity_or_cost, -$quantity_or_cost)) As all_time_totals");
}


function from_storages($report_storage_id, $quantity_or_cost) {
    $from_storages = DB::table('product_moves')
        ->where('product_move_type', '=', 'transfering')
        ->where('new_storage_id', '=', $report_storage_id)
        ->groupBy('product_id')

        ->select('product_id')
        ->selectRaw("Sum($quantity_or_cost) As all_totals");
        for ($i=1; $i<13; $i++) {$from_storages = $from_storages->selectRaw(/**@lang SQL*/"
            Sum(If(product_move_type = 'transfering' And month(date) = $i, $quantity_or_cost, 0)) As month_{$i}_totals
        ");}

    return $from_storages;
}


function select_totals_by_month(&$query, $quantity_or_cost) {
    for ($i=1; $i<13; $i++) {$query = $query->selectRaw(/**@lang SQL*/"
        Sum(
            If(month(date) = $i,
                If(this.product_move_type in ('purchasing', 'inventory'), $quantity_or_cost, -$quantity_or_cost),
                0
        )) + Ifnull(from_storages.month_{$i}_totals, 0) As month_{$i}_totals
    ");}

    return $query;
}


function query_totals_of($request, bool $is_cost_report, ?int $report_storage_id, ?int $year) {
    if ($is_cost_report === null or $report_storage_id === null or $year === null) {
        $arr = [];
        return paginate_array($arr, 1); }
    $quantity_or_cost = ['quantity', 'quantity*price'][$is_cost_report];
    $from_storages = from_storages($report_storage_id, $quantity_or_cost);
    $all_time_totals = all_time_totals($report_storage_id, $quantity_or_cost);

    dump($from_storages->get()->toArray());
    $totals = DB::table('product_moves as this')
        ->leftJoinSub($from_storages, 'from_storages', on('this.product_id', '=', 'from_storages.product_id'))
        ->JoinSub($all_time_totals, 'all_time_totals', on('this.product_id', '=', 'all_time_totals.product_id'))
        ->where('this.storage_id', '=', $report_storage_id)
        ->where(DB::raw('year(this.date)'), '=', $year)
        ->groupBy('this.product_id')

        ->selectRaw(/**@lang SQL*/"
            (Select name From products Where id = this.product_id) As product_name,
            all_time_totals,
            Sum(If(this.product_move_type In ('purchasing', 'inventory'), $quantity_or_cost, -$quantity_or_cost))
                + Ifnull(from_storages.all_totals, 0) As year_totals");
            select_totals_by_month($totals, $quantity_or_cost);


    return paginate($totals,
        per_page: session()->get('per_page') ?? 10,
        current_page: $request->current_page ?? 1,
    );
}

