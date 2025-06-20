<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SpecializationController extends Controller
{
    //
    public function index ()
    {
        $specializations = Specialization::all();
        return view("Admin.Specialization.index",compact('specializations'));
    }

    public function create()
    {
        return view('Admin.Specialization.create');
    }

    public function store(Request $request)
    {
        $validateedData = $request->validate([
            'name'=> 'required|unique:specializations,name',
            'description' =>'required|string',
        ]);
        Specialization::create([
            'name' => $validateedData['name'],
            'description' => $validateedData['description'],
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->route('admin.specialization.index')->with('success_message', 'Specialization Created Successfully');
    }

    public function edit($id)
    {
        $specialization = Specialization::findOrfail($id);
        return view('Admin.Specialization.edit', compact('specialization'));
    }

    public function update(Request $request, $id)
    {
        $specialization = Specialization::findOrFail($id);
        $validatedData = $request->validate([
            'name' => [
                'required',
                Rule::unique('specializations', 'name')->ignore($specialization->id),
            ],
            'description' => 'required|string',
        ]);
      
            $specialization->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'created_by' => Auth::guard('admin')->user()->id,

            ]);
            return redirect()->route('admin.specialization.index')->with('success_message', 'Specialization Updated Successfully');

    }    

    public function delete($id)
    {
        $specialization = Specialization::findOrFail($id);
    
        if (!$specialization) {
            return redirect()->route('admin.specialization.index')->with('error_message', 'Specialization not found.');
        }
        $specialization->delete();
    
        return redirect()->route('admin.specialization.index')->with('success_message', 'Specialization Deleted Successfully.');
    }
    

}
