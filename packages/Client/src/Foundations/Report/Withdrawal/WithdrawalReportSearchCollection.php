<?php

namespace Client\Foundations\Report\Withdrawal;

use App\Constants\SystemDefault;

class WithdrawalReportSearchCollection
{

    public static function searcAllhWithdrawalRequests(
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $withdrawalReports = WithdrawalReportQueryCollection::searchAllWithdrawalRequests(
            $status,
            $amount,
            $date_from,
            $date_to
        );

        return $withdrawalReports->paginate($per_page);
    }
}
