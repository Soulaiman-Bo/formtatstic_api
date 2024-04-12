<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateworkspaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The workspace name is required.',
            'name.string' => 'The workspace name must be a string.',
            'name.max' => 'The workspace name may not be greater than 255 characters.',
            'name.min' => 'The workspace name should be greater than 2 characters.',
        ];
    }
}
