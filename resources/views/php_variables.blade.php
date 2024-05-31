<script>
    window.php_vars = {
        'save_crud_route': '{{ route('save_crud') }}',
        'post_to_get_route_route': '{{ route('post_to_get_route') }}',
        'current_route': '{{ Route::current()->getName() }}',

        'img_delete_on': "{{ asset('images/delete-on.png') }}",
        'img_delete_off': "{{ asset('images/delete-off.png') }}",
        'trash_can_icon' : "{{ asset('images/trash-can-icon.jpg') }}",
        'un_trash_can_icon' : "{{ asset('images/un-trash-can-icon.png') }}",

        'excel_icon' : "{{ asset('images/excel-icon.png') }}",

        'per_page': Number('{{ $paginator->perPage() }}'),
        'page_count': Number('{{ $paginator->count() }}')
    }
</script>
