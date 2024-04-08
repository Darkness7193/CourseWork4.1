<?php

namespace App\Http\Requests\cruds\InnerMove;

use Illuminate\Foundation\Http\FormRequest;




class InnerMoveCreateBulkRequest extends FormRequest
{
    public function authorize(): bool {return true;}


    public function rules(): array
    {
        return [
            'new_rows.*.date' => 'required|string|date',

            'new_rows.*.product_move_type' => 'required|string|max:100',
            'new_rows.*.storage_id' => 'required|integer|digits:8',
            'new_rows.*.new_storage_id' => 'required|integer|digits:8',

            'new_rows.*.product_id' => 'required|integer|digits:8',
            'new_rows.*.quantity' => 'required|integer|digits:8',
            'new_rows.*.price' => 'required|numeric|min:0|max:100000000',

            'new_rows.*.comment' => 'nullable|string|max:1000',
        ];
    }
}
