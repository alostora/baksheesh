<?php

namespace Client\Http\Requests\ClientWithdrawalRequest;

use Illuminate\Foundation\Http\FormRequest;

class ClientWithdrawalRequestCreateRequest extends FormRequest
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

            "amount" => ["required", "integer", "max:1000000"],
        ];
    }
}
