<?php

namespace App\Http\Controllers\TableViewCommands;

include_once(app_path().'/helpers/session_setif.php');

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;




class SetPaginationOptions extends Controller
{
    public function __invoke(Request $request) {
        session_setif([
            'per_page' => $request->per_page,
            'current_page' => $request->current_page
        ]);

        return to_route($request->previous_route);
    }
}












