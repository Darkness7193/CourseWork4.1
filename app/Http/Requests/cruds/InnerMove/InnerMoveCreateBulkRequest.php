<?php

namespace App\Http\Requests\cruds\InnerMove;

use Illuminate\Foundation\Http\FormRequest;




class InnerMoveCreateBulkRequest extends FormRequest
{
    use CreateUpdate;

    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'new_rows.*.date' => 'required|string|date',

            'new_rows.*.product_move_type' => 'required|string|max:100',
            'new_rows.*.storage_id' => 'required|integer|digits_between:1,8',
            'new_rows.*.new_storage_id' => 'required|integer|digits_between:1,8',

            'new_rows.*.product_id' => 'required|integer|digits_between:1,8',
            'new_rows.*.quantity' => 'required|integer|digits_between:1,8',
            'new_rows.*.price' => 'required|numeric|min:0|max:100000000',

            'new_rows.*.comment' => 'nullable|string|max:1000',
        ];
    }

    public function attributes() {
        return [
            'new_rows.*.date' => 'Дата',

            'new_rows.*.product_move_type' => 'Тип',
            'new_rows.*.storage_id' => 'Склад (изначальный)',
            'new_rows.*.new_storage_id' => 'Склад (конечный)',

            'new_rows.*.product_id' => 'Товар',
            'new_rows.*.quantity' => 'Количество',
            'new_rows.*.price' => 'Цена',

            'new_rows.*.comment' => 'Комментарий',
        ];
    }
}
