<?php

namespace App\Http\Requests\cruds\Purchase;

use Illuminate\Foundation\Http\FormRequest;




class PurchaseUpdateBulkRequest extends FormRequest
{
    use CreateUpdate;

    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'updated_rows.*.date' => 'filled|string|date',

            'updated_rows.*.product_id' => 'filled|integer|digits_between:1,8',
            'updated_rows.*.quantity' => 'filled|integer|digits_between:1,8',
            'updated_rows.*.price' => 'filled|numeric|min:0|max:100000000',

            'updated_rows.*.storage_id' => 'filled|integer|digits_between:1,8',
            'updated_rows.*.comment' => 'nullable|string|max:1000'
        ];
    }

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
