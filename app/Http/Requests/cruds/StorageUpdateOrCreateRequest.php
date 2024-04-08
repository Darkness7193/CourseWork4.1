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
            'name' => 'filled|string|max:100',

            'address' => 'filled|string|max:100',
            'phone_number' => 'filled|string|max:100',
            'email' => 'filled|email|max:100',

            'comment' => 'nullable|string|max:1000',
        ];
    }
}
