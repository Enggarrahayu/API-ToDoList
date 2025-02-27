<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChecklistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'completed' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Checklist title is required.',
            'title.max' => 'Checklist title must not exceed 255 characters.',
            'completed.boolean' => 'Completed must be a boolean value.',
        ];
    }
}
