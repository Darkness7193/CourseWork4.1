<?php

namespace App\Http\Requests\cruds\InnerMove;




trait CreateUpdate
{
    public function attributes() {
        return [
            'new_rows.*.date' => 'Дата',

            'new_rows.*.product_move_type' => 'Тип',
            'new_rows.*.storage_id' => 'Склад (начальный)',
            'new_rows.*.new_storage_id' => 'Склад (конечный)',

            'new_rows.*.product_id' => 'Товар',
            'new_rows.*.quantity' => 'Количество',
            'new_rows.*.price' => 'Цена',

            'new_rows.*.comment' => 'Комментарий',
        ];
    }
}
