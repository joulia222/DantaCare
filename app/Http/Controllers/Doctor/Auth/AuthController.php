<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loginPage()
    {
      return view('Doctor.Auth.login');
    }
    
    public function login(Request $request)
    {
        $check = $request->all();

        if (Auth::guard('doctor')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
                return redirect()->route('doctor.index');
        } else {
            return redirect()->back()->with('error_message', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login.page');
    }
}
