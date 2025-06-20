<?php

namespace App\Http\Controllers\Doctor\Consultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        $doctor_id = Auth::guard('doctor')->user()->id;
        $consultations = Consultation::where('doctor_id', $doctor_id)->get();
        return view('doctor.consultation.index', compact('consultations'));
    }

    public function edit(Consultation $consultation)
    {
        // Check if the consultation belongs to the current doctor
        if ($consultation->doctor_id !== Auth::guard('doctor')->user()->id) {
            return redirect()->route('doctor.consultation.index')
                ->with('error_message', 'You are not authorized to edit this consultation.');
        }

        return view('doctor.consultation.edit', compact('consultation'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        // Check if the consultation belongs to the current doctor
        if ($consultation->doctor_id !== Auth::guard('doctor')->user()->id) {
            return redirect()->route('doctor.consultation.index')
                ->with('error_message', 'You are not authorized to update this consultation.');
        }

        $validatedData = $request->validate([
            'answer' => 'required|string',
        ]);

        $consultation->update([
            'answer' => $validatedData['answer'],
        ]);

        return redirect()->route('doctor.consultation.index')
            ->with('success_message', 'Consultation answer updated successfully.');
    }

    public function destroy(Consultation $consultation)
    {
        // Check if the consultation belongs to the current doctor
        if ($consultation->doctor_id !== Auth::guard('doctor')->user()->id) {
            return redirect()->route('doctor.consultation.index')
                ->with('error_message', 'You are not authorized to delete this consultation.');
        }

        $consultation->delete();

        return redirect()->route('doctor.consultation.index')
            ->with('success_message', 'Consultation deleted successfully.');
    }
}

