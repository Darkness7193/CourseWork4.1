<?php

namespace App\Http\Requests\cruds\Storage;




trait CreateUpdate
{
    public function attributes() {
        return [
            'new_rows.*.name' => 'Наименование',

            'new_rows.*.address' => 'Адрес',
            'new_rows.*.phone_number' => 'Номер',
            'new_rows.*.email' => 'Эл. почта',

            'new_rows.*.comment' => 'Комментарий',
        ];
    }
}
