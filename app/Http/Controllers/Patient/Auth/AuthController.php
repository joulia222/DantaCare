<?php

namespace App\Http\Controllers\Patient\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //
    
    public function loginPage()
    {
      return view('Patient.Auth.login');
    }
    
    public function login(Request $request)
    {
        $check = $request->all();

        if (Auth::guard('patient')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('error_message', 'Invalid email or password');
        }
    }

    public function registerPage()
    {
        return view('Patient.Auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:patients',
            'password' => 'required|min:6',
            'gender' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'img' => 'required|image|mimes:jpg,jpeg,png',
        ]);
    
        $patient = Patient::where('email', $validatedData['email'])->first();
        if ($patient) {
            return redirect()->back()->with('error_message', 'Email already exists');
        }
    
        $image = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('public/Image/PatientImage', $image);
    
        Patient::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'gender' => $validatedData['gender'],
            'age' => $validatedData['age'],
            'phone' => $validatedData['phone'],
            'img' => $path,
            'status' => '1'
        ]);
    
        return redirect()->route('patient.login.page')->with('success_message', 'Registered successfully');
    }

    public function logout()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('patient.index');
    }

    public function resetPasswordPage()
    {
        return view('Patient.Auth.resetPassword');
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:patients,email',
            'password' => 'required|confirmed',
        ]);
    
        $patient = Patient::where('email', $validated['email'])->first();
    
        $patient->update([
            'password' => Hash::make($validated['password']),
        ]);
    
        return redirect()->route('patient.login.page')->with('success_message', 'Password reset successfully. Please login with your new password.');
    }
    
    public function editProfile()
    {
        $patient = Auth::guard('patient')->user();
        return view('Patient.Auth.editProfile', compact('patient'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\Patient $patient */
        $patient = Auth::guard('patient')->user();
    
        $data = $request->only(['name', 'email', 'phone', 'status', 'age', 'gender']);
    
        if ($request->hasFile('img')) {
            if ($patient->img) {
                Storage::disk('image')->delete($patient->img);
            }
    
            $imageName = $request->file('img')->getClientOriginalName();
            $imagePath = $request->file('img')->storeAs('PatientImage', $imageName, 'image');
            $data['img'] = $imagePath;
        }
    
        $patient->update($data);
    
        return redirect()->route('patient.index')->with('success_message', 'Your information Updated Successfully');
    }



}
