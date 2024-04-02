<!DOCTYPE html><html lang="ru">@include('global-head')


<!-- imports: -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @vite(['resources/css/breeze-base.css'])



<body>
<x-app-layout>
    <div class="py-12 vertical-arrange">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-card>
                <div class="vertical-arrange">
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.purchases_crud') }}'">{{ __('Покупки') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.sales_crud') }}'">{{ __('Продажи') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.inner_moves_crud') }}'">{{ __('Внутренние движения') }}</x-responsive-nav-link>
                </div>
            </x-card>

            <x-card>
                <div class="vertical-arrange">
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.totals_by_move_type') }}'">{{ __('Отчет по типам движений') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('product_moves.totals_by_month') }}'">{{ __('Отчет по месяцам') }}</x-responsive-nav-link>
                </div>
            </x-card>

            <x-card>
                <div class="vertical-arrange">
                    <x-responsive-nav-link onclick="window.location='{{ route('products.crud') }}'">{{ __('Товары') }}</x-responsive-nav-link>
                    <x-responsive-nav-link onclick="window.location='{{ route('storages.crud') }}'">{{ __('Склады') }}</x-responsive-nav-link>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
</body>
