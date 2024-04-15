

<x-crud-page page-title="Пользователи" controller="User" :$paginator :$view_fields :$headers>

    <table class="crud-table" data-max-id="{{ $User::max('id') }}"
           data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $User }}">
        <tr>
            @foreach($headers as $header)
                <th>{{ mb_strtoupper($header) }}</th>
            @endforeach

            <th><x-crud-components.activate-delete-btns-btn/></th>
        </tr>

        @foreach (array_merge($paginator->items(), $filler_rows) as $user)
            <tr data-row-id="{{ $user->id }}">
                @php($is_exist_user = ("$user" !== ''))
                <td><input type="text" value="{{ $user->name }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $user->surname }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $user->last_name }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>

                <td><input type="password" value="{{ $user->password }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="email" value="{{ $user->email }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $user->phone_number }}" @if($is_exist_user) disabled @endif onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $user->comment }}" onfocusout="update_cell_of(this)"></td>
                <td><x-crud-components.delete-btn/></td>
            </tr>
        @endforeach
    </table>
</x-crud-page>
