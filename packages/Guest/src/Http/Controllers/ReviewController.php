<?php

namespace Guest\Http\Controllers;

use App\Constants\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCash;
use App\Models\CompanyRating;
use App\Models\EmployeeCash;
use App\Models\EmployeeRating;
use App\Models\User;
use Guest\Http\Requests\PayForCompanyRequest;
use Guest\Http\Requests\PayForEmployeeRequest;
use Guest\Http\Resources\PayForCompanyResource;
use Guest\Http\Resources\PayForEmployeeResource;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function payForCompany(PayForCompanyRequest $request)
    {
        return $request->all();

        $companyCash = CompanyCash::create($request->validated());

        return response()->success(
            trans('payment.payment_created_successfully'),
            new PayForCompanyResource($companyCash),
            StatusCode::OK
        );
    }

    public function payForEmployee(PayForEmployeeRequest $request)
    {

        return $request->all();
        $employeeCash = EmployeeCash::create($request->validated());

        return response()->success(
            trans('payment.payment_created_successfully'),
            new PayForEmployeeResource($employeeCash),
            StatusCode::OK
        );
    }

    public function companyRating(Request $request, Company $company)
    {

        $rating = CompanyRating::where([

            'guest_ip' => $request->ip(),

            'company_id' => $company->id,

            'rating_id' => $request->rating_id,

        ])->first();

        if ($rating) {

            $rating->update([

                'guest_ip' => $request->ip(),

                'client_id' => $company->client_id,

                'company_id' => $company->id,

                'rating_id' => $request->rating_id,

                'rating_value' => $request->rating_value,

            ]);
        } else {

            $rating = CompanyRating::create([

                'guest_ip' => $request->ip(),

                'client_id' => $company->client_id,

                'company_id' => $company->id,

                'rating_id' => $request->rating_id,

                'rating_value' => $request->rating_value,

            ]);
        }

        return response()->success(
            trans('payment.company_rated_successfully'),
            $rating,
            StatusCode::OK
        );
    }

    public function employeeRating(Request $request, User $user)
    {

        $rating = EmployeeRating::where([
            'guest_ip' => $request->ip(),

            'employee_id' => $user->id,

            'rating_id' => $request->rating_id,

        ])->first();


        if ($rating) {

            $rating->update([

                'guest_ip' => $request->ip(),

                'client_id' => $user->client_id,

                'company_id' => $user->company_id,

                'employee_id' => $user->id,

                'rating_id' => $request->rating_id,

                'rating_value' => $request->rating_value,

            ]);
        } else {

            $rating = EmployeeRating::create([

                'guest_ip' => $request->ip(),

                'client_id' => $user->client_id,

                'company_id' => $user->company_id,

                'employee_id' => $user->id,

                'rating_id' => $request->rating_id,

                'rating_value' => $request->rating_value,

            ]);
        }

        return response()->success(
            trans('payment.employee_rated_successfully'),
            $rating,
            StatusCode::OK
        );
    }
}
