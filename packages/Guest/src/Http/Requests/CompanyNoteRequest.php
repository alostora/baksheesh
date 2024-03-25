<?php

namespace Guest\Http\Requests;

use App\Constants\HasLookupType\UserAccountType;
use App\Models\SystemLookup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyNoteRequest extends FormRequest
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

        $lookup_account_type_client = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('key', UserAccountType::CLIENT['key'])
            ->first();

        return [

            "guest_key" => ["bail", "required"],

            "client_id" => [

                "required", "uuid", "string",

                Rule::exists('users', 'id')->where('user_account_type_id', $lookup_account_type_client->id)
            ],

            "company_id" => ["required", "uuid", "string", "exists:companies,id"],

            "notes" => ["bail", "required", "string", "unique:users,phone", "max:255"],

            "payer_name" => ["bail", "nullable", "string", "max:255"],

            "payer_email" => ["bail", "nullable", "email", "unique:users,email", "max:255"],

            "payer_phone" => ["bail", "nullable", "string", "unique:users,phone", "max:255"],

        ];
    }
}
