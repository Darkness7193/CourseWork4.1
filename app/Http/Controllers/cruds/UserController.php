<?php

namespace App\Http\Controllers\cruds;

include_once(app_path().'/sql/queries/filter_order_paginate.php');
include_once(app_path().'/sql/helpers/update_bulk.php');
include_once(app_path().'/sql/helpers/create_bulk.php');
include_once(app_path().'/sql/helpers/delete_bulk.php');

include_once(app_path().'/helpers/pure_php/get_columns.php');
include_once(app_path().'/helpers/get_filler_rows.php');
include_once(app_path().'/helpers/session_setif.php');
include_once(app_path().'/helpers/clear_session.php');
include_once(app_path().'/helpers/is_the_same_route.php');

use App\Http\Requests\cruds\User\UserCreateBulkRequest;
use App\Http\Requests\cruds\User\UserUpdateBulkRequest;
use App\Models\Product;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;




class UserController extends Controller
{
    public function index(Request $request): View
    {
        [$view_fields, $headers] = get_columns([
            ['name', 'Имя'],
            ['surname', 'Фамилия'],
            ['last_name', 'Отчество'],

            ['password', 'Пароль'],
            ['email', 'Эл. почта'],
            ['phone_number', 'Номер'],

            ['comment', 'Комментарий']
        ]);
        if (!is_the_same_route()) { Session::forget(['ordered_orders', 'per_page', 'current_page', 'search_targets']); }
        $session_items = session_setif([
            'ordered_orders' => [session('ordered_orders'), [['created_at', 'asc']], ],
        ]);

        $users = filter_order_paginate(User::query(), $view_fields);

        return view('pages/cruds/users-crud', [
            'paginator' => $users,
            'User' => User::class,
            'filler_rows' => get_filler_rows($users),

        ] + $session_items + compact('view_fields', 'headers'));
    }


    public function create_bulk(UserCreateBulkRequest $request): void {
        create_bulk(User::class, $request->new_rows, $request->no_view_fields);
    }


    public function update_bulk(UserUpdateBulkRequest $request): void {
        update_bulk(User::class, $request->updated_rows);
    }


    public function delete_bulk(Request $request): void {
        delete_bulk(User::class, $request->deleted_rows);
    }
}
