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

                        <td class="year-td">{{ $total->year_totals }}</td>
                        @php($seasons = ['winter-td', 'spring-td', 'summer-td', 'fall-td', 'winter-td'])
                        @for ($i=1; $i<13; $i++)
                            <td class="{{ $seasons[intdiv($i, 3)] }}">{{ $total->{"month_{$i}_totals"} }}</td>
                        @endfor
                        <td class="report-field-td"> @if($is_cost_report)
                                ₽
                            @else
                                шт.
                            @endif</td>
                    </tr>
                @endforeach
            </table>
            <div class="table-tools-line horizontal-arrange vertical-center">
                <x-table-tools.ordering-menu :$view_fields :$headers />
                <x-table-tools.search-bar :$view_fields :$headers />
                <div class="paginator-wrapper right-align">{{ $paginator->links('pagination::my-pagination-links') }}</div>
            </div>
        </x-card>

        <x-card>
            <div class="vertical-arrange vertical-center">
                <form class="horizontal-arrange left-align">
                    <x-report-components.report-storage-select :$Storage :$report_storage />
                    <x-report-components.report-type-select :$current_report_type />
                    <x-report-components.report-year-select :$used_years :$report_year />
                    <x-report-components.report-field-btn :$is_cost_report />
                </form>
            </div>
        </x-card>
    </x-card-list>
    <div style="height: 200px"></div>
</x-app-layout>
</body>
</html>
