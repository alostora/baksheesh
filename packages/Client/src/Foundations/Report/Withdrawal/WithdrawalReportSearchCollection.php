<?php

namespace Client\Foundations\Report\Withdrawal;

use Admin\Foundations\Report\Withdrawal\WithdrawalReportPrintQueryCollection;
use Admin\Foundations\Report\Withdrawal\WithdrawalReportQueryCollection as AdminWithdrawalReportQueryCollection;
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
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['withdrawalRequests'] = WithdrawalReportQueryCollection::searchAllWithdrawalRequests(
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



        $data['client_name'] = auth()->user()->name;

        $data['client_count_all'] = AdminWithdrawalReportQueryCollection::countWithdrawalRequestByStatus(-1, auth()->id());

        $data['client_count_pending'] = AdminWithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::pending()->id, auth()->id());

        $data['client_count_accepted'] = AdminWithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::accepted()->id, auth()->id());

        $data['client_count_refused'] = AdminWithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::refused()->id, auth()->id());

        $data['client_count_implemented'] = AdminWithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::implemented()->id, auth()->id());

        $data['client_count_unexecutable'] = AdminWithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::unexecutable()->id, auth()->id());


        $data['client_sum_all'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(-1, auth()->id());

        $data['client_sum_pending'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::pending()->id, auth()->id());

        $data['client_sum_accepted'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::accepted()->id, auth()->id());

        $data['client_sum_refused'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::refused()->id, auth()->id());

        $data['client_sum_implemented'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::implemented()->id, auth()->id());

        $data['client_sum_unexecutable'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::unexecutable()->id, auth()->id());

        return $data;
    }
}
