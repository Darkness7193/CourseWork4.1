<!DOCTYPE html><html lang="ru">@include('global-head')


<!-- imports: -->
    @include('another/php_variables')
    <script src="{{ asset('js/of_crud-table/auto_new_tr.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/delete-btn_bulk_activation.js') }}" type="module"></script>
    <link rel="stylesheet" href="{{ asset('css/crud-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">


<body>
<table class="crud-table" data-max-id="{{ $max_id }}" data-view-fields="{{ implode(',', $view_fields) }}">
    <tr>
        @foreach($headers as $header)
            <th>{{ mb_strtoupper($header) }}</th>
        @endforeach

        <th>@include('crud-components.activate-delete-btns-btn')</th>
    </tr>

    @foreach ($sales as $sale)
        @include('crud-components.product-move-crud-tr', [
            'row' => $sale,
            'products' => $products,
            'storages' => $storages
        ])
    @endforeach

    @if (($sales->count() < $sales->perPage()) || !$sales->hasPages())
        @include('crud-components.product-move-crud-tr', [
            'row' => $emptyRow,
            'products' => $products,
            'storages' => $storages,
            'is_create_tr' => true,
            'paginator' => $sales
        ])
    @endif
</table>


<div>{{ $sales->links('pagination::my-pagination-links') }}</div>
@include('crud-components.save-btn', ['no_view_fields' => [
    'product_move_type' => 'selling',
    'new_storage_id' => null
]])
@include('table-tools.search-bar', [
    'search_targets' => $search_targets,
    'view_fields' => $view_fields,
    'headers' => $headers
])
@include('table-tools.ordering-menu', [
    'view_fields' => $view_fields,
    'headers' => $headers
])

</body>
</html>