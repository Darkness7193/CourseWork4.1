<?php

namespace App\Http\Requests\cruds;

use Illuminate\Foundation\Http\FormRequest;




class InnerMoveUpdateBulkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
        ];
    }
}
