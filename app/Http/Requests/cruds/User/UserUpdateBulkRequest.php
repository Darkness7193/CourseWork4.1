<?php

namespace App\Http\Requests\cruds\User;

use Illuminate\Foundation\Http\FormRequest;




class UserUpdateBulkRequest extends FormRequest
{
    public function authorize(): bool {return true;}

    public function rules(): array
    {
        return [

        ];
    }

    public function attributes() {
        return [

        ];
    }
}
