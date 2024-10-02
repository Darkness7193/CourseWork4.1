<!DOCTYPE html>
<html lang="ru">


@props(['paginator', 'controller', 'page_title'=>'', 'view_fields', 'headers'])
<head>
    <title>{{ $page_title }}</title>
    @include('global-head')

    <!-- imports: -->
    @include('php_variables')
    <script src="{{ asset('js/of_crud-table/submit_changes.js') }}" type="module"></script>
    <script src="{{ asset('js/of_crud-table/disable_new_storage_field.js') }}" type="module"></script>

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
    <x-global-errors/>

    <x-card-list class="foot-margin">
        <div>
            <x-card-header text="{{ $page_title }}"/>
            <x-card>
                {{ $slot }}
                <div class="table-tools-line horizontal-arrange vertical-center">
                    <x-table-tools.ordering-menu :$view_fields :$headers />
                    <x-table-tools.search-bar :$view_fields :$headers />
                    <x-table-tools.excel-port-menu></x-table-tools.excel-port-menu>
                    <div class="paginator-wrapper right-align">{{ $paginator->links('pagination::my-pagination-links') }}</div>
                </div>
            </x-card>

            <x-crud-components.save-btn :$controller :no_view_fields="[
            'product_move_type' => 'purchasing',
            'new_storage_id' => null
        ]" />
        </div>
    </x-card-list>
    <div style="height: 200px;"></div>
</x-app-layout>
</body>
</html>
