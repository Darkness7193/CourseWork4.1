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

use App\Http\Requests\cruds\User\UserCreateBulkRequest;
use App\Http\Requests\cruds\User\UserUpdateBulkRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index(Request $request): View
    {
        [$view_fields, $headers] = get_columns([
            ['name', 'Имя'],
            ['surname', 'Фамилия'],
            ['last_name', 'Отчество'],
            ['role', 'Роль'],

            ['password', 'Пароль'],
            ['email', 'Эл. почта'],
            ['phone_number', 'Номер'],

            ['comment', 'Комментарий']
        ]);

        $session_items = session_setif([
            'ordered_orders' => [session('ordered_orders'), [['created_at', 'asc']], ],
        ]);

        $users = filter_order_paginate(User::query(), $view_fields);
        User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'Super Admin')->toArray()
        )->count();
        return view('pages/cruds/users-crud', [
            'paginator' => $users,
            'User' => User::class,
            'filler_rows' => get_filler_rows($users),
            'Role' => Role::class,

        ] + $session_items + compact('view_fields', 'headers'));
    }


    public function create_bulk(UserCreateBulkRequest $request): void
    {
        foreach ($request->new_rows as $new_row)
        {
            if (auth()->user()->can('create user')) {
                $user = User::create(array_merge($request->no_view_fields, $new_row));

                $user->assignRoles( ($user && auth()->user()->can('assign role '.$new_row['role']))
                    ? $new_row['role']
                    : 'unapproved user'
                );
            }
        }
    }


    public function update_bulk(UserUpdateBulkRequest $request): void {
        foreach ($request->updated_rows as $row_id => $updated_cells)
        {
            $exist_user = User::find((int)$row_id);
            if (!$exist_user) { continue; }

            if (auth()->user()->can('edit '.$updated_cells['role'])) {
                $exist_user->update($updated_cells);
            }

            if (auth()->user()->can('assign role '.$updated_cells['role']) &&
                auth()->user()->can('remove role '.$exist_user->getRoleNames()->first())) {
                $exist_user->syncRoles($updated_cells['role']);
            }
        }
    }


    public function delete_bulk(Request $request): void {
        delete_bulk(User::class, $request->deleted_rows);
    }
}
