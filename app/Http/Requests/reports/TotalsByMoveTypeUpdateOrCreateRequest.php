<?php

namespace App\Http\Requests\reports;

use Illuminate\Foundation\Http\FormRequest;




class TotalsByMoveTypeUpdateOrCreateRequest extends FormRequest
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
