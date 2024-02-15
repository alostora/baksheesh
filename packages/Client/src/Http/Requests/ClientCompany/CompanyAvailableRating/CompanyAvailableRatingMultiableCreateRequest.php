<?php

namespace Client\Http\Requests\ClientCompany\CompanyAvailableRating;

use Illuminate\Foundation\Http\FormRequest;

class CompanyAvailableRatingMultiableCreateRequest extends FormRequest
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

            'ratings' => ['array', 'required'],

            "ratings.*.name" => ["required", "string", "max:255"],

            "ratings.*.name_ar" => ["required", "string", "max:255"],
        ];
    }
}
