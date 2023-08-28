<?php

namespace Client\Foundations\ClientWithdrawalRequest;

use App\Constants\SystemDefault;

class ClientWithdrawalRequestSearchCollection
{
    public static function searchWithdrawalRequests(
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = ClientWithdrawalRequestQueryCollection::searchAllClientWithdrawalRequests(
            $status,
            $amount,
            $date_from,
            $date_to
        );

        return $companies->paginate($per_page);
    }
}
