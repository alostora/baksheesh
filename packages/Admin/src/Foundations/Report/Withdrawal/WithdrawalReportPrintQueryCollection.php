<?php

namespace Admin\Foundations\Report\Withdrawal;

use App\Models\ClientWithdrawalRequest;

class WithdrawalReportPrintQueryCollection
{
    public static function sumWithdrawalRequestByStatus($status_id = -1, $client_id = -1)
    {
        return ClientWithdrawalRequest::where(function ($q) use ($status_id, $client_id) {

            if ($client_id && $client_id != -1) {
                $q
                    ->where('client_id', $client_id);
            }

            if ($status_id && $status_id != -1) {
                $q
                    ->where('status', $status_id);
            }
        })->sum('amount');
    }
}
