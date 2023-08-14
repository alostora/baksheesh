<?php

namespace Admin\Http\Requests\Company\CompanyEmployee;

use Illuminate\Foundation\Http\FormRequest;

class CompanyEmployeeCreateRequest extends FormRequest
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
            'company_id' => ['required', 'uuid', 'exists:companies,id'],

            "name" => ["required", "string", "max:255"],

            "email" => ["required", "email", "unique:users,email", "max:255"],

            "phone" => ["required", "string", "unique:users,phone", "max:255"],

            "password" => ["required", "string", "max:255"],

            "address" => ["required", "string", "max:255"],
        ];
    }
}
