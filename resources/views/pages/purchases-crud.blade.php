<!DOCTYPE html><html lang="ru">@include('global-head')
<script>
    window.update_or_create_in_bulk_route = '{{ route('product_moves.bulk_update_or_create') }}'
    window.delete_in_bulk_route = '{{ route('product_moves.bulk_delete') }}'
    window.post_to_get_route_route = '{{ route('post_to_get_route') }}'
    window.current_route = '{{ Route::current()->getName() }}'
    window.img_up_ordering = "{{ asset('images/up-ordering-icon.png') }}"
    window.img_down_ordering = "{{ asset('images/down-ordering-icon.png') }}"
    window.img_delete_on = "{{ asset('images/delete-on.png') }}"
    window.img_delete_off = "{{ asset('images/delete-off.png') }}"
</script>


<!-- imports: -->
    <script src="{{ asset('js/of_crud-table/auto_new_tr.js') }}" type="module"></script>
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

    @foreach ($purchases as $purchase)
        @include('crud-components.product-move-crud-tr', [
            'row' => $purchase,
            'products' => $products,
            'storages' => $storages
        ])
    @endforeach

    @if ($purchases->count() < $purchases->perPage())
        @include('crud-components.product-move-crud-tr', [
            'row' => $emptyRow,
            'products' => $products,
            'storages' => $storages,
            'is_create_tr' => true,
        ])
        <script type="module">
            window.per_page = Number('{{ $purchases->perPage() }}')
            window.page_count = Number('{{ $purchases->count() }}')
            let crud_table = document.getElementsByClassName('crud-table')[0]
            let last_tr = crud_table.rows[crud_table.rows.length - 1]
            last_tr.onchange = ()=>{ auto_new_tr() }
            set_next_row_id(last_tr)
        </script>
    @endif
</table>


<div>{{ $purchases->links('pagination::my-pagination-links') }}</div>

@include('crud-components.save-btn', ['no_view_fields' => [
    'product_move_type' => 'purchasing',
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


<script src="{{ asset('js/of_crud-table/delete_btn_bulk_activation.js') }}" type="module"></script>
