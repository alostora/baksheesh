<?php

namespace Guest\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRatingRequest extends FormRequest
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

            "guest_key" => ["bail", "required"],

            "rating_id" => ["bail", "required", "uuid", "string", "exists:employee_available_ratings,id"],

            "rating_value" => ["bail", "required", "integer", "min:1", "max:2"],

            "payer_name" => ["bail", "nullable", "string", "max:255"],

            "payer_email" => ["bail", "nullable", "email", "unique:users,email", "max:255"],

            "payer_phone" => ["bail", "nullable", "string", "unique:users,phone", "max:255"],
        ];
    }
}
