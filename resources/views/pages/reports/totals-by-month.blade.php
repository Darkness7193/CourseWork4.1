<!DOCTYPE html>
<html lang="ru">


<head>
    <title> Отчет по месяцам </title>
    @include('global-head')

    <!-- imports: -->
    @include('php_variables')
    <link rel="stylesheet" href="{{ asset('css/abstract/tile-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/report-table.css') }}">
</head>


<body>
<x-app-layout>
    <x-card-list>
        <x-card>
            @include('table-tools.search-bar', compact('search_targets', 'view_fields', 'headers'))
            @include('table-tools.ordering-menu', compact('view_fields', 'headers'))

            <form class="vertical-arrange" style="max-width: 200px">
                @include('report-components.report-storage-select', compact('Storage', 'report_storage'))
                @include('report-components.report-year-select', compact('used_years', 'report_year'))
                @include('report-components.report-field-btn', compact('is_cost_report'))
                @include('report-components.report-type-select', compact('current_report_type'))
            </form>
        </x-card>

        <x-card class="foot-margin">
            <table class="tile-table report-table" data-view-fields="{{ implode(',', $view_fields) }}">
                <tr>
                    @foreach($headers as $header)
                        <th>{{ mb_strtoupper($header) }}</th>
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
                        <td class="report-field-td">@if($is_cost_report)
                                ₽
                            @else
                                шт.
                            @endif</td>
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
</x-app-layout>
</body>
</html>
