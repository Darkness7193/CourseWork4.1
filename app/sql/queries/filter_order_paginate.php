<?php

use Illuminate\Support\Facades\Session;

include_once(app_path().'/sql/queries/filter.php');
include_once(app_path().'/sql/helpers/multi_order_by.php');
include_once(app_path().'/sql/helpers/paginate.php');

include_once(app_path().'/helpers/is_the_same_route.php');




function filter_order_paginate($product_moves, $view_fields) {
    if (!is_the_same_route()) { Session::forget(['ordered_orders', 'per_page', 'current_page', 'search_targets']); }

    filter($product_moves, session('search_targets'), $view_fields);
    multi_order_by($product_moves, session('ordered_orders'));

    return paginate($product_moves, session('per_page'), session('current_page'));
}
