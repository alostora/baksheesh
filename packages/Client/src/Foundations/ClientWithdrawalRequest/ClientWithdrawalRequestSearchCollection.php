<?php

namespace Client\Foundations\ClientWithdrawalRequest;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\WithdrawalRequestStatusCollection;
use App\Models\ClientWithdrawalRequest;

class ClientWithdrawalRequestSearchCollection
{
    public static function searchWithdrawalRequests(
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['withdrawalRequests'] = ClientWithdrawalRequestQueryCollection::searchAllClientWithdrawalRequests(
            $status,
            $amount,
            $date_from,
            $date_to,
            $sort
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
