<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNurseRequest extends FormRequest
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
            'f_name' => ['required', 'string', 'alpha'],
            'l_name' => ['required', 'string', 'alpha'],
            'gender' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'unique:nurses', 'regex:/^255[0-9]{9}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.regex' => 'The phone number must be in the format 255XXXXXXXXX.',
        ];
    }
}
