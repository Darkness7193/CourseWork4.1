<?php

namespace App\Http\Requests\cruds\Product;

use Illuminate\Foundation\Http\FormRequest;




class ProductUpdateBulkRequest extends FormRequest
{
    use CreateUpdate;

    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'updated_rows.*.name' => 'filled|string|max:100',

            'updated_rows.*.manufactor' => 'filled|string|max:100',
            'updated_rows.*.purchase_price' => 'filled|numeric|min:0|max:100000000',
            'updated_rows.*.selling_price' => 'nullable|numeric|min:0|max:100000000',

            'updated_rows.*.comment' => 'nullable|string|max:1000',
        ];
    }
}
