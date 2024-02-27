<?php

include_once(app_path().'/helpers/paginate.php');

use Illuminate\Support\Facades\DB;


function get_product_totals($request) {
    $totals = DB::select("
    select
        (select name from storages where id = storage_id) as storage_name,
        (select name from products where id = product_id) as product_name,
        sum(case product_move_type
            when 'purchasing'  then  quantity
            when 'selling'     then -quantity
            when 'liquidating' then -quantity
            when 'inventory'   then  quantity
            when 'transfering' then -quantity
            end) as total_quantity,
        sum(case product_move_type
            when 'purchasing'  then  quantity*price
            when 'selling'     then -quantity*price
            when 'liquidating' then -quantity*price
            when 'inventory'   then  quantity*price
            when 'transfering' then -quantity*price
            end) as income,
        sum(if(product_move_type = 'purchasing', quantity, 0))          as total_purchases_quantity,
        sum(if(product_move_type = 'purchasing', price*quantity, 0))    as total_purchases_cost,
        sum(if(product_move_type = 'selling', quantity, 0))             as total_sales_quantity,
        sum(if(product_move_type = 'selling', price*quantity, 0))       as total_sales_cost
    from product_moves
    group by storage_id, product_id
    ");

    return paginate_array($totals,
        per_page: $request->session()->get('per_page') ?? 10,
        current_page: $request->current_page ?? 1,
    );
}
