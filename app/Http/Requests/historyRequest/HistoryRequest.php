<?php

namespace App\Http\Requests\historyRequest;

use Illuminate\Foundation\Http\FormRequest;

class HistoryRequest extends FormRequest
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
            'action' => 'required|string|in:UPDATE,ARCHIVE,CREATE,SHOW,',
            'action_date' => 'required|datetime|before_or_equal:today',
        ];
    }
}
