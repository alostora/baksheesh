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
use Guest\Http\Requests\CompanyNoteRequest;
use Guest\Http\Requests\CompanyRatingRequest;
use Guest\Http\Requests\EmployeeNoteRequest;
use Guest\Http\Requests\EmployeeRatingRequest;
use Guest\Http\Resources\PayForCompanyResource;
use Guest\Http\Resources\PayForEmployeeResource;

class ReviewController extends Controller
{

    public function companyNote(CompanyNoteRequest $request)
    {
        $validated = $request->validated();

        $companyNote = CompanyCash::where([

            'guest_key' => $validated['guest_key'],

            'client_id' => $validated['client_id'],

            'company_id' => $validated['company_id'],

        ])->first();

        if ($companyNote) {

            $companyNote->update($validated);
        } else {

            $companyNote = CompanyCash::create($validated);
        }

        return response()->success(
            trans('payment.payment_created_successfully'),
            new PayForCompanyResource($companyNote),
            StatusCode::OK
        );
    }

    public function employeeNote(EmployeeNoteRequest $request)
    {

        $validated = $request->validated();

        $employeeCash = EmployeeCash::where([

            'guest_key' => $validated['guest_key'],

            'client_id' => $validated['client_id'],

            'company_id' => $validated['company_id'],

            'employee_id' => $validated['employee_id'],

        ])->first();

        if ($employeeCash) {

            $employeeCash->update($validated);
        } else {

            $employeeCash = EmployeeCash::create($validated);
        }

        return response()->success(
            trans('payment.payment_created_successfully'),
            new PayForEmployeeResource($employeeCash),
            StatusCode::OK
        );
    }

    public function companyRating(CompanyRatingRequest $request, Company $company)
    {
        $validated = $request->validated();

        $validated['client_id'] = $company->client_id;

        $validated['company_id'] = $company->id;


        $rating = CompanyRating::where([

            'guest_key' => $validated['guest_key'],

            'company_id' => $company->id,

            'rating_id' => $validated['rating_id'],

        ])->first();

        if ($rating) {

            $rating->update($validated);
        } else {

            $rating = CompanyRating::create($validated);
        }

        return response()->success(
            trans('payment.company_rated_successfully'),
            $rating,
            StatusCode::OK
        );
    }

    public function employeeRating(EmployeeRatingRequest $request, User $user)
    {
        $validated = $request->validated();

        $validated['client_id'] = $user->client_id;

        $validated['company_id'] = $user->company_id;

        $validated['employee_id'] = $user->id;

        $rating = EmployeeRating::where([
            'guest_key' => $validated['guest_key'],

            'employee_id' => $user->id,

            'rating_id' => $request->rating_id,

        ])->first();

        if ($rating) {

            $rating->update($validated);
        } else {

            $rating = EmployeeRating::create($validated);
        }

        return response()->success(
            trans('payment.employee_rated_successfully'),
            $rating,
            StatusCode::OK
        );
    }
}
