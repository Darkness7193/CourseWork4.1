<?php

namespace App\Http\Requests\cruds;

use Illuminate\Foundation\Http\FormRequest;




class InnerMoveUpdateBulkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'date' => 'filled|string|date',

            'product_move_type' => 'filled|string|max:100',
            'storage_id' => 'filled|integer|digits:8',
            'new_storage_id' => 'filled|integer|digits:8',

            'product_id' => 'filled|integer|digits:8',
            'quantity' => 'filled|integer|digits:8',
            'price' => 'filled|numeric|min:0|max:100000000',

            'comment' => 'nullable|string|max:1000',
        ];
    }
}
