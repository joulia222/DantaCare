<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Service;

use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
{
    //

    public function index()
    {
        $clinics = Clinic::all();
        $doctors = Doctor::with('specialization')->get();
        $patient = Auth::guard('patient')->user();
        $services = Service::all();
        
        return view('welcome', compact('clinics', 'doctors', 'patient', 'services'));
    }

    public function store(Request $request)
    {
        $clinics = Clinic::all();
        $doctors = Doctor::all();
        $patient = Auth::user();

        $validatedData = $request->validate([
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'doctor_id' => 'required',
            'clinic_id' => 'required',
            'patient_id' => 'required',
        ]);

        // Combine day with start_time and end_time
        $startDateTime = $validatedData['day'] . ' ' . $validatedData['start_time'];
        $endDateTime = $validatedData['day'] . ' ' . $validatedData['end_time'];

        $appointment = Appointment::create([
            'day' => $validatedData['day'],
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'doctor_id' => $validatedData['doctor_id'],
            'clinic_id' => $validatedData['clinic_id'],
            'status' => 'pending',
            'patient_id' => $validatedData['patient_id'],
        ]);

        return redirect()->back()->with('success', 'Appointment created successfully'); 
    }

    public function cancelAppointment(Request $request, $id)
{

    $validatedData = $request->validate([
        'status' => 'required',
    ]);

    $appointment = Appointment::find($id);
    if(!$appointment) {
        return redirect()->back()->with('error_message', 'Appointment not found.');
    }

    if ($appointment->status == 'pending' && $appointment->day == date('Y-m-d')) {
        return redirect()->back()->with('error_message', 'You cannot cancel appointments scheduled for today.');
    }


    if($appointment->status == 'cancelled' || $appointment->status == 'completed') {
        return redirect()->back()->with('error', 'Appointment already cancelled or completed.');
    }
       

        $appointment->update([
            'status' => $validatedData['status'],
            'patient_id' => Auth::guard('patient')->user()->id,
            'appointment_id' => $appointment->id,
        ]);

    return redirect()->back()->with('success_message', 'Appointment cancelled successfully.');

}


}