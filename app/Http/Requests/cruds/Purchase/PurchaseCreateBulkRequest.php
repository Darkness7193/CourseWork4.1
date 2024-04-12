<?php

namespace App\Http\Requests\cruds\Purchase;

use Illuminate\Foundation\Http\FormRequest;




class PurchaseCreateBulkRequest extends FormRequest
{
    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'new_rows.*.date' => 'required|string|date',

            'new_rows.*.product_id' => 'required|integer|digits_between:1,8',
            'new_rows.*.quantity' => 'required|integer|digits_between:1,8',
            'new_rows.*.price' => 'required|numeric|min:0|max:100000000',

            'new_rows.*.storage_id' => 'required|integer|digits_between:1,8',
            'new_rows.*.comment' => 'nullable|string|max:1000'
        ];
    }

    public function attributes() {
        return [
            'new_rows.*.date' => 'Закуплено',

            'new_rows.*.product_id' => 'Товар',
            'new_rows.*.quantity' => 'Кол-во',
            'new_rows.*.price' => 'Цена',

            'new_rows.*.storage_id' => 'Склад',
            'new_rows.*.comment' => 'Комментарий',
        ];
    }
}
