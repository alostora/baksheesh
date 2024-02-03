<?php

namespace Admin\Http\Requests\User;

use App\Constants\HasLookupType\UserAccountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
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

            "user_account_type_id" => [

                "bail", "required", "string", "uuid", "max:255",

                Rule::exists('system_lookups', 'id')->where('type', UserAccountType::LOOKUP_TYPE)
            ],

            "name" => ["bail", "required", "string", "max:255"],

            "email" => ["bail", "required", "email", "unique:users,email", "max:255"],

            "phone" => ["bail", "required", "string", "unique:users,phone", "max:255"],

            "password" => ["bail", "required", "string", "max:255"],

        ];
    }
}
