<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormSchemaRequest extends FormRequest
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
            'form_id' => 'required|exists:forms,_id',
            'type' => 'required|string|max:255',
            'properties' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'form_id.required' => 'The form ID is required.',
            'form_id.exists' => 'The specified form ID does not exist.',
            'type.required' => 'The type field is required.',
            'type.string' => 'The type must be a string.',
            'type.max' => 'The type may not be greater than 255 characters.',
            'properties.required' => 'The properties field is required.',
            'properties.json' => 'The properties field must be a valid JSON format.',
        ];
    }
}
