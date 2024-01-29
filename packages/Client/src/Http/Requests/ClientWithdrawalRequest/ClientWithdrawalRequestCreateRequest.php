<?php

namespace Client\Http\Requests\ClientWithdrawalRequest;

use App\Constants\HasLookupType\WithdrawalRequestStatus;
use App\Models\ClientWithdrawalRequest;
use App\Models\CompanyCash;
use App\Models\EmployeeCash;
use App\Models\SystemLookup;
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

        $withDrawalRequestsAcceptedStatus = SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
            ->where('code', WithdrawalRequestStatus::ACCEPTED['code'])
            ->first()
            ->id;

        $withDrawalRequestsPendingStatus = SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
            ->where('code', WithdrawalRequestStatus::PENDING['code'])
            ->first()
            ->id;

        $companyCash = CompanyCash::where('client_id', auth()->id())->sum('amount');
        $employeeCash = EmployeeCash::where('client_id', auth()->id())->sum('amount');

        $totalCash = $companyCash + $employeeCash;

        $totalAcceptedRequest = ClientWithdrawalRequest::where('status', $withDrawalRequestsAcceptedStatus)
            ->where('client_id', auth()->id())
            ->sum('amount');

        $totalPendinfRequest = ClientWithdrawalRequest::where('status', $withDrawalRequestsPendingStatus)
            ->where('client_id', auth()->id())
            ->sum('amount');


        $avaiable_amount = $totalCash - ($totalAcceptedRequest + $totalPendinfRequest);

        return [

            "amount" => ["required", "integer", "max:" . $avaiable_amount],
        ];
    }
}
