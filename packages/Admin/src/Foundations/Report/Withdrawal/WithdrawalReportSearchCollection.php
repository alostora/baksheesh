<?php

namespace Admin\Foundations\Report\Withdrawal;

use App\Constants\SystemDefault;

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
        $companies = WithdrawalReportQueryCollection::searchAllWithdrawalRequests(
            $client_id,
            $status,
            $amount,
            $date_from,
            $date_to
        );

        return $companies->paginate($per_page);
    }
}
