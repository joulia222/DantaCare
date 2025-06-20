<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Inspection;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    //

    public function index()
    {
        try {
            $patient = Auth::guard('patient')->user();
            
            if (!$patient) {
                return redirect()->route('patient.login.page')->with('error_message', 'Please login first');
            }

            $medicalRecord = MedicalRecord::where('patient_id', $patient->id)
                ->with(['patient', 'reception'])
                ->first();
            
            if (!$medicalRecord) {
                return view('Layouts.Patient.medicalRecord', [
                    'medicalRecord' => null,
                    'inspections' => collect([]),
                    'patient' => $patient
                ]);
            }
            $inspections = Inspection::where('medical_record_id', $medicalRecord->id)
                ->with(['doctor', 'medicalRecord'])
                ->orderBy('date_time', 'desc')
                ->get();
            
            return view('Layouts.Patient.medicalRecord', [
                'medicalRecord' => $medicalRecord,
                'inspections' => $inspections,
                'patient' => $patient
            ]);
        } catch (\Exception $e) {
            return back()->with('error_message', 'An error occurred: ' . $e->getMessage());
        }
    }
}
