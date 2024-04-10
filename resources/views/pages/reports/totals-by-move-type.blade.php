<!DOCTYPE html>
<html lang="ru">


<head>
    <title> Отчет по типам движений </title>
    @include('global-head')

    <!-- imports: -->
    @include('php_variables')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/report-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/report-components.css') }}">
</head>


<body>
<x-app-layout>
    <x-card-list>
        <x-card>
            <div class="vertical-arrange vertical-center">
                <form class="horizontal-arrange left-align" style="padding-bottom: 8px">
                    @include('report-components.report-storage-select', compact('Storage', 'report_storage'))
                    <input class="report-component" name="begin_date" type="date" onfocusout="this.form.submit()" value="{{ $begin_date }}">
                    <input class="report-component" name="end_date" type="date" onfocusout="this.form.submit()" value="{{ $end_date }}">
                    @include('report-components.report-field-btn', compact('is_cost_report'))
                </form>
                <div class="horizontal-arrange left-align">
                    @include('table-tools.search-bar', compact('view_fields', 'headers'))
                    @include('table-tools.ordering-menu', compact('view_fields', 'headers'))
                </div>
            </div>
        </x-card>

        <x-card class="foot-margin">
            <table class="report-table" data-view-fields="{{ implode(',', $view_fields) }}">
                <tr>
                    @foreach($headers as $header)
                        <th>{{ mb_strtoupper($header) }}</th>
                    @endforeach
                </tr>

                @foreach ($paginator as $total)
                    <tr>
                        <td>{{ $total->product_name }}</td>

                        <td>{{ $total->purchases_totals }}</td>
                        <td>{{ $total->sales_totals }}</td>
                        <td>{{ $total->quantity_totals }}</td>
                        <td>{{ $total->liquidating_totals }}</td>
                        <td>{{ $total->inventory_totals }}</td>
                        <td>{{ $total->import_totals }}</td>
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
