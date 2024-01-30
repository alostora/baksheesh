<?php

namespace Client\Foundations\Report\Withdrawal;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\WithdrawalRequestStatusCollection;
use App\Models\ClientWithdrawalRequest;

class WithdrawalReportSearchCollection
{

    public static function searchAllWithdrawalRequests(
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['withdrawalRequests'] = WithdrawalReportQueryCollection::searchAllWithdrawalRequests(
            $status,
            $amount,
            $date_from,
            $date_to
        )->paginate($per_page);


        $data['count_all'] = ClientWithdrawalRequest::where('client_id', auth()->id())->count();

        $data['count_pending'] = ClientWithdrawalRequest::where('client_id', auth()->id())->where('status', WithdrawalRequestStatusCollection::pending()->id)->count();

        $data['count_accepted'] = ClientWithdrawalRequest::where('client_id', auth()->id())->where('status', WithdrawalRequestStatusCollection::accepted()->id)->count();

        $data['count_refused'] = ClientWithdrawalRequest::where('client_id', auth()->id())->where('status', WithdrawalRequestStatusCollection::refused()->id)->count();

        $data['count_implemented'] = ClientWithdrawalRequest::where('client_id', auth()->id())->where('status', WithdrawalRequestStatusCollection::implemented()->id)->count();

        $data['count_unexecutable'] = ClientWithdrawalRequest::where('client_id', auth()->id())->where('status', WithdrawalRequestStatusCollection::unexecutable()->id)->count();

        $data['withdrawal_request_status'] = WithdrawalRequestStatusCollection::statusList();

        return $data;
    }
}
