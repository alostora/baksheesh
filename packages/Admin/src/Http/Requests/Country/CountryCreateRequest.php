<?php

namespace Admin\Http\Requests\Country;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryCreateRequest extends FormRequest
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

            "name" => [
                "required", "string", "max:255",
                Rule::unique('countries', 'name')->where('type', CountryType::COUNTRY['code'])
            ],

            "name_ar" => [
                "required", "string", "max:255",
                Rule::unique('countries', 'name_ar')->where('type', CountryType::COUNTRY['code'])
            ],

            "phone_code" => ["nullable", "string", "max:5"],

            "flag" => ["nullable", "string", "max:255"],

            "prefix" => ["nullable", "string", "max:255"],

            "longitude" => ["nullable", "string", "max:255"],

            "latitude" => ["nullable", "string", "max:255"],

        ];
    }
}
