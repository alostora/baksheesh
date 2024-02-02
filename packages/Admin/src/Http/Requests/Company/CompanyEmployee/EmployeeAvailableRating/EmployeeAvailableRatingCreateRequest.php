<?php

namespace Admin\Http\Requests\Company\CompanyEmployee\EmployeeAvailableRating;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeAvailableRatingCreateRequest extends FormRequest
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

            "name" => ["required", "string", "max:255"],

            "name_ar" => ["required", "string", "max:255"],
        ];
    }
}
