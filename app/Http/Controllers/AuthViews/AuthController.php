<?php

namespace App\Http\Controllers\AuthViews;

use App\Constants\HasLookupType\UserAccountType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginView()
    {
        return view('Main.loginView');
    }

    public function login(Request $request)
    {
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]) == true) {
            if (
                in_array(auth()->user()->accountType->code, [UserAccountType::ADMIN['code'], UserAccountType::ROOT['code']])
            ) {

                return redirect(url('admin'));
            } elseif (in_array(auth()->user()->accountType->code, [UserAccountType::CLIENT['code']])) {

                return redirect(url('client'));
            } else {
                $this->logOut($request);
            }
        } else {
            return redirect(url('admin/login'));
        }
    }

    public function logOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(url('admin/login'));
    }
}
