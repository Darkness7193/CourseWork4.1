<?php

namespace App\Http\Requests\cruds\Storage;

use Illuminate\Foundation\Http\FormRequest;




class StorageCreateBulkRequest extends FormRequest
{
    use CreateUpdate;

    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'new_rows.*.name' => 'required|string|max:100',

            'new_rows.*.address' => 'required|string|max:100',
            'new_rows.*.phone_number' => 'required|string|max:100',
            'new_rows.*.email' => 'required|email|max:100',

            'new_rows.*.comment' => 'nullable|string|max:1000',
        ];
    }
}