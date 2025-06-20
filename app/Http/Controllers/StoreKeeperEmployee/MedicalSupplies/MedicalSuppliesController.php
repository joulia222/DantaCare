<?php

namespace App\Http\Controllers\StoreKeeperEmployee\MedicalSupplies;

use App\Http\Controllers\Controller;
use App\Models\MedicalSupplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MedicalSuppliesController extends Controller
{
    //


    public function index()
    {
        $medicalSupplieses = MedicalSupplies::all();
        return view("StoreKeeperEmployee.MedicalSupplies.index",compact('medicalSupplieses'));
    }

    public function create()
    {
        return view('StoreKeeperEmployee.MedicalSupplies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:medical_supplies,name',
            'code' => 'required|string|unique:medical_supplies,code',
            'type' => 'required|string|in:device,material,equipment,medicine',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image' => 'required',
        ]);
        
        $image = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('MedicalSuppliesImage', $image, 'image');
    
        MedicalSupplies::create([
            'name' => $validatedData['name'],
            'image' => $path,
            'code' => $validatedData['code'],
            'type' => $validatedData['type'],
            'description' => $validatedData['description'] ?? null,
            'quantity' => $validatedData['quantity'],
            'created_by' => Auth::guard('storeKeeperEmployee')->user()->id,
        ]);

        return redirect()->back()->with('success_message' , 'Medical Supplies Created Successfully');

    }

    public function edit($id)
    {

        $medicalSupplies = MedicalSupplies::where('id' , $id)->first();
        if(!$medicalSupplies)
        {
            return redirect()->back()->with('error_message' , 'Medical Supplies Not found');
        }
        return view('StoreKeeperEmployee.MedicalSupplies.edit',compact('medicalSupplies'));

    }

    public function update(Request $request , $id)
    {
        $medicalSupplies = MedicalSupplies::where('id' , $id)->first();
        if(!$medicalSupplies)
        {
            return redirect()->back()->with('error_message' , 'Medical Supplies Not found');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|unique:medical_supplies,name,' . $medicalSupplies->id,
            'code' => 'required|string|unique:medical_supplies,code,' . $medicalSupplies->id,
            'type' => 'required|string|in:device,material,equipment,medicine',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image',
        ]);        

        if ($request->file('image') == null) {
            $medicalSupplies->update([
                'name' => $validatedData['name'],
                'code' => $validatedData['code'],
                'type' => $validatedData['type'],
                'description' => $validatedData['description'] ?? null,
                'quantity' => $validatedData['quantity'],
            ]);

            return redirect()->route('storeKeeperEmployee.medicalSupplies.index')->with('success_message', 'Medical Supplies Updated Successfully');
        } else {
            if ($medicalSupplies->image != null) {
                Storage::disk('image')->delete($medicalSupplies->image);
                $image = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('MedicalSuppliesImage', $image, 'image');

                $medicalSupplies->update([
                    'name' => $validatedData['name'],
                    'image' => $path,
                    'code' => $validatedData['code'],
                    'type' => $validatedData['type'],
                    'description' => $validatedData['description'] ?? null,
                    'quantity' => $validatedData['quantity'],
                ]);

                return redirect()->route('storeKeeperEmployee.medicalSupplies.index')->with('success_message', 'Medical Supplies Updated Successfully');
            } else {

                $image = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('MedicalSuppliesImage', $image, 'image');

                $medicalSupplies->update([
                    'name' => $validatedData['name'],
                    'image' => $path,
                    'code' => $validatedData['code'],
                    'type' => $validatedData['type'],
                    'description' => $validatedData['description'] ?? null,
                    'quantity' => $validatedData['quantity'],
                ]);
                return redirect()->route('storeKeeperEmployee.medicalSupplies.index')->with('success_message', 'Medical Supplies Updated Successfully');
            }
        }

    }
 
    public function delete($id)
    {
        $medicalSupplies = MedicalSupplies::findOrFail($id);
    
        if (!$medicalSupplies) {
            return redirect()->route('storeKeeperEmployee.medicalSupplies.index')->with('error_message', 'Medical Supplies not found.');
        }
        $medicalSupplies->delete();
    
        return redirect()->route('storeKeeperEmployee.medicalSupplies.index')->with('success_message', 'Medical Supplies Deleted Successfully.');
    }



}
