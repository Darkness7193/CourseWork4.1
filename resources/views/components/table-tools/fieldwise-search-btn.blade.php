<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/table-tools/fieldwise-search-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/abstract/dropdown.css') }}">
    <script src="{{ asset('js/of_component/of_dropdown.js') }}" type="module"></script>


@props(['view_fields', 'headers'])
<div class="fieldwise-search-btn dropdown icon">
    <button class="drop-btn icon" type="button" onclick="toggle_dropdown_content(this)"></button>
    <div class="fieldwise-search-menu dropdown-content">
        <table>
            @php($headers = array_merge($headers, ['created_at' => '# по созданию', 'updated_at' => '# по изменению']))
            @foreach($headers as $view_field => $header)
                <tr>
                    <td class="header-td">{{ $header }}:</td>
                    <td><input class="fieldwise-search-input"
                        name="{{ $view_field }}_search_target"
                        type="text"
                        onfocus="this.select();" value="{{ session('search_targets')['fieldwise'][$view_field] ?? '' }}"
                    ></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
