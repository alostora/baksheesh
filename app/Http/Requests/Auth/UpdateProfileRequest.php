<?php

namespace App\Http\Requests\Auth;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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

            "name" => ["bail", "required", "string", "max:255"],

            "phone" => [
                "bail", "required", "string", "max:255",

                Rule::unique('users', 'phone')->ignore(auth()->user()->id, 'id')
            ],

            "email" => [
                "bail", "required", "string", "max:255",

                Rule::unique('users', 'email')->ignore(auth()->user()->id, 'id')
            ],

            "country_id" => [

                "required", "uuid", "string",

                Rule::exists('countries', 'id')->where('type', CountryType::COUNTRY['code'])
            ],

            "address" => ["bail", "nullable", "string", "max:255"],

            'file_id' => ['bail', 'nullable', 'string', 'uuid', 'exists:files,id'],

        ];
    }
}
