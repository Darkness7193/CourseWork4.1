<?php

namespace App\Http\Controllers\TableViewCommands;

include_once(app_path().'/sql/helpers/update_bulk.php');

use App\Models\ProductMove;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;




class UpdateBulk extends Controller
{
    public function __invoke(Request $request): void
    {
        update_bulk($request->CrudModel, $request->updated_rows);
    }
}
