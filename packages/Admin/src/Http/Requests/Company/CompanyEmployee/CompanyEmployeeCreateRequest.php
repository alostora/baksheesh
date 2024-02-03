<?php

namespace Admin\Http\Requests\Company\CompanyEmployee;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

            "employee_job_name" => ["required", "string", "max:255"],

            // "country_id" => [

            //     "required", "uuid", "string",

            //     Rule::exists('countries', 'id')->where('type', CountryType::COUNTRY['code'])
            // ],

            // "governorate_id" => [

            //     "required", "uuid", "string",

            //     Rule::exists('countries', 'id')->where('type', CountryType::GOVERNORATE['code'])
            // ],

            'file' => ['required', 'file'],

            'available_rating_ids' => ['required', 'array', 'max:20'],

            'available_rating_ids.*' => ['required', 'uuid', 'exists:employee_available_ratings,id'],
        ];
    }
}
