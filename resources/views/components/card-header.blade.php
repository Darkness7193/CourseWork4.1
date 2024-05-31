<!-- import: -->
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">


@props(['text', 'class' => '', 'style' => ''])
<h2 class="card-header text-lg font-medium text-gray-900 dark:text-gray-100 {{ $class }}" style="{{ $style }}">
    {{ $text }}
</h2>
