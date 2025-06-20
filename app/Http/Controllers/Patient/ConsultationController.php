<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
 

class ConsultationController extends Controller
{
    //

    public function index()
    {
        $doctors = Doctor::all();
        $patient = Auth::guard('patient')->user();
        
        if (!$patient) {
            return redirect()->route('patient.login.page')->with('error', 'Please login to view your consultations.');
        }

        // Get consultations with their related doctor information
        $consultations = Consultation::with('doctor')
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('welcome', compact('consultations', 'doctors', 'patient'));
    }

    public function storeConsultation(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
        ]);

    $consultation_patient = Consultation::where('patient_id', $validatedData['patient_id'])->where('doctor_id', $validatedData['doctor_id'])->where('answer', null)->first();

    if($consultation_patient) {
        return redirect()->back()->with('error_message_consultation', 'You have already sent a consultation request to this doctor.');
    }

        $consultation = Consultation::create([
            'question' => $validatedData['question'],
            'doctor_id' => $validatedData['doctor_id'],
            'patient_id' => $validatedData['patient_id'],
        ]);

        return redirect()->back()->with('success_message_consultation', 'Consultation sent successfully.');
    }
}
