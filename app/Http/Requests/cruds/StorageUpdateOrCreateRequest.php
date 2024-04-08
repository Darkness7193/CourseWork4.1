<?php

namespace App\Http\Requests\cruds;

use Illuminate\Foundation\Http\FormRequest;




class StorageUpdateOrCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'updated_rows.*.name' => 'filled|string|max:100',

            'updated_rows.*.address' => 'filled|string|max:100',
            'updated_rows.*.phone_number' => 'filled|string|max:100',
            'updated_rows.*.email' => 'filled|email|max:100',

            'updated_rows.*.comment' => 'nullable|string|max:1000',
        ];
    }
}
