<?php

namespace App\Http\Controllers;

use App\Models\SystemLookup;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentForEmployeeController extends Controller
{

    public function index(User $user)
    {
        $employee_available_ratings = $user->employeeAvailableRatings()->pluck('available_rating_id');

        $data['employee_available_ratings'] = SystemLookup::whereIn('id', $employee_available_ratings)->get();

        return view('Guest/EmployeePayment/paymentForEmployee',$data);
    }
}
