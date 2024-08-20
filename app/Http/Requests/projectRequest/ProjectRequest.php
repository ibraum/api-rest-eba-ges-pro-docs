<?php

namespace App\Http\Requests\projectRequest;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'libel' => 'required|string',
            'client_name' => 'required|string',
            'begin_date' => 'required|date|before_or_equal:today',
            'end_date' => 'nullable|date'
        ];
    }
}
