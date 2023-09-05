<?php

namespace App\Http\Controllers\AuthViews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginView()
    {
        return view('Admin.loginView');
    }

    public function login(Request $request)
    {
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]) == true) {
            return redirect(url('admin'));
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
