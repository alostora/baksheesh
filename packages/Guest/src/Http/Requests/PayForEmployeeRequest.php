<?php

namespace Guest\Http\Requests;

use App\Foundations\LookupType\AccountTypeCollection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PayForEmployeeRequest extends FormRequest
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

        $lookup_account_type_employee = AccountTypeCollection::employee();

        $lookup_account_type_client = AccountTypeCollection::client();

        return [

            "client_id" => [

                "required", "uuid", "string",

                Rule::exists('users', 'id')->where('user_account_type_id', $lookup_account_type_client->id)
            ],

            "company_id" => ["required", "uuid", "string", "exists:companies,id"],

            "employee_id" => [

                "required", "uuid", "string",

                Rule::exists('users', 'id')->where('user_account_type_id', $lookup_account_type_employee->id)
            ],

            "amount" => ["bail", "required", "numeric", "min:12", "max:100000"],

            "payer_name" => ["bail", "nullable", "string", "max:255"],

            "payer_phone" => ["bail", "nullable", "string", "max:255"],

            "notes" => ["bail", "nullable", "string", "max:255"],
        ];
    }
}
