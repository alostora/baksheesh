<?php

namespace Admin\Foundations\Wallet;

use Admin\Foundations\Filter\FilterCollection;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\EmployeeCash;
use App\Models\User;

class EmployeeWalletSearchCollection
{
    public static function searchEmployeeWallets(
        $client_id = -1,
        $company_id = -1,
        $employee_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['wallets'] = EmployeeWalletQueryCollection::searchAllEmployeeWallets(
            $client_id,
            $company_id,
            $employee_id,
            $date_from,
            $date_to,
        )->paginate($per_page);

        //above table label info
        $data['count_total'] = EmployeeWalletQueryCollection::sumEmployeeCashAmount($client_id, $company_id, $employee_id);

        //print
        $data['all_employees_amount'] = EmployeeWalletQueryCollection::printAllEmployeesAmount();

        if ($client_id && $client_id != -1) {

            $clientEmployeesAmount = EmployeeWalletQueryCollection::printClientEmployeesAmount($client_id);
            $data['client_name'] = $clientEmployeesAmount['client_name'];
            $data['client_employees_amount'] = $clientEmployeesAmount['client_employees_amount'];
        }
        if ($company_id && $company_id != -1) {

            $oneCompanyEmployeesAmount = EmployeeWalletQueryCollection::printOneCompanyEmployeesAmount($company_id);
            $data['company_name'] = $oneCompanyEmployeesAmount['company_name'];
            $data['one_company_employees_amount'] = $oneCompanyEmployeesAmount['one_company_employees_amount'];
        }
        if ($employee_id && $employee_id != -1) {
            $oneEmployeeAmount = EmployeeWalletQueryCollection::printOneEmployeeAmount($employee_id);
            $data['employee_name'] = $oneEmployeeAmount['employee_name'];
            $data['one_employee_amount'] = $oneEmployeeAmount['one_employee_amount'];
        }

        //filters
        $data['clients'] = FilterCollection::clients();

        $data['companies'] = FilterCollection::companies($client_id);

        $data['employees'] = FilterCollection::employees($client_id, $company_id);

        return $data;
    }
}
