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
                {{ __('Хоткеи') }}
            </h2>

            <x-card>
                <b>Enter, Enter+Shift:</b>
                <p>
                    После введения текста в поле таблицы и нажания на Enter каретка ввода текста перенесется на поле следующей колонки. При нажатии на Enter+Shift каретка перенесется на следующую строку.
                </p>
            </x-card>
            <x-card>
                <b>Зажатие ПКМ (Правая Кнопка Мыши):</b>
                <p>
                    После зажатия ПКМ над полем таблицы вы сможете скопировать значение поля в другое поле, перенеся на него курсор. Так же вы можете зажать ПКМ чтобы щелкнуть по кнопкам удаления строк и кнопкам направления сортировки
                </p>
            </x-card>
            <x-card>
                <b>Выбор товара:</b>
                <p>
                    Выбор товара автоматически вставляет цену продажи\покупки из таблицы товаров, если поле цены пустое
                </p>
            </x-card>
        </div>
    </x-card-list>
</x-app-layout>
</body>
