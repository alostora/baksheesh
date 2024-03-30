<?php

namespace Guest\Http\Controllers\Views;

use App\Constants\GneralBooleanStatus;
use App\Constants\PaymentFor;
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

        $url = url('guest/payment/pay-success');

        if (isset($validated['amount']) && $validated['amount'] > 0) {

            $response =  PaymentCollection::pay($request, $url);

            if ($response && $response->tran_ref) {

                $validated['payment_type'] = PaymentFor::COMPANY['code'];

                $validated['main_url'] = $request->url() . '/' . $validated['company_id'];

                $validated['tran_ref'] = $response->tran_ref;

                $request->session()->put('validated', $validated);

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

        $url = url('guest/payment/pay-success');

        if (isset($validated['amount']) && $validated['amount'] > 0) {

            $response =  PaymentCollection::pay($request, $url);

            if ($response && $response->tran_ref) {

                $validated['payment_type'] = PaymentFor::EMPLOYEE['code'];

                $validated['main_url'] = $request->url() . '/' . $validated['employee_id'];

                $validated['tran_ref'] = $response->tran_ref;

                $request->session()->put('validated', $validated);

                return redirect($response->redirect_url);
            } else {
                return redirect()->back()->with('warning', 'error!');
            }
        }

        return redirect()->back()->with('warning', 'error!');
    }

    public function viewPaymentForEmployee(User $user, Request $request)
    {

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

        if ($company->stopped_at) {
            return abort(404);
        }

        if (!$request->session()->has('guest_key')) {

            $request->session()->put('guest_key', str()->random(50));
        }

        $data['company'] = $company;

        return view('Guest/CompanyPayment/paymentForCompany', $data);
    }

    public function viewPaymentSuccessPage(Request $request)
    {


        $data['status'] = GneralBooleanStatus::FAILED['code'];

        if ($request->session()->has('validated')) {


            $validated = $request->session()->get('validated');

            $tran_ref = $validated['tran_ref'];

            // $tran_ref = 'SFT2408607608115';

            $response =  PaymentCollection::checkPayStatus($tran_ref);

            $data['url'] = $validated['main_url'];

            if ($response && $response->payment_result) {

                if ($response->payment_result->response_status == 'A') {

                    $validated['payer_name'] = $response->customer_details->name;
                    $validated['payer_email'] = $response->customer_details->email;
                    $validated['payer_phone'] = $response->customer_details->phone;

                    if ($validated['payment_type'] == PaymentFor::COMPANY['code']) {

                        CompanyCash::create($validated);
                    } elseif ($validated['payment_type'] == PaymentFor::EMPLOYEE['code']) {

                        EmployeeCash::create($validated);
                    }

                    $data['status'] = GneralBooleanStatus::SUCCESS['code'];
                } elseif ($response->payment_result->response_status == 'D') {

                    $data['status'] = GneralBooleanStatus::FAILED['code'];
                }
            }
        }

        $request->session()->forget('validated');

        return view('Guest/successPayment', $data);
    }
}
