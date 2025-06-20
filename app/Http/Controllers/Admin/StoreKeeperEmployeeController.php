<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreKeeperEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StoreKeeperEmployeeController extends Controller
{
    //

    public function index()
    {
        $storeKeeperEmployees = StoreKeeperEmployee::all();
        return view("Admin.storeKeeperEmployee.index", compact('storeKeeperEmployees'));
    }
    public function create()
    {
        return view('Admin.StoreKeeperEmployee.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|min:6',
            'phone' => 'required|string',
            'status' => 'required|boolean',
            'age' => 'required|integer|min:18',
            'gender' => 'required|in:0,1',
        ]);
    
        $password = $request->input('password');
        $image = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('ReceptionistImage', $image, 'image');
    
        StoreKeeperEmployee::create([
            'name' => $request->name,
            'img' => $path,
            'email' => $request->email,
            'password' => Hash::make($password),
            'phone' => $request->phone,
            'status' => $request->status,
            'age' => $request->age,
            'gender' => $request->gender,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);
    
        return redirect()->route('admin.storeKeeperEmployee.index')->with('success', 'Store Keeper Employee Created Successfully');
    }
    public function edit($id)
    {
        $storeKeeperEmployee = StoreKeeperEmployee::findOrfail($id);
        return view('Admin.StoreKeeperEmployee.edit', compact('storeKeeperEmployee'));
    }
    public function update(Request $request, $id)
    {

        $storeKeeperEmployee =StoreKeeperEmployee::findOrFail($id);

        if ($request->file('img') == null) {
            $storeKeeperEmployee->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),

            ]);

            return redirect()->route('admin.storeKeeperEmployee.index')->with('success_message', 'Store Keeper Employee Updated Successfully');
        } else {
            if ($storeKeeperEmployee->img != null) {
                Storage::disk('image')->delete($storeKeeperEmployee->img);
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('storeKeeperEmployeeImage', $image, 'image');

                $storeKeeperEmployee->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'status' => $request->input('status'),
                    'age' => $request->input('age'),
                    'gender' => $request->input('gender'),
                    'img' => $path,
                ]);

                return redirect()->route('admin.storeKeeperEmployee.index')->with('success_message', 'Store Keeper Employee Updated Successfully');
            } else {

                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('storeKeeperEmployeeImage', $image, 'image');

                $storeKeeperEmployee->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'status' => $request->input('status'),
                    'age' => $request->input('age'),
                    'gender' => $request->input('gender'),
                    'img' => $path,
                ]);
                return redirect()->route('admin.storeKeeperEmployeeImage.index')->with('success_message', 'Store Keeper EmployeeImage Updated Successfully');
            }
        }
    }
    public function delete($id)
    {
        $storeKeeperEmployee = StoreKeeperEmployee::findOrFail($id);
    
        if (!$storeKeeperEmployee) {
            return redirect()->route('admin.storeKeeperEmployee.index')->with('error_message', 'Store Keeper Employee not found.');
        }
        $storeKeeperEmployee->delete();
    
        return redirect()->route('admin.storeKeeperEmployee.index')->with('success_message', 'Store Keeper Employee Deleted Successfully.');
    }
}
