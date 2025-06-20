<?php

namespace App\Http\Controllers\Doctor\Radiography;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Radiography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RadiographyController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('Doctor.Radiography.index', compact('patients'));
    }

    public function show(Patient $patient)
    {
        $radiographies = $patient->radiographies()->latest()->get();
        return view('Doctor.Radiography.showRadiography', compact('patient', 'radiographies'));
    }

    public function create(Patient $patient)
    {
        return view('Doctor.Radiography.create', compact('patient'));
    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_date' => 'required|date',
            'description' => 'required|string|max:1000',
        ]);

        try {
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('RadiographyImage/' . $validatedData['patient_id'], $image, 'image');

            Radiography::create([
                'patient_id' => $validatedData['patient_id'],
                'image' => $path,
                'image_date' => $validatedData['image_date'],
                'description' => $validatedData['description'],
            ]);

            return redirect()
                ->route('doctor.radiography.show', $validatedData['patient_id'])
                ->with('success_message', 'Radiography added successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error_message', 'Failed to add radiography. Please try again.' . $e->getMessage());
        }
    }

    public function destroy(Radiography $radiography)
    {
        try {

            Storage::disk('image')->delete($radiography->image);
        
            $radiography->delete();

            return back()->with('success_message', 'Radiography deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Failed to delete radiography. Please try again.');
        }
    }
}
