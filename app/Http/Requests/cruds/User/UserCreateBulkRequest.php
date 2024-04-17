<?php

namespace App\Http\Requests\cruds\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserCreateBulkRequest extends FormRequest
{
    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [
            'new_rows.*.name' => 'required|string|max:100',
            'new_rows.*.surname' => 'sometimes|string|max:100',
            'new_rows.*.last_name' => 'sometimes|string|max:100',
            'new_rows.*.password' => 'required|string|max:255',

            'new_rows.*.email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'new_rows.*.phone_number' => 'sometimes|string|max:100',

            'new_rows.*.comment' => 'nullable|string|max:1000'
        ];
    }

    public function attributes() {
        return [
            'new_rows.*.name' => 'Имя',
            'new_rows.*.surname' => 'Фамилия',
            'new_rows.*.last_name' => 'Отчество',
            'new_rows.*.password' => 'пароль',

            'new_rows.*.email' => 'Эл. почта',
            'new_rows.*.phone_number' => 'Номер',

            'new_rows.*.comment' => 'Комментарий'
        ];
    }
}
