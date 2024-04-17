<!DOCTYPE html><html lang="ru">@include('global-head')


<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @vite(['resources/css/breeze-base.css'])


<body>
<x-app-layout>
    <x-card-list>
        <div>
            <h2 class="card-header text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Движения') }}
            </h2>
            <x-card>
                <div class="vertical-arrange">
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.purchases_crud') }}'">{{ __('Закупки') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.sales_crud') }}'">{{ __('Продажи') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.inner_moves_crud') }}'">{{ __('Внутренние движения') }}</x-responsive-nav-link>
                </div>
            </x-card>
        </div>

        <div>
            <h2 class="card-header text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Отчеты') }}
            </h2>
            <x-card>
                <div class="vertical-arrange">
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.totals_by_move_type') }}'">{{ __('Отчет по типам движений') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.totals_by_month') }}'">{{ __('Отчет по месяцам') }}</x-responsive-nav-link>
                </div>
            </x-card>
        </div>

        <div>
            <h2 class="card-header text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Справочник') }}
            </h2>
            <x-card>
                <div class="vertical-arrange">
                    <x-responsive-nav-link onclick="window.location='{{ route('products.crud') }}'">{{ __('Товары') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('storages.crud') }}'">{{ __('Склады') }}</x-responsive-nav-link>
                    @can('access user page')
                        <x-responsive-nav-link onclick="window.location='{{ route('users.crud') }}'">{{ __('Пользователи') }}</x-responsive-nav-link>
                    @endcan
                </div>
            </x-card>
        </div>
    </x-card-list>
</x-app-layout>
</body>
