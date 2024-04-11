<?php

namespace App\Http\Requests\cruds\Product;

use Illuminate\Foundation\Http\FormRequest;




class ProductCreateBulkRequest extends FormRequest
{
    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'new_rows.*.name' => 'required|string|max:100',

            'new_rows.*.manufactor' => 'required|string|max:100',
            'new_rows.*.purchase_price' => 'required|numeric|min:0|max:100000000',
            'new_rows.*.selling_price' => 'nullable|numeric|min:0|max:100000000',

            'new_rows.*.comment' => 'nullable|string|max:1000',
        ];
    }

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
