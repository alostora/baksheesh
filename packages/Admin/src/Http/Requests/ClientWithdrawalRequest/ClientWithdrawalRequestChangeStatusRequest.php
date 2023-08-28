<?php

namespace Admin\Http\Requests\ClientWithdrawalRequest;

use Illuminate\Foundation\Http\FormRequest;

class ClientWithdrawalRequestChangeStatusRequest extends FormRequest
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

            "status" => ["required", "string", "uuid", "exists:system_lookups,id"],

            "refuse_reasone" => ["nullable", "string", "max:255"],

            "notes" => ["nullable", "string", "max:255"],
        ];
    }
}
