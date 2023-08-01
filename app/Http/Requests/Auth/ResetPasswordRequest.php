<?php

namespace App\Http\Requests\Auth;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResetPasswordRequest extends FormRequest
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

            'email' => ['bail', 'required', 'string', 'email', 'exists:users,email', 'max:100'],

            'password' => ['bail', 'required', 'string', 'max:100'],

            'confirm_password' => ['same:password'],

            'reset_password_code' => [

                'bail', 'required', 'string', 'max:6',

                Rule::exists('users')->where(function (Builder $query) use ($request) {

                    return $query->where([

                        'reset_password_code' => $request->reset_password_code,

                        'email' => $request->email,
                    ]);
                }),
            ],
        ];
    }
}
