<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ReceptionistController extends Controller
{
    //

    public function index()
    {
        $receptionists = Receptionist::all();
        return view("Admin.Receptionist.index", compact('receptionists'));
    }
    public function create()
    {
        return view('Admin.Receptionist.create');
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
    
        Receptionist::create([
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
    
        return redirect()->route('admin.receptionist.index')->with('success', 'Receptionist Created Successfully');
    }
    public function edit($id)
    {
        $receptionist = Receptionist::findOrfail($id);
        return view('Admin.Receptionist.edit', compact('receptionist'));
    }
    public function update(Request $request, $id)
    {

        $receptionist =Receptionist::findOrFail($id);

        if ($request->file('img') == null) {
            $receptionist->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),

            ]);

            return redirect()->route('admin.receptionist.index')->with('success_message', 'Receptionist Updated Successfully');
        } else {
            if ($receptionist->img != null) {
                Storage::disk('image')->delete($receptionist->img);
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('ReceptionistImage', $image, 'image');

                $receptionist->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'status' => $request->input('status'),
                    'age' => $request->input('age'),
                    'gender' => $request->input('gender'),
                    'img' => $path,
                ]);

                return redirect()->route('admin.receptionist.index')->with('success_message', 'Receptionist Updated Successfully');
            } else {

                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('ReceptionistImage', $image, 'image');

                $receptionist->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'status' => $request->input('status'),
                    'age' => $request->input('age'),
                    'gender' => $request->input('gender'),
                    'img' => $path,
                ]);
                return redirect()->route('admin.receptionist.index')->with('success_message', 'Receptionist Updated Successfully');
            }
        }
    }
    public function delete($id)
    {
        $receptionist = Receptionist::findOrFail($id);
    
        if (!$receptionist) {
            return redirect()->route('admin.receptionist.index')->with('error_message', 'Receptionist not found.');
        }
        $receptionist->delete();
    
        return redirect()->route('admin.receptionist.index')->with('success_message', 'receptionist Deleted Successfully.');
    }
}
