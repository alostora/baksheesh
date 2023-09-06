<?php

namespace Admin\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
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

            "name" => ["nullable", "string", "max:255"],

            "phone" => [
                "nullable", "string", "max:255",

                Rule::unique('users', 'phone')->ignore($request->user->id, 'id')
            ],

            "email" => [
                "nullable", "string", "max:255",

                Rule::unique('users', 'email')->ignore($request->user->id, 'id')
            ],

            "password" => ["nullable", "string", "max:255"],

            "available_companies_count" => ["bail", "required", "integer", "max:1000"],

            "available_employees_count" => ["bail", "required", "integer", "max:1000"],

            "address" => ["nullable", "string", "max:255"],
        ];
    }
}
