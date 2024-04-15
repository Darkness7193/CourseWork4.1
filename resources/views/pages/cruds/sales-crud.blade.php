

<x-crud-page page-title="Продажи" controller="Sale" :$paginator :$view_fields :$headers>
    <table class="crud-table" data-max-id="{{ $ProductMove::max('id') }}"
           data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $ProductMove }}">
        <tr>
            @foreach($headers as $header)
                <th>{{ mb_strtoupper($header) }}</th>
            @endforeach

            <th><x-crud-components.activate-delete-btns-btn/></th>
        </tr>

        @foreach (array_merge($paginator->items(), $filler_rows) as $sale)
            <tr data-row-id="{{ $sale->id }}">
                <td><input type="date" value="{{ $sale->date->toDateString() }}"
                           onfocusout="update_cell_of(this)">
                </td>

                <td>
                    <select class="foreign-cell product-select" onfocusout="update_cell_of(this)">
                        @foreach ($products as $product)
                            <option value="{{ $product->id ?? '' }}"
                                    data-sale-price="{{ $product->selling_price }}">
                                {{ $product->name }}
                            </option>
                        @endforeach

                        <option selected="selected" hidden="hidden"
                                value="{{ $sale->product->id ?? ''}}">{{ $sale->product->name ?? '' }}</option>
                    </select>
                </td>
                <td><input type="number" value="{{ $sale->quantity }}" onfocusout="update_cell_of(this)"></td>
                <td><input class="sale-price-input" type="number" step="0.01" value="{{ $sale->price }}"
                           onfocusout="update_cell_of(this)"></td>

                <td><x-crud-components.foreign-cell :selected_foreign_row="$sale->storage" :foreign_rows="$storages"/></td>
                <td class="comment-td"><input type="text" value="{{ $sale->comment }}"
                                              onfocusout="update_cell_of(this)"></td>

                <td><x-crud-components.delete-btn/></td>
            </tr>
        @endforeach
    </table>
</x-crud-page>
