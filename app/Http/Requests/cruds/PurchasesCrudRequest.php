<?php

namespace App\Http\Requests\cruds;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PurchasesCrudRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'asdf' => 'max:3'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        // $ViewErrorBag = new ViewErrorBag;
        // $ViewErrorBag->put('default', $validator->errors());
        // session()->put('errors', $ViewErrorBag);


        parent::failedValidation($validator);
    }
}
