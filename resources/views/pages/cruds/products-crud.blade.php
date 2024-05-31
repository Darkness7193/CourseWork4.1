



<x-crud-page page-title="Товары" controller="Product" :$paginator :$view_fields :$headers>
    <table class="crud-table" data-max-id="{{ $Product::max('id') }}"
           data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $Product }}">
        <tr class="header-tr">
            <th>{{ $headers['name'] }}<x-crud-components.required-asterisk/></th>

            <th>{{ $headers['manufactor'] }}</th>
            <th>{{ $headers['purchase_price'] }}<x-crud-components.required-asterisk/></th>
            <th>{{ $headers['selling_price'] }}<x-crud-components.required-asterisk/></th>

            <th>{{ $headers['comment'] }}</th>
            <th><x-crud-components.activate-delete-btns-btn/></th>
        </tr>

        @foreach (array_merge($paginator->items(), $filler_rows) as $product)
            <tr data-row-id="{{ $product->id }}">
                <td><input type="text" value="{{ $product->name }}" onfocusout="update_cell_of(this)"></td>
                <td><input type="text" value="{{ $product->manufactor }}" onfocusout="update_cell_of(this)">
                </td>
                <td><input type="number" step="0.01" value="{{ $product->purchase_price }}"
                           onfocusout="update_cell_of(this)"></td>
                <td><input type="number" step="0.01" value="{{ $product->selling_price }}"
                           onfocusout="update_cell_of(this)"></td>

                <td class="comment-td"><input type="text" value="{{ $product->comment }}"
                                              onfocusout="update_cell_of(this)"></td>

                <td><x-crud-components.delete-btn/></td>
            </tr>
        @endforeach
    </table>
</x-crud-page>
