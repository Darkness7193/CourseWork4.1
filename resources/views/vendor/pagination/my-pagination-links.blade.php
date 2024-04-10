<link rel="stylesheet" href="{{ asset('css/my-pagination-links.css') }}">
<link rel="stylesheet" href="{{ asset('css/global.css') }}">


<nav>
    <form method="POST"
        action="{{ route('set_pagination_options', ['previous_route' => Route::current()->getName() ]) }}"
        class="search-form"
        autocomplete="off"
    >   @csrf

        <div class="paginator small text-muted">
            {!! __('Показать') !!}
            <input type="number" class="count-input" onfocus="this.select();" name='per_page' value="{{ $paginator->perPage() }}" onchange="this.form.submit()">
            {!! __('строк') !!}
            <input type="number" class="page-input" onfocus="this.select();" name='current_page' value="{{ $paginator->currentPage() }}" onchange="this.form.submit()">
            {!! __('страницы из') !!}
            @php($is_last_page_full = !($paginator->total() % $paginator->perPage()) )
            <span class="last-page-indicator fw-semibold">{{ $paginator->lastPage() + ($is_last_page_full ? 1 : 0) }}</span>
        </div>
    </form>
</nav>
