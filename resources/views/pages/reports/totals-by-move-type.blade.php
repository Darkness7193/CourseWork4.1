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
    <x-global-errors/>

    <x-card-list>
        <div>
            <x-card-header text="Отчет по типам движений"/>
            <x-card class="foot-margin">
                @if (isset($paginator) && count($paginator) > 0)
                    <table class="report-table" data-view-fields="{{ implode(',', $view_fields) }}">
                        <tr class="header-tr">
                            @foreach($headers as $header)
                                <th>{{ $header }}</th>
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
                                <td>{{ $total->write_off_totals }}</td>
                                <td class="report-field-td">{{ $is_cost_report ? '₽' : 'шт.' }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="table-tools-line horizontal-arrange vertical-center">
                        <x-table-tools.ordering-menu :$view_fields :$headers />
                        <x-table-tools.search-bar :$view_fields :$headers />
                        <div class="paginator-wrapper right-align">{{ $paginator->links('pagination::my-pagination-links') }}</div>
                    </div>
                @else
                    На указанном складе за указанный период перемещений товаров не было. Измените товар и период отчета
                @endif
            </x-card>

            <x-card>
                <div class="vertical-arrange vertical-center">
                    <form class="left-align">
                        <b class="report-settings-title">Настройки отчета</b>
                        <table class="report-settings">
                            <tr>
                                <td>Склад</td>
                                <td><x-report-components.report-storage-select :$Storage :$report_storage /></td>
                            </tr>
                            <tr>
                                <td>Начальная дата</td>
                                <td><input class="report-component" name="begin_date" type="date" onfocusout="this.form.submit()" value="{{ $begin_date }}"></td>
                            </tr>
                            <tr>
                                <td>Конечная дата</td>
                                <td><input class="report-component" name="end_date" type="date" onfocusout="this.form.submit()" value="{{ $end_date }}"></td>
                            </tr>
                            <tr>
                                <td>Единица измерения</td>
                                <td><x-report-components.report-field-btn :$is_cost_report /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </x-card>
        </div>
    </x-card-list>

    <div style="height: 200px"></div>
</x-app-layout>
</body>
</html>
