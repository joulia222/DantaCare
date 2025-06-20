<?php

namespace App\Http\Controllers\Doctor\MedicalRecord;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::all();
        return view('doctor.MedicalRecord.index', compact('medicalRecords'));
    }

    public function inspectionIndex(MedicalRecord $medicalRecord)
    {
        $inspections = $medicalRecord->inspections()->with('doctor')->latest()->get();
        return view('doctor.MedicalRecord.inspections.index', compact('medicalRecord', 'inspections'));
    }

    public function inspectionCreate(MedicalRecord $medicalRecord)
    {
        return view('doctor.MedicalRecord.inspections.create', compact('medicalRecord'));
    }

    public function inspectionStore(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_time' => 'required|date',
            'result' => 'required|string',
            'medicine' => 'required|string',
            'next_inspection_date' => 'required|date|after:date_time',
        ], [
            'next_inspection_date.after' => 'The next inspection date must be after the inspection date and time.'
        ]);

        $validated['medical_record_id'] = $medicalRecord->id;
        $validated['doctor_id'] = Auth::guard('doctor')->user()->id;

        Inspection::create($validated);

        return redirect()->route('doctor.medical.record.inspections.index', $medicalRecord)
            ->with('success_message', 'Inspection created successfully.');
    }

    public function inspectionEdit(MedicalRecord $medicalRecord, Inspection $inspection)
    {
        return view('doctor.MedicalRecord.inspections.edit', compact('medicalRecord', 'inspection'));
    }

    public function inspectionUpdate(Request $request, MedicalRecord $medicalRecord, Inspection $inspection)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_time' => 'required|date',
            'result' => 'required|string',
            'medicine' => 'required|string',
            'next_inspection_date' => 'required|date|after:date_time',
        ], [
            'next_inspection_date.after' => 'The next inspection date must be after the inspection date and time.'
        ]);

        $inspection->update([
            'name' => $validated['name'],
            'date_time' => $validated['date_time'],
            'result' => $validated['result'],
            'medicine' => $validated['medicine'],
            'next_inspection_date' => $validated['next_inspection_date'],
        ]);

        return redirect()->route('doctor.medical.record.inspections.index', $medicalRecord)
            ->with('success_message', 'Inspection updated successfully.');
    }

    public function inspectionDestroy(MedicalRecord $medicalRecord, Inspection $inspection)
    {
        $inspection->delete();

        return redirect()->route('doctor.medical.record.inspections.index', $medicalRecord)
            ->with('success_message', 'Inspection deleted successfully.');
    }
}
