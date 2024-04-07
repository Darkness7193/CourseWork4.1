<?php

namespace App\Http\Controllers\TableViewCommands;

include_once(app_path().'/sql/helpers/create_bulk.php');

use App\Models\ProductMove;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;




class CreateBulk extends Controller
{
    public function __invoke(Request $request): void
    {
        create_bulk($request->CrudModel, $request->new_rows, $request->no_view_fields);
    }
}
