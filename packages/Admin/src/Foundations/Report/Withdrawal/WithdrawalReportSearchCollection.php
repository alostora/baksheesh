<?php

namespace Admin\Foundations\Report\Withdrawal;

use Admin\Foundations\Filter\FilterCollection;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\WithdrawalRequestStatusCollection;
use App\Models\User;

class WithdrawalReportSearchCollection
{
    public static function searcAllhWithdrawalRequests(
        $client_id = -1,
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['withdrawalRequests'] = WithdrawalReportQueryCollection::searchAllWithdrawalRequests(
            $client_id,
            $status,
            $amount,
            $date_from,
            $date_to
        )->paginate($per_page);



        $data['count_all'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus();

        $data['count_pending'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::pending()->id);

        $data['count_accepted'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::accepted()->id);

        $data['count_refused'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::refused()->id);

        $data['count_implemented'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::implemented()->id);

        $data['count_unexecutable'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::unexecutable()->id);


        $data['sum_all'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus();

        $data['sum_pending'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::pending()->id);

        $data['sum_accepted'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::accepted()->id);

        $data['sum_refused'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::refused()->id);

        $data['sum_implemented'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::implemented()->id);

        $data['sum_unexecutable'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::unexecutable()->id);


        if ($client_id && $client_id != -1) {

            $data['client_name'] = User::find($client_id)->name;

            $data['client_count_all'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(-1, $client_id);

            $data['client_count_pending'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::pending()->id, $client_id);

            $data['client_count_accepted'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::accepted()->id, $client_id);

            $data['client_count_refused'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::refused()->id, $client_id);

            $data['client_count_implemented'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::implemented()->id, $client_id);

            $data['client_count_unexecutable'] = WithdrawalReportQueryCollection::countWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::unexecutable()->id, $client_id);


            $data['client_sum_all'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(-1, $client_id);

            $data['client_sum_pending'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::pending()->id, $client_id);

            $data['client_sum_accepted'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::accepted()->id, $client_id);

            $data['client_sum_refused'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::refused()->id, $client_id);

            $data['client_sum_implemented'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::implemented()->id, $client_id);

            $data['client_sum_unexecutable'] = WithdrawalReportPrintQueryCollection::sumWithdrawalRequestByStatus(WithdrawalRequestStatusCollection::unexecutable()->id, $client_id);
        }


        $data['withdrawal_request_status'] = WithdrawalRequestStatusCollection::statusList();

        $data['clients'] = FilterCollection::clients();

        return $data;
    }
}
