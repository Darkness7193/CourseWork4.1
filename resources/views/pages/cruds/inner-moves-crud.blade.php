



<x-layouts.crud-page page_title="Внутренние движения" controller="InnerMove" :$paginator :$view_fields :$headers>
    </style>
    <table class="crud-table" data-max-id="{{ $ProductMove::max('id') }}"
           data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $ProductMove }}">
        <tr class="header-tr">
            <th>{{ $headers['date'] }}<x-crud-components.required-asterisk/></th>

            <th>{{ $headers['product_move_type'] }}<x-crud-components.required-asterisk/></th>
            <th>{{ $headers['storage_id'] }}<x-crud-components.required-asterisk/></th>
            <th>{{ $headers['new_storage_id'] }}</th>

            <th>{{ $headers['product_id'] }}<x-crud-components.required-asterisk/></th>
            <th>{{ $headers['quantity'] }}<x-crud-components.required-asterisk/></th>
            <th>{{ $headers['price'] }}<x-crud-components.required-asterisk/></th>

            <th>{{ $headers['comment'] }}</th>
            <th><x-crud-components.activate-delete-btns-btn/></th>
        </tr>

        @foreach (array_merge($paginator->items(), $filler_rows) as $inner_move)
            <tr data-row-id="{{ $inner_move->id }}">
                <td><input type="date" value="{{ $inner_move->date->toDateString() }}"
                           onfocusout="update_cell_of(this)"></td>

                <td><select class="foreign-cell product-move-type-select" onfocusout="update_cell_of(this)">
                        @foreach($ProductMove::inner_move_types_ru() as $inner_move_type => $inner_move_type_ru)
                            <option value="{{ $inner_move_type }}"> {{ $inner_move_type_ru }} </option>
                        @endforeach
                        <option value="{{ $inner_move->product_move_type }}" selected="selected"
                                hidden="hidden">
                            {{ "$inner_move" ? $ProductMove::inner_move_types_ru()[$inner_move->product_move_type] : '' }}
                        </option>
                    </select></td>

                <td><x-crud-components.foreign-cell :selected_foreign_row="$inner_move->storage" :foreign_rows="$storages" /></td>
                <td>
                    @if("$inner_move->product_move_type" === 'transfering')
                        <x-crud-components.foreign-cell class="new-storage-select" :foreign_rows="$storages" :selected_foreign_row="$inner_move->new_storage" />
                    @else
                        <x-crud-components.foreign-cell class="new-storage-select" :foreign_rows="$storages" parameters='disabled="true"' />
                    @endif
                </td>

                <td><x-crud-components.foreign-cell :selected_foreign_row="$inner_move->product" :foreign_rows="$products" /></td>
                <td><input type="number" value="{{ $inner_move->quantity }}" onfocusout="update_cell_of(this)">
                </td>
                <td><input type="number" step="0.01" value="{{ $inner_move->price }}"
                           onfocusout="update_cell_of(this)"></td>

                <td class="comment-td"><input type="text" value="{{ $inner_move->comment }}"
                                              onfocusout="update_cell_of(this)"></td>

                <td><x-crud-components.delete-btn/></td>
            </tr>
        @endforeach
    </table>
</x-layouts.crud-page>
