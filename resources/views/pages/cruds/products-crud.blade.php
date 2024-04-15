

<x-crud-page page-title="Товары" controller="Product" :$paginator :$view_fields :$headers>
    <table class="crud-table" data-max-id="{{ $Product::max('id') }}"
           data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $Product }}">
        <tr>
            @foreach($headers as $header)
                <th>{{ mb_strtoupper($header) }}</th>
            @endforeach

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



<body>
<x-app-layout>
    <x-global-errors/>

    <x-card-list>
        <x-card class="foot-margin">
            <table class="crud-table" data-max-id="{{ $Product::max('id') }}"
                   data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $Product }}">
                <tr>
                    @foreach($headers as $header)
                        <th>{{ mb_strtoupper($header) }}</th>
                    @endforeach

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
            <div class="table-tools-line horizontal-arrange vertical-center">
                <x-table-tools.ordering-menu :$view_fields :$headers />
                <x-table-tools.search-bar :$view_fields :$headers />
                <div
                    class="paginator-wrapper right-align">{{ $paginator->links('pagination::my-pagination-links') }}</div>
            </div>
        </x-card>
        <x-crud-components.save-btn controller="Product" :no_view_fields="[
            'product_move_type' => 'purchasing',
            'new_storage_id' => null
        ]" />
    </x-card-list>
    <div style="height: 200px"></div>
</x-app-layout>
</body>
</html>
