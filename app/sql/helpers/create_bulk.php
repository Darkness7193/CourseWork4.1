<?php


function create_bulk($Model, $new_rows, $cells_defaults)
{
    foreach ($new_rows as $new_row) {
        $Model::create(array_merge($cells_defaults, $new_row));
    }
}
