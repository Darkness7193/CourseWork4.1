<?php

namespace App\Http\Controllers\TableViewCommands;

include_once(app_path().'/helpers/session_setif.php');

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;




function adjust_current_page($current_page, $per_page) {
    if ($current_page !== session('current_page') || !(session('current_page') && session('per_page'))) {
        return $current_page;
    }

    $first_item_of_page = ((int)session('current_page')-1)*(int)session('per_page') + 1;
    return intdiv($first_item_of_page, $per_page) + 1;
}


class SetPaginationOptions extends Controller
{
    public function __invoke(Request $request) {
        session_setif([
            'pagination_total' => $request->total,
            'per_page' => $request->per_page,
            'current_page' => adjust_current_page($request->current_page, $request->per_page)
        ]);

        return to_route($request->previous_route);
    }
}












