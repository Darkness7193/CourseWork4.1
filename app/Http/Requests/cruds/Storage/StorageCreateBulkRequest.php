<?php

namespace App\Http\Requests\cruds\Storage;

use Illuminate\Foundation\Http\FormRequest;




class StorageCreateBulkRequest extends FormRequest
{
    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'new_rows.*.name' => 'required|string|max:100',

            'new_rows.*.address' => 'sometimes|string|max:100',
            'new_rows.*.phone_number' => 'sometimes|string|max:100',
            'new_rows.*.email' => 'sometimes|email|max:100',

            'new_rows.*.comment' => 'nullable|string|max:1000',
        ];
    }

    public function attributes() {
        return [
            'new_rows.*.name' => 'Наименование',

            'new_rows.*.address' => 'Адрес',
            'new_rows.*.phone_number' => 'Номер',
            'new_rows.*.email' => 'Эл. почта',

            'new_rows.*.comment' => 'Комментарий',
        ];
    }
}
