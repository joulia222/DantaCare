<?php

namespace App\Http\Controllers\Reception\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function loginPage()
    {
      return view('Reception.Auth.login');
    }
    
    public function login(Request $request)
    {
        $check = $request->all();

        if (Auth::guard('reception')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('reception.index');
        } else {
            return redirect()->back()->with('error_message', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::guard('reception')->logout();
        return redirect()->route('reception.login.page');
    }
}
