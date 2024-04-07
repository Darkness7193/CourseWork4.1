<?php

namespace App\Http\Requests\cruds;

use Illuminate\Foundation\Http\FormRequest;




class PurchaseUpdateOrCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'asdf' => 'max:3'
        ];
    }
}
