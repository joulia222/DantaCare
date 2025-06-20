<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthController extends Controller
{
    //

    public function loginPage()
    {
      return view('Admin.Auth.login');
    }
    
    public function login(Request $request)
    {
        $check = $request->all();

        if (Auth::guard('admin')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->with('error_message', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.page');
    }
}
