<?php


function update_bulk($Model, $updated_rows)
{
    foreach ($updated_rows as $row_id => $updated_cells)
    {
        $exist_purchase = $Model::find((int)$row_id);
        if ($exist_purchase) {
            $exist_purchase->update($updated_cells);
        }
    }
}
