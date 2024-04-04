<?php


function update_or_create_in_bulk($Model, $updated_rows, $cells_defaults)
{
    $fillable_count = count((new $Model)->getFillable());

    foreach ($updated_rows as $row_id => $updated_cells)
    {
        $exist_purchase = $Model::find($row_id);
        if ($exist_purchase) {
            $exist_purchase->update($updated_cells);
        } else {
            $new_purchase = array_merge($cells_defaults, $updated_cells);
            if (count($new_purchase) === $fillable_count) {
                $Model::create($new_purchase);
            }
        }
    }
}
