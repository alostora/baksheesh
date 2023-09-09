<?php

namespace Admin\Foundations\Wallet\ClientWithdrawalRequest;

use App\Constants\SystemDefault;
use App\Models\User;

class ClientWithdrawalRequestSearchCollection
{
    public static function searchWithdrawalRequests(
        User $user,
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = ClientWithdrawalRequestQueryCollection::searchAllClientWithdrawalRequests(
            $user,
            $status,
            $amount,
            $date_from,
            $date_to
        );

        return $companies->paginate($per_page);
    }

    public static function searcAllhWithdrawalRequests(
        $client_id = -1,
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = ClientWithdrawalRequestQueryCollection::searchAllWithdrawalRequests(
            $client_id,
            $status,
            $amount,
            $date_from,
            $date_to
        );

        return $companies->paginate($per_page);
    }
}
