<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreformRequest extends FormRequest
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
    public function rules()
    {
        return [
            'workspace_id' => 'required|exists:workspaces,_id',
            'owner_id' => 'required|exists:users,_id',
            'name' => 'required|string|max:255|min:2',
            'description' => 'nullable|string|min:2|max:1000',
            'visits' => 'sometimes|integer|min:0',
            'submittions' => 'sometimes|integer|min:0',
            'fields' => 'nullable|json',
            'published' => 'sometimes|in:true,false',
        ];
    }
    
    public function messages()
{
    return [
        'workspace_id.required' => 'The workspace ID is required.',
        'workspace_id.exists' => 'The specified workspace does not exist.',

        'name.required' => 'The name of the form is required.',
        'name.string' => 'The name must be a string.',
        'name.max' => 'The name may not be greater than 255 characters.',
        'name.min' => 'The name should be greater than 2 characters.',


        'description.string' => 'The description must be a string.',
        'description.max' => 'The description may not be greater than 1000 characters.',
        'description.min' => 'The description should be greater than 2 characters.',

        'visits.integer' => 'Visits must be an integer.',
        'visits.min' => 'Visits must be at least 0.',

        'submittions.integer' => 'Submissions must be an integer.',
        'submittions.min' => 'Submissions must be at least 0.',

        'fields.json' => 'The fields must be a valid JSON format.',

        'published.in' => 'The published status must be either true or false.',
    ];
}

}
