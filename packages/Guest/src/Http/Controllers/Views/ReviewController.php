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
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{

    public function payForCompany(PayForCompanyRequest $request)
    {
        $validated = $request->validated();

        $validated['payment_type'] = PaymentFor::COMPANY['code'];

        $validated['main_url'] = $request->url() . '/' . $validated['company_id'];

        $url = url('guest/payment/pay-success?validated_data=' . json_encode($validated));

        if (isset($validated['amount']) && $validated['amount'] > 0) {

            $response =  PaymentCollection::pay($validated['amount'], $url);

            Log::info([$response]);

            if ($response && isset($response->code) && $response->code == 4) {

                $amount = 12.60;

                sleep(5);

                $response =  PaymentCollection::pay($amount, $url);
            }

            if ($response && isset($response->tran_ref)) {

                return redirect($response->redirect_url);
            }
        }

        return redirect()->back()->with('warning', 'error!');
    }

    public function payForEmployee(PayForEmployeeRequest $request)
    {
        $validated = $request->validated();

        $validated['payment_type'] = PaymentFor::EMPLOYEE['code'];

        $validated['main_url'] = $request->url() . '/' . $validated['employee_id'];

        $url = url('guest/payment/pay-success?validated_data=' . json_encode($validated));

        if (isset($validated['amount']) && $validated['amount'] > 0) {

            $response =  PaymentCollection::pay($validated['amount'], $url);

            Log::info([$response]);

            if ($response && isset($response->code) && $response->code == 4) {

                $amount = 12.60;

                sleep(5);

                $response =  PaymentCollection::pay($amount, $url);
            }

            if ($response && isset($response->tran_ref)) {

                return redirect($response->redirect_url);
            }

            return redirect($validated['main_url'])->with('warning', 'error!');
        }

        return redirect($validated['main_url'])->with('warning', 'error!');
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

        $validated = json_decode($request->validated_data);

        $data['status'] = GneralBooleanStatus::FAILED['code'];

        $data['url'] = $validated->main_url;

        $tran_ref = $request->tranRef;

        if ($request->respStatus == "A") {

            $response =  PaymentCollection::checkPayStatus($tran_ref);

            if ($response && $response->payment_result) {

                $payment['client_id']  = $validated->client_id;
                $payment['company_id'] = $validated->company_id;
                $payment['amount']     = $validated->amount;
                $payment['payer_name'] = $response->customer_details->name;
                $payment['payer_email'] = $response->customer_details->email;
                $payment['payer_phone'] = $response->customer_details->phone;

                if ($validated->payment_type == PaymentFor::COMPANY['code']) {

                    CompanyCash::create($payment);
                } elseif ($validated->payment_type == PaymentFor::EMPLOYEE['code']) {

                    $payment['employee_id'] = $validated->employee_id;

                    EmployeeCash::create($payment);
                }

                $data['status'] = GneralBooleanStatus::SUCCESS['code'];
            }
        }

        return view('Guest/successPayment', $data);
    }
}
