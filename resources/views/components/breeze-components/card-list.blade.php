

@props(['style' => ''])
<div class="py-12 vertical-arrange" style="{{ $style }}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        {{ $slot }}
    </div>
</div>
