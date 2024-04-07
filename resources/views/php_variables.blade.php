<script>
    window.php_vars = {
        'update_bulk_route': '{{ route('update_bulk') }}',
        'create_bulk_route': '{{ route('create_bulk') }}',
        'delete_bulk_route': '{{ route('delete_bulk') }}',
        'post_to_get_route_route': '{{ route('post_to_get_route') }}',
        'current_route': '{{ Route::current()->getName() }}',

        'img_delete_on': "{{ asset('images/delete-on.png') }}",
        'img_delete_off': "{{ asset('images/delete-off.png') }}",

        'per_page': Number('{{ $paginator->perPage() }}'),
        'page_count': Number('{{ $paginator->count() }}')
    }
</script>
