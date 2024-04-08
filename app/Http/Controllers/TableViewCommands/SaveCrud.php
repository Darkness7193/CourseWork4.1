<?php

namespace App\Http\Controllers\TableViewCommands;

include_once(app_path().'/sql/helpers/create_bulk.php');

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;




class SaveCrud extends Controller
{
    public function __invoke(Request $request): void
    {
        $controller = app("App\Http\Controllers\cruds\\{$request->controller}Controller");
        $form_request = "App\Http\Requests\cruds\\$request->controller\\$request->controller";

        $controller->create_bulk(app($form_request.'CreateBulkRequest')::createFrom($request));
        $controller->update_bulk(app($form_request.'UpdateBulkRequest')::createFrom($request));
        $controller->delete_bulk($request);
    }
}
