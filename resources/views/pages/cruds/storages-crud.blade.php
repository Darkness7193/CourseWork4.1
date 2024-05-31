



<x-crud-page page_title="Склады" controller="Sale" :$paginator :$view_fields :$headers>
    <table class="crud-table" data-max-id="{{ $Storage::max('id') }}"
           data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $Storage }}">
        <tr class="header-tr">
            <th>{{ $headers['name'] }}<x-crud-components.required-asterisk/></th>

            <th>{{ $headers['address'] }}</th>
            <th>{{ $headers['phone_number'] }}</th>
            <th>{{ $headers['email'] }}</th>

            <th>{{ $headers['comment'] }}</th>
            <th><x-crud-components.activate-delete-btns-btn/></th>
        </tr>

        @foreach (array_merge($paginator->items(), $filler_rows) as $storage)
            <tr data-row-id="{{ $storage->id }}">
                <td><input type="text" value="{{ $storage->name }}" onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $storage->address }}" onfocusout="update_cell_of(this)"></td>
                <td><input type="text" step="0.01" value="{{ $storage->phone_number }}" onfocusout="update_cell_of(this)"></td>
                <td><input type="text" step="0.01" value="{{ $storage->email }}" onfocusout="update_cell_of(this)"></td>

                <td class="comment-td"><input type="text" value="{{ $storage->comment }}" onfocusout="update_cell_of(this)"></td>

                <td><x-crud-components.delete-btn/></td>
            </tr>
        @endforeach
    </table>
</x-crud-page>
