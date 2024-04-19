<?php

namespace App\Http\Requests\cruds\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserUpdateBulkRequest extends FormRequest
{
    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'updated_rows.*.name' => 'exclude',
            'updated_rows.*.surname' => 'exclude',
            'updated_rows.*.last_name' => 'exclude',
            'updated_rows.*.role' => 'filled|string|max:100',
            'updated_rows.*.password' => 'exclude',

            'updated_rows.*.email' => 'exclude',
            'updated_rows.*.phone_number' => 'exclude',

            'updated_rows.*.comment' => 'nullable|string|max:1000'
        ];
    }

    public function attributes() {
        return [
            'updated_rows.*.name' => 'Имя',
            'updated_rows.*.surname' => 'Фамилия',
            'updated_rows.*.last_name' => 'Отчество',
            'updated_rows.*.role' => 'Роль',
            'updated_rows.*.password' => 'Пароль',

            'updated_rows.*.email' => 'Эл. почта',
            'updated_rows.*.phone_number' => 'Номер',

            'updated_rows.*.comment' => 'Комментарий'
        ];
    }
}
