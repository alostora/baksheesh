<?php

namespace Admin\Foundations\Report\Withdrawal;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Foundations\LookupType\WithdrawalRequestStatusCollection;
use App\Models\ClientWithdrawalRequest;
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

        $data['count_all'] = ClientWithdrawalRequest::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {
                $q
                    ->where('client_id', $client_id);
            }
        })->count();

        $data['count_pending'] = ClientWithdrawalRequest::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {
                $q
                    ->where('client_id', $client_id);
            }
        })->where('status', WithdrawalRequestStatusCollection::pending()->id)->count();

        $data['count_accepted'] = ClientWithdrawalRequest::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {
                $q
                    ->where('client_id', $client_id);
            }
        })->where('status', WithdrawalRequestStatusCollection::accepted()->id)->count();

        $data['count_refused'] = ClientWithdrawalRequest::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {
                $q
                    ->where('client_id', $client_id);
            }
        })->where('status', WithdrawalRequestStatusCollection::refused()->id)->count();

        $data['count_implemented'] = ClientWithdrawalRequest::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {
                $q
                    ->where('client_id', $client_id);
            }
        })->where('status', WithdrawalRequestStatusCollection::implemented()->id)->count();

        $data['count_unexecutable'] = ClientWithdrawalRequest::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {
                $q
                    ->where('client_id', $client_id);
            }
        })->where('status', WithdrawalRequestStatusCollection::unexecutable()->id)->count();



        $client_type = AccountTypeCollection::client();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['withdrawal_request_status'] = WithdrawalRequestStatusCollection::statusList();

        return $data;
    }
}
