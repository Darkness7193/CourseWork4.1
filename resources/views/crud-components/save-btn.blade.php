<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/save-btn.css') }}">

<!-- f($controller, $no_view_fields): -->
<x-primary-button
    class="save-btn"
    type="button"
    onclick="submit_changes('{{ $controller }}', '{{ json_encode($no_view_fields) }}')"
    > Сохранить
</x-primary-button>

