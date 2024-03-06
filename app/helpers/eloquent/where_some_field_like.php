<?php


include_once(app_path().'/helpers/eloquent/where_field_like.php');


function where_some_field_like(&$rows, $target, $search_fields) {
    if ($target === '') { return $rows; }

    return $rows->where( function($rows) use($target, $search_fields)
    {
        foreach ($search_fields as $field) {
            or_where_field_like($rows, $target, $field);
        }
    });
}
