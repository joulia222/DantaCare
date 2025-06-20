<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class NurseController extends Controller
{
    //

    public function index()
    {
        $nurses = Nurse::all();
        return view("Admin.Nurse.index", compact('nurses'));
    }
    public function create()
    {
        $departments = Department::all();
        return view('Admin.Nurse.create',compact('departments'));
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
            'department_id' => 'required|exists:departments,id',

        ]);
    
        $password = $validatedData['password'];
        $image = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('NurseImage', $image, 'image');
    
        Nurse::create([
            'name' => $validatedData['name'],
            'img' => $path,
            'email' => $validatedData['email'],
            'password' => Hash::make($password),
            'phone' => $validatedData['phone'],
            'status' => $validatedData['status'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'department_id' => $validatedData['department_id'],
            'created_by' => Auth::guard('admin')->user()->id,
        ]);
    
        return redirect()->route('admin.nurse.index')->with('success_message', 'Nurse Created Successfully');
    }
    public function edit($id)
    {
        $nurse = Nurse::findOrfail($id);
        $departments = Department::all();

        return view('Admin.Nurse.edit', compact('nurse' ,'departments'));
    }
    public function update(Request $request, $id)
    {
        $nurse = Nurse::findOrFail($id);
        $validatedData= $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                Rule::unique('nurses', 'email')->ignore($nurse->id),
            ],            
            'phone' => 'required|string',
            'status' => 'required|boolean',
            'age' => 'required|integer|min:18',
            'gender' => 'required|in:0,1',
            'department_id' => 'required|exists:departments,id',

        ]);
      
            $nurse->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'status' => $validatedData['status'],
                'age' => $validatedData['age'],
                'gender'=>$validatedData['gender'],
                'department_id' =>$validatedData['department_id'],
                'created_by' => Auth::guard('admin')->user()->id,

            ]);
            return redirect()->route('admin.nurse.index')->with('success_message', 'Nusre Info Updated Successfully');

    } 
    public function delete($id)
    {
        $nurse = Nurse::findOrFail($id);
    
        if (!$nurse) {
            return redirect()->route('admin.nurse.index')->with('error_message', 'Nurse not found.');
        }
        $nurse->delete();
    
        return redirect()->route('admin.nurse.index')->with('success_message', 'Nurse Deleted Successfully.');
    }
}
