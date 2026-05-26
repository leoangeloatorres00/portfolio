<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmailRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'message' => strip_tags($this->input('message'))
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email:rfc,dns',
            'name' => 'required|string|max:20',
            'message' => 'required|string|min:10|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email is required.',
            'name.required' => 'The name is required',
            'message.required' => 'The message is required',
            'message.min' => 'The message must be at least 10 characters',
            'message.max' => 'Your message is too long. Please keep it under 500 characters.',
            'name.max' => 'Your name is too long. Please keep it under 20 characters.',
            'email.email' => 'Please provide a valid, working email address.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Force dump the errors immediately to your browser/network monitor
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
