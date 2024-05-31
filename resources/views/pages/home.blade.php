<!DOCTYPE html><html lang="ru">@include('global-head')


<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @vite(['resources/css/breeze-base.css'])


<body>
<x-app-layout>
    <x-card-list>
        <div>
            <x-card-header text="Движения"/>
            <x-card>
                <div class="vertical-arrange">
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.purchases.crud') }}'">{{ __('Закупки') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.sales.crud') }}'">{{ __('Продажи') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.inner_moves.crud') }}'">{{ __('Внутренние движения') }}</x-responsive-nav-link>
                </div>
            </x-card>
        </div>

        <div>
            <x-card-header text="Отчеты"/>
            <x-card>
                <div class="vertical-arrange">
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.totals_by_move_type') }}'">{{ __('Отчет по типам движений') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.totals_by_month') }}'">{{ __('Отчет по месяцам') }}</x-responsive-nav-link>
                </div>
            </x-card>
        </div>

        <div>
            <x-card-header text="Справочник"/>
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
