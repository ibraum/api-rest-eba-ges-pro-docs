<?php

namespace App\Http\Requests\projectRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'libel' => 'nullable|string',
            'client_name' => 'nullable|string',
            'begin_date' => 'nullable|date|before_or_equal:today',
            'end_date' => 'nullable|date'
        ];
    }
}
