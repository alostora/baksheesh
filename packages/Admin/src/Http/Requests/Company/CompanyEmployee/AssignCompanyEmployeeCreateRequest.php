<?php

namespace Admin\Http\Requests\Company\CompanyEmployee;

use Illuminate\Foundation\Http\FormRequest;

class AssignCompanyEmployeeCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            'company_id' => ['required', 'uuid', 'exists:companies,id'],
        ];
    }
}
