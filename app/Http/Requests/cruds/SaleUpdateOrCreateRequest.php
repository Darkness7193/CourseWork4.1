<?php

namespace App\Http\Requests\cruds;

use Illuminate\Foundation\Http\FormRequest;




class SaleUpdateOrCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'date' => 'filled|string|date',

            'product_id' => 'filled|integer|digits:8',
            'quantity' => 'filled|integer|digits:8',
            'price' => 'filled|numeric|min:0|max:100000000',

            'storage_id' => 'filled|integer|digits:8',
            'comment' => 'nullable|string|max:1000'
        ];
    }
}
