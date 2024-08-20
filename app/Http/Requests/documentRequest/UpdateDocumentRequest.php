<?php

namespace App\Http\Requests\documentRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
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
            'name' => 'nullable|string',
            'path' => 'nullable|mimes:pdf,doc,docx,xls,xlsx',
            'date_created' => 'nullable|date|before_or_equal:today',
            'author' => 'nullable|string',
        ];
    }
}
