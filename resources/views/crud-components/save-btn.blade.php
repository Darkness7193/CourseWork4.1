

<!-- f($controller, $no_view_fields): -->
<button
    id="save-btn"
    type="button"
    onclick="submit_changes('{{ $controller }}', '{{ json_encode($no_view_fields) }}')"
    > Сохранить
</button>
