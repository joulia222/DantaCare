<?php

namespace App\Http\Controllers\StoreKeeperEmployee\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function loginPage()
    {
      return view('StoreKeeperEmployee.Auth.login');
    }
    
    public function login(Request $request)
    {
        $check = $request->all();

        if (Auth::guard('storeKeeperEmployee')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('storeKeeperEmployee.index');
        } else {
            return redirect()->back()->with('error_message', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::guard('storeKeeperEmployee')->logout();
        return redirect()->route('storeKeeperEmployee.login.page');
    }

}
