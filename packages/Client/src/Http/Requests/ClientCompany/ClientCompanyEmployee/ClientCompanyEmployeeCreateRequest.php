<?php

namespace Client\Http\Requests\ClientCompany\ClientCompanyEmployee;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientCompanyEmployeeCreateRequest extends FormRequest
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

            "address" => ["nullable", "string", "max:255"],

            'available_rating_ids' => ['required', 'array', 'max:5'],

            'available_rating_ids.*' => ['required', 'uuid', 'exists:system_lookups,id'],

            "employee_job_name" => ["required", "string", "max:255"],

            "country_id" => [

                "required", "uuid", "string",

                Rule::exists('countries', 'id')->where('type', CountryType::COUNTRY['code'])
            ],

            "governorate_id" => [

                "required", "uuid", "string",

                Rule::exists('countries', 'id')->where('type', CountryType::GOVERNORATE['code'])
            ],

            'file' => ['nullable', 'file'],
        ];
    }
}
