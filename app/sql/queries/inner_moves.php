<?php

use App\Models\ProductMove;




function inner_moves($product_moves) {
    return $product_moves->where( function($query) {
        foreach (ProductMove::inner_move_types() as $inner_move)
            $query = $query->orWhere('product_move_type', $inner_move);
        return $query;
    });
}
