<link rel="stylesheet" href="{{ asset('css/my-pagination-links.css') }}">
<link rel="stylesheet" href="{{ asset('css/global.css') }}">


<nav>
    <form method="POST"
        action="{{ route('post_to_get_route', ['target_route' => Route::current()->getName()]) }}"
        class="search-form"
        autocomplete="off"
    >   @csrf

        <div class="paginator small text-muted">
            {!! __('Показать') !!}
            <input type="number" class="count-input" onfocus="this.select();" name='per_page' value="{{ $paginator->perPage() }}" onchange="this.form.submit()">
            {!! __('строк') !!}
            <input type="number" class="page-input" onfocus="this.select();" name='current_page' value="{{ $paginator->currentPage() }}" onchange="this.form.submit()">
            {!! __('страницы из') !!}
            <span class="last-page-indicator fw-semibold">{{ $paginator->lastPage() }}</span>
        </div>
    </form>
</nav>
