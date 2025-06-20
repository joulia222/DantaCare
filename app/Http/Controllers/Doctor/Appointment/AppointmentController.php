<?php

namespace App\Http\Controllers\Doctor\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
class AppointmentController extends Controller
{
    //
    public function index($status = 'all')
    {
        $query = Appointment::with(['clinic', 'doctor', 'patient'])->where('doctor_id', Auth::guard('doctor')->user()->id);
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $appointments = $query->get();
        return view("Doctor.Appointment.index", compact('appointments', 'status'));
    }

    public function create()
    {
        $clinics = Clinic::all();
        $patients = Patient::all();
        
        return view('Doctor.Appointment.create', compact('clinics', 'patients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'clinic_id' => 'required',
            'patient_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'day' => 'required',
            'status' => 'required',
        ]);

        $doctor_id = Auth::guard('doctor')->user()->id;
        
        $startDateTime = $validatedData['day'] . ' ' . $validatedData['start_time'];
        $endDateTime = $validatedData['day'] . ' ' . $validatedData['end_time'];

        $existingAppointment = Appointment::where('clinic_id', $validatedData['clinic_id'])
            ->where('day', $validatedData['day'])
            ->where('status', 'pending')
            ->where('doctor_id', $doctor_id)
            ->where(function($query) use ($startDateTime, $endDateTime) {
                $query->where(function($q) use ($startDateTime) {
                    $q->where('start_time', '<=', $startDateTime)
                        ->where('end_time', '>', $startDateTime);
                })->orWhere(function($q) use ($endDateTime) {
                    $q->where('start_time', '<', $endDateTime)
                        ->where('end_time', '>=', $endDateTime);
                })->orWhere(function($q) use ($startDateTime, $endDateTime) {
                    $q->where('start_time', '>=', $startDateTime)
                        ->where('end_time', '<=', $endDateTime);
                });
            })
            ->first();

        if ($existingAppointment) {
            return redirect()->back()
                ->with('error', 'There is already a pending appointment at this time slot in the selected clinic.')
                ->withInput();
        }

        $appointment = Appointment::create([
            'clinic_id' => $validatedData['clinic_id'],
            'doctor_id' => $doctor_id,
            'patient_id' => $validatedData['patient_id'],
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'day' => $validatedData['day'],
            'status' => $validatedData['status']
        ]);
        
        return redirect()->route('doctor.appointments.index')
            ->with('success_message', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $clinics = Clinic::all();
        $patients = Patient::all();
        
        return view('Doctor.Appointment.edit', compact('appointment', 'clinics', 'patients'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validatedData = $request->validate([
            'clinic_id' => 'required',
            'patient_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'day' => 'required',
            'status' => 'required',
        ]);

        // Combine date and time for start_time and end_time
        $startDateTime = $validatedData['day'] . ' ' . $validatedData['start_time'];
        $endDateTime = $validatedData['day'] . ' ' . $validatedData['end_time'];

        // Check for overlapping appointments excluding the current appointment
        $existingAppointment = Appointment::where('clinic_id', $validatedData['clinic_id'])
            ->where('day', $validatedData['day'])
            ->where('status', 'pending')
            ->where('id', '!=', $appointment->id)
            ->where('doctor_id', $appointment->doctor_id)
            ->where(function($query) use ($startDateTime, $endDateTime) {
                $query->where(function($q) use ($startDateTime) {
                    $q->where('start_time', '<=', $startDateTime)
                        ->where('end_time', '>', $startDateTime);
                })->orWhere(function($q) use ($endDateTime) {
                    $q->where('start_time', '<', $endDateTime)
                        ->where('end_time', '>=', $endDateTime);
                })->orWhere(function($q) use ($startDateTime, $endDateTime) {
                    $q->where('start_time', '>=', $startDateTime)
                        ->where('end_time', '<=', $endDateTime);
                });
            })
            ->first();

        if ($existingAppointment) {
            return redirect()->back()
                ->with('error', 'There is already a pending appointment at this time slot in the selected clinic.')
                ->withInput();
        }

        $appointment->update([
            'clinic_id' => $validatedData['clinic_id'],
            'patient_id' => $validatedData['patient_id'],
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'day' => $validatedData['day'],
            'status' => $validatedData['status']
        ]);
        
        return redirect()->route('doctor.appointments.index')
            ->with('success_message', 'Appointment updated successfully.');
    }

    public function cancel(Appointment $appointment)
    {
        if ($appointment->status === 'pending') {
            $appointment->update(['status' => 'cancelled']);
            return redirect()->route('doctor.appointments.index')
                ->with('success_message', 'Appointment has been cancelled successfully.');
        }

        return redirect()->route('doctor.appointments.index')
            ->with('error_message', 'Only pending appointments can be cancelled.');
    }

    public function complete(Appointment $appointment)
    {
        if ($appointment->status === 'pending') {
            $appointment->update(['status' => 'completed']);
            return redirect()->route('doctor.appointments.index')
                ->with('success_message', 'Appointment has been marked as completed.');
        }

        return redirect()->route('doctor.appointments.index')
            ->with('error_message', 'Only pending appointments can be marked as completed.');
    }
}
