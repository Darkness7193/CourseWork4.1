<!DOCTYPE html>
<html lang="ru">


<head>
    <title> Товары </title>
    @include('global-head')

    <!-- imports: -->
    @include('php_variables')
    <script src="{{ asset('js/of_crud-table/submit_changes.js') }}" type="module"></script>

    <script src="{{ asset('js/of_crud-table/macroses/delete-btn_bulk_activation.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/macroses/copy_input_value_by_hold.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/macroses/auto_price_insert.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/macroses/auto_table_input_refocus.js') }}" type="module"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/crud-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/foreign-cell.css') }}">
</head>


<body>
<x-app-layout>
    @include('global-errors')

    <x-card-list>
        <x-card class="foot-margin">
            <table class="crud-table" data-max-id="{{ $Product::max('id') }}"
                   data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $Product }}">
                <tr>
                    @foreach($headers as $header)
                        <th>{{ mb_strtoupper($header) }}</th>
                    @endforeach

                    <th>@include('crud-components.activate-delete-btns-btn')</th>
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

                        <td>@include('crud-components.delete-btn')</td>
                    </tr>
                @endforeach
            </table>
            <div class="table-tools-line horizontal-arrange vertical-center">
                @include('table-tools.ordering-menu', compact('view_fields', 'headers'))
                @include('table-tools.search-bar', compact('view_fields', 'headers'))
                <div class="paginator-wrapper right-align">{{ $paginator->links('pagination::my-pagination-links') }}</div>
            </div>
        </x-card>
        @include('crud-components.save-btn', ['controller' => 'InnerMove', 'no_view_fields' => [
            'product_move_type' => 'purchasing',
            'new_storage_id' => null
        ]])
    </x-card-list>
    <div style="height: 200px"></div>
</x-app-layout>
</body>
</html>
