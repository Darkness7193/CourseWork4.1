<!DOCTYPE html>
<html lang="ru">


<head>
    <title> Закупки </title>
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
            <table class="crud-table" data-max-id="{{ $ProductMove::max('id') }}"
                   data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $ProductMove }}">
                <tr>
                    @foreach($headers as $header)
                        <th>{{ mb_strtoupper($header) }}</th>
                    @endforeach

                    <th>@include('crud-components.activate-delete-btns-btn')</th>
                </tr>

                @foreach (array_merge($paginator->items(), $filler_rows) as $purchase)
                    <tr data-row-id="{{ $purchase->id }}">
                        <td><input type="date" value="{{ $purchase->date->toDateString() }}"
                                   onfocusout="update_cell_of(this)"></td>

                        <td>
                            <select class="foreign-cell product-select" onfocusout="update_cell_of(this)">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id ?? '' }}"
                                            data-purchase-price="{{ $product->purchase_price }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach

                                <option selected="selected" hidden="hidden"
                                        value="{{ $purchase->product->id ?? ''}}">{{ $purchase->product->name ?? '' }}</option>
                            </select>
                        </td>

                        <td><input type="number" value="{{ $purchase->quantity }}" onfocusout="update_cell_of(this)">
                        </td>
                        <td><input class="purchase-price-input" type="number" step="0.01" value="{{ $purchase->price }}"
                                   onfocusout="update_cell_of(this)"></td>

                        <td>@include('crud-components.foreign-cell', ['selected_foreign_row' => $purchase->storage, 'foreign_rows' => $storages])</td>
                        <td class="comment-td"><input type="text" value="{{ $purchase->comment }}"
                                                      onfocusout="update_cell_of(this)"></td>

                        <td>@include('crud-components.delete-btn')</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="{{ count($view_fields) }}">
                        <div class="table-tools-line horizontal-arrange vertical-center">
                            @include('table-tools.ordering-menu', compact('view_fields', 'headers'))
                            @include('table-tools.search-bar', compact('view_fields', 'headers'))
                            <div class="paginator-wrapper">{{ $paginator->links('pagination::my-pagination-links') }}</div>

                            <div class="right-align">
                                @include('crud-components.save-btn', ['controller' => 'InnerMove', 'no_view_fields' => [
                                    'product_move_type' => 'purchasing',
                                    'new_storage_id' => null
                                ]])
                            </div>
                        </div>
                    </td>
                    <td></td>
                </tr>
            </table>
        </x-card>
    </x-card-list>
    <div style="height: 200px"></div>
</x-app-layout>
</body>
</html>
