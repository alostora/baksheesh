<?php

namespace Admin\Http\Requests\Company\CompanyAvailableRating;

use Illuminate\Foundation\Http\FormRequest;

class CompanyAvailableRatingCreateRequest extends FormRequest
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

            "name_ar" => ["required", "string", "max:255"],
        ];
    }
}
