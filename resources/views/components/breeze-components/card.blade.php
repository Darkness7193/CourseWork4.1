<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">


@props(['style' => '', 'class' => ''])
<div class="card {{ $class }}" style="{{ $style }}">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ $slot }}
        </div>
    </div>
</div>

