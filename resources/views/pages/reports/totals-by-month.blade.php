<!DOCTYPE html>
<html lang="ru">


<head>
    <title> Отчет по месяцам </title>
    @include('global-head')

    <!-- imports: -->
    @include('php_variables')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/report-table.css') }}">
</head>


<body>
<x-app-layout>
    <x-global-errors/>

    <x-card-list>
        <div>
            <x-card-header text="Отчет по месяцам"/>
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

                                <td class="year-td">{{ $total->year_totals }}</td>
                                @php($seasons = ['winter-td', 'spring-td', 'summer-td', 'fall-td', 'winter-td'])
                                @for ($i=1; $i<13; $i++)
                                    <td class="{{ $seasons[intdiv($i, 3)] }}">{{ $total->{"month_{$i}_totals"} }}</td>
                                @endfor
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
                    На указанном складе за этот год перемещений товаров такого типа не было. Измените склад, год или тип отчета
                @endif
            </x-card>

            <x-card>
                <div class="vertical-arrange vertical-center">
                    <form class="left-align">
                        <p class="report-settings-title">Настройки отчета</p>
                        <table class="report-settings">
                            <tr>
                                <td>Склад</td>
                                <td><x-report-components.report-storage-select :$Storage :$report_storage /></td>
                            </tr>
                            <tr>
                                <td>Тип перемещения товаров</td>
                                <td><x-report-components.report-type-select :$current_report_type /></td>
                            </tr>
                            <tr>
                                <td>Год</td>
                                <td><x-report-components.report-year-select :$used_years :$report_year /></td>
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
