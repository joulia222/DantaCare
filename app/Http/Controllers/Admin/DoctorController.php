<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    //
    public function index()
    {
        $doctors = Doctor::with('specialization')->get();
        return view("Admin.Doctor.index", compact('doctors'));
    }
    public function create()
    {
        $specializations = Specialization::all();
        $departments = Department::all();
        return view('Admin.Doctor.create',compact('specializations', 'departments'));
    }
    public function store(Request $request)
    {
       $validatedData= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|min:6',
            'phone' => 'required|string',
            'status' => 'required|boolean',
            'age' => 'required|integer|min:18',
            'gender' => 'required|in:0,1',
            'specialization_id' => 'required|exists:specializations,id',
            'department_id' => 'required|exists:departments,id',

        ]);
    
        $password = $validatedData['password'];
        $image = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('DoctorImage', $image, 'image');
    
        Doctor::create([
            'name' => $validatedData['name'],
            'img' => $path,
            'email' => $validatedData['email'],
            'password' => Hash::make($password),
            'phone' => $validatedData['phone'],
            'status' => $validatedData['status'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'specialization_id' => $validatedData['specialization_id'],
            'department_id' => $validatedData['department_id'],
            'created_by' => Auth::guard('admin')->user()->id,
        ]);
    
        return redirect()->route('admin.doctor.index')->with('success_message', 'Doctor Created Successfully');
    }
    public function edit($id)
    {
    $doctor = Doctor::findOrFail($id);
    $specializations = Specialization::all();
    $departments = Department::all();


    return view('Admin.Doctor.edit', compact('doctor', 'specializations' , 'departments'));
    }
    public function update(Request $request, $id)
    {

        $doctor = Doctor::findOrFail($id);

        if ($request->file('img') == null) {
            $doctor->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),
                'specialization_id' => $request->input('specialization_id'),
                'department_id' => $request->input('department_id'),

            ]);

            return redirect()->route('admin.doctor.index')->with('success_message', 'Doctor Updated Successfully');
        } else {
            if ($doctor->img != null) {
                Storage::disk('image')->delete($doctor->img);
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('DoctorImage', $image, 'image');

                $doctor->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'status' => $request->input('status'),
                    'age' => $request->input('age'),
                    'gender' => $request->input('gender'),
                    'specialization_id' => $request->input('specialization_id'),
                    'department_id' => $request->input('department_id'),
                    'img' => $path,
                ]);

                return redirect()->route('admin.doctor.index')->with('success_message', 'Doctor Updated Successfully');
            } else {

                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('DoctorImage', $image, 'image');

                $doctor->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'status' => $request->input('status'),
                    'age' => $request->input('age'),
                    'gender' => $request->input('gender'),
                    'specialization_id' => $request->input('specialization_id'),
                    'department_id' => $request->input('department_id'),
                    'img' => $path,
                ]);
                return redirect()->route('admin.doctor.index')->with('success_message', 'Doctor Updated Successfully');
            }
        }
    }
    public function delete($id)
    {
        $doctor = Doctor::findOrFail($id);
    
        if (!$doctor) {
            return redirect()->route('admin.doctor.index')->with('error_message', 'Doctor not found.');
        }
        $doctor->delete();
    
        return redirect()->route('admin.doctor.index')->with('success_message', 'Doctor Deleted Successfully.');
    }


}
