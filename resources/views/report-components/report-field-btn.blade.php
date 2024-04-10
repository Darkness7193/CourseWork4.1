<!-- import: -->
<link rel="stylesheet" href="{{ asset('css/abstract/report-components.css') }}">


<!-- f($is_cost_report): -->
<button class="report-component report-field-btn" onclick="document.getElementsByName('is_cost_report')[0].value='{{ !$is_cost_report }}'">
    @if($is_cost_report)
        Показывать количество
    @else
        Показывать стоимость
    @endif
</button>
<input hidden="hidden" name="is_cost_report" value="{{ $is_cost_report }}">

