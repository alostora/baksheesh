<?php

namespace Admin\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
{
    /**
     * Determine if the company is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            'client_id' => ['required', 'uuid', 'exists:users,id'],

            'name' => ['required', 'string', 'max:255'],

            'company_field' => ['required', 'string', 'max:255'],

            'available_rating_ids' => ['required', 'array', 'max:20'],

            'available_rating_ids.*' => ['required', 'uuid', 'exists:company_available_ratings,id'],

            'file' => ['required', 'file'],

        ];
    }
}
