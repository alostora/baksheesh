<?php

namespace Guest\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCash;
use App\Models\EmployeeCash;
use App\Models\User;
use Guest\Foundations\PaymentCollection;
use Guest\Http\Requests\PayForCompanyRequest;
use Guest\Http\Requests\PayForEmployeeRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function payForCompany(PayForCompanyRequest $request)
    {
        $validated = $request->validated();

        $url = $request->url() . '/' . $validated['company_id'];

        $url = url('guest/payment/pay-success');

        if (isset($validated['amount']) && $validated['amount'] > 0) {

            $response =  PaymentCollection::pay($request, $url);

            if ($response && $response->tran_ref) {

                // CompanyCash::create($validated);

                return redirect($response->redirect_url);
            } else {

                return redirect()->back()->with('warning', 'error!');
            }
        }

        return redirect()->back()->with('warning', 'error!');
    }

    public function payForEmployee(PayForEmployeeRequest $request)
    {
        $validated = $request->validated();

        $url = $request->url() . '/' . $validated['employee_id'];

        $url = url('guest/payment/pay-success');

        if (isset($validated['amount']) && $validated['amount'] > 0) {

            $response =  PaymentCollection::pay($request, $url);

            if ($response && $response->tran_ref) {

                // EmployeeCash::create($validated);

                return redirect($response->redirect_url);
            } else {
                return redirect()->back()->with('warning', 'error!');
            }
        }

        return redirect()->back()->with('warning', 'error!');
    }

    public function viewPaymentForEmployee(User $user, Request $request)
    {
        // return view('Guest/successPayment');

        if ($user->stopped_at) {

            return abort(404);
        }

        if (!$request->session()->has('guest_key')) {

            $request->session()->put('guest_key', str()->random(50));
        }

        $data['employee'] = $user;

        return view('Guest/EmployeePayment/paymentForEmployee', $data);
    }

    public function viewPaymentForCompany(Company $company, Request $request)
    {
        // return view('Guest/successPayment');

        if ($company->stopped_at) {
            return abort(404);
        }

        if (!$request->session()->has('guest_key')) {

            $request->session()->put('guest_key', str()->random(50));
        }

        $data['company'] = $company;

        return view('Guest/CompanyPayment/paymentForCompany', $data);
    }

    public function viewPaymentSuccessPage()
    {
        return view('Guest/successPayment');
    }
}
