<?php

namespace App\Http\Requests\cruds\Product;




trait CreateUpdate
{
    public function attributes() {
        return [
            'new_rows.*.name' => 'Наименование',

            'new_rows.*.manufactor' => 'Производитель',
            'new_rows.*.purchase_price' => 'Цена закупки',
            'new_rows.*.selling_price' => 'Цена продажи',

            'new_rows.*.comment' => 'Комментарий',
        ];
    }
}
