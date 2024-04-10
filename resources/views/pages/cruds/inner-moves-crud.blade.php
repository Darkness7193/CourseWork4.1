<!DOCTYPE html>
<html lang="ru">


<head>
    <title> Внутренние движения </title>
    @include('global-head')

    <!-- imports: -->
    @include('php_variables')
    <script src="{{ asset('js/of_crud-table/submit_changes.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/disable_new_storage_field.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/delete-btn_bulk_activation.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/auto_table_input_refocus.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/copy_input_value_by_hold.js') }}" type="module"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/crud-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/foreign-cell.css') }}">
</head>


<body>
<x-app-layout>
    @include('global-errors')

    <x-card-list>
        <x-card>
            @include('crud-components.save-btn', ['controller' => 'InnerMove', 'no_view_fields' => [
                'product_move_type' => 'purchasing',
                'new_storage_id' => null
            ]])
            @include('table-tools.search-bar', compact('view_fields', 'headers'))
            @include('table-tools.ordering-menu', compact('view_fields', 'headers'))
        </x-card>

        <x-card class="foot-margin">
            <table class="crud-table" data-max-id="{{ $ProductMove::max('id') }}"
                   data-view-fields="{{ implode(',', $view_fields) }}" data-crud-model="{{ $ProductMove }}">
                <tr>
                    @foreach($headers as $header)
                        <th>{{ mb_strtoupper($header) }}</th>
                    @endforeach

                    <th>@include('crud-components.activate-delete-btns-btn')</th>
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

                        <td>@include('crud-components.foreign-cell', ['selected_foreign_row' => $inner_move->storage, 'foreign_rows' => $storages])</td>
                        <td>
                            @include('crud-components.foreign-cell', ['class' => 'new-storage-select', 'foreign_rows' => $storages] + (
                                "$inner_move->product_move_type" === 'transfering'
                                    ? ['selected_foreign_row' => $inner_move->new_storage]
                                    : ['parameters' => 'disabled="true"'])
                            )
                        </td>

                        <td>@include('crud-components.foreign-cell', ['selected_foreign_row' => $inner_move->product, 'foreign_rows' => $products])</td>
                        <td><input type="number" value="{{ $inner_move->quantity }}" onfocusout="update_cell_of(this)">
                        </td>
                        <td><input type="number" step="0.01" value="{{ $inner_move->price }}"
                                   onfocusout="update_cell_of(this)"></td>

                        <td class="comment-td"><input type="text" value="{{ $inner_move->comment }}"
                                                      onfocusout="update_cell_of(this)"></td>

                        <td>@include('crud-components.delete-btn')</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="{{ count($view_fields) }}">
                        <div class="paginator-wrapper">{{ $paginator->links('pagination::my-pagination-links') }}</div>
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
