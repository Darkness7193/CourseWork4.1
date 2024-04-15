<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">


@props(['style' => '', 'class' => ''])
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 {{ $class }}" style="{{ $style }}">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ $slot }}
        </div>
    </div>
</div>

