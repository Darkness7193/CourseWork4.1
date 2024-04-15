

<x-crud-page page-title="Пользователи" :$paginator :$view_fields :$headers>
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


                <td><x-crud-components.delete-btn/></td>
            </tr>
        @endforeach
    </table>
</x-crud-page>
