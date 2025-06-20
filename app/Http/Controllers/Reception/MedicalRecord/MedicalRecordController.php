<?php

namespace App\Http\Controllers\Reception\MedicalRecord;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    //
    public function index()
    {
        $medicalRecords = MedicalRecord::all();
        return view('Reception.MedicalRecord.index', compact('medicalRecords'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('Reception.MedicalRecord.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
        ]);

        $patientRecord = MedicalRecord::where('patient_id', $validatedData['patient_id'])->first();
        if($patientRecord){
            return redirect()->route('reception.medical-record.create')
                ->with('error_message', 'Patient already has a medical record.');
        }

        MedicalRecord::create([
            'name' => $validatedData['name'],
            'patient_id' => $validatedData['patient_id'],
            'created_by' => Auth::guard('reception')->user()->id,
        ]);

        return redirect()->route('reception.medical-record.index')
            ->with('success_message', 'Medical record created successfully.');
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = Patient::all();
        return view('Reception.MedicalRecord.edit', compact('medicalRecord', 'patients'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
        ]);

        $medicalRecord->update([
            'name' => $validatedData['name'],
            'patient_id' => $validatedData['patient_id'],
        ]);

        return redirect()->route('reception.medical-record.index')
            ->with('success_message', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->route('reception.medical-record.index')
            ->with('success_message', 'Medical record deleted successfully.');
    }
}
