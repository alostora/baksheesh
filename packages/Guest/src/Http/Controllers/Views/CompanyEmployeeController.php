<?php

namespace Guest\Http\Controllers\Views;

use Admin\Foundations\Company\CompanyEmployee\CompanyEmployeeSearchCollection;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{


    public function search(Request $request)
    {
        $data = CompanyEmployeeSearchCollection::searchCompanyEmployees(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Guest/CompanyEmployee/index', $data);
    }
}
