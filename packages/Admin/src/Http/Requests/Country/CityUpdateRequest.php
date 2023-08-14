<?php

namespace Admin\Http\Requests\Country;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CityUpdateRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [

            "name" => [
                "nullable", "string", "max:255",

                Rule::unique('countries', 'name')->where('type', CountryType::CITY['code'])->ignore($request->city->id, 'id')
            ],

            "name_ar" => [
                "nullable", "string", "max:255",

                Rule::unique('countries', 'name_ar')->where('type', CountryType::CITY['code'])->ignore($request->city->id, 'id')
            ],

            "prefix" => ["nullable", "string", "max:255"],

            "longitude" => ["nullable", "string", "max:255"],

            "latitude" => ["nullable", "string", "max:255"],

        ];
    }
}
