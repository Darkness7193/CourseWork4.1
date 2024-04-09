<?php

namespace App\Http\Requests\cruds\Purchase;




trait CreateUpdate
{
    public function attributes() {
        return [
            'updated_rows.*.date' => 'Поступило',

            'updated_rows.*.product_id' => 'Товар',
            'updated_rows.*.quantity' => 'Кол-во',
            'updated_rows.*.price' => 'Цена',

            'updated_rows.*.storage_id' => 'Склад',
            'updated_rows.*.comment' => 'Комментарий',
        ];
    }
}
