<!DOCTYPE html><html lang="ru">@include('global-head')
<script>
    window.post_to_get_route_route = '{{ route('post_to_get_route') }}'
    window.current_route = '{{ Route::current()->getName() }}'
</script>


<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/abstract/tile-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/report.css') }}">


<body>
<table class="tile-table report" data-view-fields="{{ implode(',', $view_fields) }}">
    <tr>
        @foreach($headers as $header)
            <th>{{ mb_strtoupper($header) }}</th>
        @endforeach
    </tr>

    @foreach ($totals as $total)
        <tr>
            <td>{{ $total->product_name }}</td>

            <td>{{ $total->cost }}</td>
            <td>{{ $total->quantity }}</td>

            @php($seasons = ['winter-td', 'spring-td', 'summer-td', 'fall-td', 'winter-td'])
            @for ($i=1; $i<13; $i++)
                <td class="{{ $seasons[intdiv($i, 3)] }}">{{ $total->{"quantity_by_month_$i"} ?: '' }}</td>
            @endfor
        </tr>
    @endforeach
</table>


<div>{{ $totals->links('pagination::my-pagination-links') }}</div>

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
