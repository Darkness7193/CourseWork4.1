<?php


function update_bulk($Model, $updated_rows)
{
    foreach ($updated_rows as $row_id => $updated_cells)
    {
        $exist_row = $Model::find((int)$row_id);
        if ($exist_row) { $exist_row->update($updated_cells); }
    }
}
