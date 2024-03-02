<?php

include_once(app_path().'/helpers/where_some_field_like.php');
include_once(app_path().'/helpers/paginate.php');


function filter($rows, $search_targets, $search_fields) {
    if (empty($search_targets)) { return $rows; }

    return where_some_field_like($rows, $search_targets['tablewise'], $search_fields);
}


function filter_order_paginate($product_moves, $search_fields, $request) {
    filter($product_moves, $request->search_targets, $search_fields)
        ->orderBy('created_at');

    return paginate($product_moves,
        per_page: $request->session()->get('per_page') ?? 10,
        current_page: $request->current_page ?? 1,
    );
}
