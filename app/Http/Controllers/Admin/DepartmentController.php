<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    //
    public function index ()
    {
        $departments = Department::all();
        return view("Admin.Department.index",compact('departments'));
    }
    public function create()
    {
        return view('Admin.Department.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'code' => 'required|string|max:4|min:4|unique:departments,code'
        ]);   
        
        Department::create([
            'name' => $request->name,
            'code' => $request->code,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);
    
        return redirect()->route('admin.department.index')->with('success_message', 'Department Created Successfully');
    }
    public function edit($id)
    {
        $department = Department::findOrfail($id);
        return view('Admin.Department.edit', compact('department'));
    }
    public function update(Request $request, $id)
    {

        $department = Department::findOrFail($id);
        $validatedData=$request->validate([
            'name' => 'required|string|max:200',
            'code' => 'required|string',
        ]);
            $department->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),

            ]);
            $department->update([
                'name' => $validatedData['name'],
                'code' => $validatedData['code'],
                'created_by' => Auth::guard('admin')->user()->id,
            ]);
            return redirect()->route('admin.department.index')->with('success_message', 'Department Updated Successfully');
    }
    public function delete($id)
    {
        $department = Department::findOrFail($id);
    
        if (!$department) {
            return redirect()->route('admin.department.index')->with('error_message', 'Department not found.');
        }
        $department->delete();
    
        return redirect()->route('admin.department.index')->with('success_message', 'Department Deleted Successfully.');
    }
}
