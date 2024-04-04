<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class bedRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'bed_number' => ['required', 'integer' , 'unique:beds']
        ];

    }

    public function messages()
    {
        return [
            'bed_number.unique' => 'Bed number is already registered to the database'
        ];
    }
}
