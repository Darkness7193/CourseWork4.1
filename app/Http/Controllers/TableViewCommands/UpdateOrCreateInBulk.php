<?php

namespace App\Http\Controllers\TableViewCommands;

include_once(app_path().'/sql/helpers/update_or_create_in_bulk.php');

use App\Models\ProductMove;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class UpdateOrCreateInBulk extends Controller
{
    public function __invoke(Request $request): void
    {
        update_or_create_in_bulk($request->CrudModel, $request->updated_rows, $request->no_view_fields);
    }
}
