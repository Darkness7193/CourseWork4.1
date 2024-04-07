<?php


function create_bulk($Model, $updated_rows, $cells_defaults)
{
    foreach ($updated_rows as $updated_cells)
    {
        $Model::create(array_merge($cells_defaults, $updated_cells));
    }
}
