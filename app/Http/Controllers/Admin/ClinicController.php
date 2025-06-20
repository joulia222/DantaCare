<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    //
    public function index ()
    {
        $clinics = Clinic::all();
        return view("Admin.Clinic.index",compact('clinics'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('Admin.Clinic.create',compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'code' => 'required|string|max:4|min:4|unique:departments,code',
            'department_id' => 'required'
        ]);   
        
        Clinic::create([
            'name' => $request->name,
            'code' => $request->code,
            'department_id' => $request->department_id,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);
    
        return redirect()->route('admin.clinic.index')->with('success_message', 'Clinic Created Successfully');
    }

    public function edit($id)
    {
        $clinic = Clinic::findOrfail($id);
        $departments = Department::all();

        return view('Admin.Clinic.edit', compact('clinic','departments'));
    }
    
    public function update(Request $request, $id)
    {

        $clinic = Clinic::findOrFail($id);

        $validatedData=$request->validate([
            'name' => 'required|string|max:200',
            'code' => 'required|string',
            'department_id' => 'required',
        ]);

        $clinic->update([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'department_id' =>$validatedData['department_id'],
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

            return redirect()->route('admin.clinic.index')->with('success_message', 'Clinic Updated Successfully');
    }
    public function delete($id)
    {
        $clinic = Clinic::findOrFail($id);
    
        if (!$clinic) {
            return redirect()->route('admin.clinic.index')->with('error_message', 'Clinic not found.');
        }
        $clinic->delete();
    
        return redirect()->route('admin.clinic.index')->with('success_message', 'Clinic Deleted Successfully.');
    }
}
