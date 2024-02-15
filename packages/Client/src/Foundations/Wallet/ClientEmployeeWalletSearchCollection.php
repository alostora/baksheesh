<?php

namespace Client\Foundations\Wallet;

use Admin\Foundations\Filter\FilterCollection;
use Admin\Foundations\Wallet\EmployeeWalletQueryCollection;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\EmployeeCash;
use App\Models\User;

class ClientEmployeeWalletSearchCollection
{
    public static function searchEmployeeWallets(
        $company_id = -1,
        $employee_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['wallets'] = ClientEmployeeWalletQueryCollection::searchAllEmployeeWallets(
            $company_id,
            $employee_id,
            $date_from,
            $date_to,
        )->paginate($per_page);

        //above table label info
        $data['count_total'] = ClientEmployeeWalletQueryCollection::sumEmployeeCashAmount($company_id, $employee_id);

        //print
        $data['all_employees_amount'] = ClientEmployeeWalletQueryCollection::printAllEmployeesAmount();


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

        $data['companies'] = FilterCollection::companies(auth()->id());

        $data['employees'] = FilterCollection::employees(auth()->id());

        return $data;
    }
}
