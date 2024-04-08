<?php




function delete_bulk($Model, $deleted_ids)
{
    foreach ($deleted_ids as $id) {
        $Model::find($id)->delete();
    }
}
