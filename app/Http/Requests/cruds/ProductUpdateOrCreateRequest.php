<?php

namespace App\Http\Requests\cruds;

use Illuminate\Foundation\Http\FormRequest;




class ProductUpdateOrCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'filled|string|max:100',

            'manufactor' => 'filled|string|max:100',
            'purchase_price' => 'filled|numeric|min:0|max:100000000',
            'selling_price' => 'nullable|numeric|min:0|max:100000000',

            'comment' => 'nullable|string|max:1000',
        ];
    }
}
