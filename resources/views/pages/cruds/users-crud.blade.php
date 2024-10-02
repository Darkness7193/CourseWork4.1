



<x-layouts.crud-page page_title="Пользователи" controller="User" :$paginator :$view_fields :$headers>
    <table class="crud-table" data-max-id="{{ $User::max('id') }}"
           data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $User }}">
        <tr class="header-tr">
            <th>{{ $headers['name'] }}<x-crud-components.required-asterisk/></th>
            <th>{{ $headers['surname'] }}</th>
            <th>{{ $headers['last_name'] }}</th>
            <th>{{ $headers['role'] }}<x-crud-components.required-asterisk/></th>

            <th>{{ $headers['password'] }}<x-crud-components.required-asterisk/></th>
            <th>{{ $headers['email'] }}<x-crud-components.required-asterisk/></th>
            <th>{{ $headers['phone_number'] }}</th>

            <th>{{ $headers['comment'] }}</th>
            <th><x-crud-components.activate-delete-btns-btn/></th>
        </tr>
        @foreach (array_merge($paginator->items(), $filler_rows) as $user)

            <tr data-row-id="{{ $user->id }}">
                @php($is_exist_user = ("$user" !== ''))
                <td><input type="text" value="{{ $user->name }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $user->surname }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $user->last_name }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><x-crud-components.role-select :$user /></td>

                <td><input type="password" value="{{ $is_exist_user ? '***' : '' }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="email" value="{{ $user->email }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $user->phone_number }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $user->comment }}" onfocusout="update_cell_of(this)"></td>
                <td>
                    @can('delete ' . ("{$user->getRoleNames()->first()}" ?: 'user'))
                        <x-crud-components.delete-btn/>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
</x-layouts.crud-page>
