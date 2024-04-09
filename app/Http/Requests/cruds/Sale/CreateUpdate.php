<?php

namespace App\Http\Requests\cruds\Sale;




trait CreateUpdate
{
    public function attributes() {
        return [
            'new_rows.*.date' => 'Дата',

            'new_rows.*.product_id' => 'Товар',
            'new_rows.*.quantity' => 'Количество',
            'new_rows.*.price' => 'Цена',

            'new_rows.*.storage_id' => 'Склад',
            'new_rows.*.comment' => 'Комментарий'
        ];
    }
}
