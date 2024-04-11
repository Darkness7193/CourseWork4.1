<?php

namespace App\Http\Requests\cruds\Storage;

use Illuminate\Foundation\Http\FormRequest;




class StorageUpdateBulkRequest extends FormRequest
{
    public function authorize(): bool {return true;}

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

    public function attributes() {
        return [
            'updated_rows.*.name' => 'Наименование',

            'updated_rows.*.address' => 'Адрес',
            'updated_rows.*.phone_number' => 'Номер',
            'updated_rows.*.email' => 'Эл. почта',

            'updated_rows.*.comment' => 'Комментарий',
        ];
    }
}
