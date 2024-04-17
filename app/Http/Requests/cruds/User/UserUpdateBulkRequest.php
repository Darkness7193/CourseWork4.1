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
            'new_rows.*.name' => 'exclude',
            'new_rows.*.surname' => 'exclude',
            'new_rows.*.last_name' => 'exclude0',
            'new_rows.*.password' => 'exclude',

            'new_rows.*.email' => 'exclude',
            'new_rows.*.phone_number' => 'exclude',

            'new_rows.*.comment' => 'nullable|string|max:1000'
        ];
    }

    public function attributes() {
        return [

        ];
    }
}
