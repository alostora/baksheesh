<?php

namespace Client\Http\Requests\ClientCompany;

use Illuminate\Foundation\Http\FormRequest;

class ClientCompanyCreateRequest extends FormRequest
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

            'name' => ['required', 'string', 'max:255'],

            'company_field' => ['required', 'string', 'max:255'],

            'file' => ['nullable', 'file'],

            'available_rating_ids' => ['required', 'array', 'max:20'],

            'available_rating_ids.*' => ['required', 'uuid', 'exists:company_available_ratings,id'],
        ];
    }
}
