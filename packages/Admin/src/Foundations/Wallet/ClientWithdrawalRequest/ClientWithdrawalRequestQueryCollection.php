<?php

namespace Admin\Foundations\Wallet\ClientWithdrawalRequest;

use App\Constants\SystemDefault;
use App\Models\ClientWithdrawalRequest;
use App\Models\User;
use Carbon\Carbon;

class ClientWithdrawalRequestQueryCollection
{
    public static function searchAllClientWithdrawalRequests(
        User $user,
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return ClientWithdrawalRequest::where('client_id', $user->id)

            ->where(function ($q) use ($status, $amount, $date_from, $date_to) {

                if ($status && $status != -1) {

                    $q
                        ->where('status', $status);
                }

                if ($amount && $amount != -1) {

                    $q
                        ->where('amount', $amount);
                }

                if ($date_from && $date_from != -1 && $date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create($date_from),

                            Carbon::create($date_to)->endOfDay()
                        ]);
                } else if ($date_from && $date_from != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create($date_from)->startOfDay(),

                            Carbon::create(3000, 01, 01)
                        ]);
                } else if ($date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create(1900, 01, 01),

                            Carbon::create($date_to)->endOfDay()
                        ]);
                }
            })
            ->orderBy('created_at', $sort);
    }

    public static function searchAllWithdrawalRequests(
        $client_id,
        $status = -1,
        $amount = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return ClientWithdrawalRequest::where(function ($q) use ($client_id, $status, $amount, $date_from, $date_to) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }

            if ($status && $status != -1) {

                $q
                    ->where('status', $status);
            }

            if ($amount && $amount != -1) {

                $q
                    ->where('amount', $amount);
            }

            if ($date_from && $date_from != -1 && $date_to && $date_to != -1) {

                $q
                    ->whereBetween('created_at', [

                        Carbon::create($date_from),

                        Carbon::create($date_to)->endOfDay()
                    ]);
            } else if ($date_from && $date_from != -1) {

                $q
                    ->whereBetween('created_at', [

                        Carbon::create($date_from)->startOfDay(),

                        Carbon::create(3000, 01, 01)
                    ]);
            } else if ($date_to && $date_to != -1) {

                $q
                    ->whereBetween('created_at', [

                        Carbon::create(1900, 01, 01),

                        Carbon::create($date_to)->endOfDay()
                    ]);
            }
        })
            ->orderBy('created_at', $sort);
    }
}
