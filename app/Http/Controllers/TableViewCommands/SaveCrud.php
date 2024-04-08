<?php

namespace App\Http\Controllers\TableViewCommands;

include_once(app_path().'/sql/helpers/create_bulk.php');

use App\Models\ProductMove;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;




class SaveCrud extends Controller
{
    public function __invoke(Request $request): void
    {
        $controller = app("App\Http\Controllers\cruds\\" . $request->controller);

        $controller->create_bulk($request);
        $controller->update_bulk($request);
        $controller->delete_bulk($request);
    }
}
