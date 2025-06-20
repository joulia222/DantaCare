<?php

namespace App\Http\Controllers\Doctor\SuppliesRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuppliesRequest;
use App\Models\MedicalSupplies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class SuppliesRequestController extends Controller
{
    //

    public function index($status = 'all')
    {
        $doctor_id = Auth::guard('doctor')->user()->id;
        
        if ($status === 'all') {
            $suppliesRequests = SuppliesRequest::where('doctor_id', $doctor_id)->get();
        } else {
            $suppliesRequests = SuppliesRequest::where('doctor_id', $doctor_id)
                ->where('status', $status)
                ->get();
        }
        
        return view('Doctor.SuppliesRequest.index', compact('suppliesRequests', 'status'));
    }

    public function create()
    {
        $medicalSupplies = MedicalSupplies::all();
        return view('Doctor.SuppliesRequest.create', compact('medicalSupplies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'medical_supplies_id' => 'required|exists:medical_supplies,id',
            'quantity' => 'required|integer|min:1',
            'taken_date' => 'nullable|date',
            're_entry_date' => 'nullable|date',
        ]);

        $medicalSupplies = MedicalSupplies::find($validatedData['medical_supplies_id']);
        if(!$medicalSupplies){
            return redirect()->route('doctor.supplies.request.create')
                ->with('error_message', 'Medical supplies not found.');
        }
        $type = $medicalSupplies->type;
        $medicalSuppliesQuantity = $medicalSupplies->quantity;
        if($medicalSuppliesQuantity < $validatedData['quantity']){
            return redirect()->route('doctor.supplies.request.create')
                ->with('error_message', 'Quantity is not available.');
        }

        // Validate re-entry date for device type
        if ($type === 'device' && empty($validatedData['re_entry_date'])) {
            return redirect()->route('doctor.supplies.request.create')
                ->with('error_message', 'Re-entry date is required for device type.');
        }

        SuppliesRequest::create([
            'medical_supplies_id' => $validatedData['medical_supplies_id'],
            'type' => $type,
            'quantity' => $validatedData['quantity'],
            'taken_date' => $validatedData['taken_date'] ?? null,
            're_entry_date' => $validatedData['re_entry_date'] ?? null,
            'doctor_id' => Auth::guard('doctor')->user()->id,
            'status' => 'pending',
        ]);

        return redirect()->route('doctor.supplies.request.index')
            ->with('success_message', 'Supplies request created successfully.');
    }

    public function edit(SuppliesRequest $suppliesRequest)
    {
        // Check if the request belongs to the current doctor and is pending
        if ($suppliesRequest->doctor_id !== Auth::guard('doctor')->user()->id || $suppliesRequest->status !== 'pending') {
            return redirect()->route('doctor.supplies.request.index')
                ->with('error_message', 'You can only edit pending requests that belong to you.');
        }

        $medicalSupplies = MedicalSupplies::all();
        return view('Doctor.SuppliesRequest.edit', compact('suppliesRequest', 'medicalSupplies'));
    }

    public function update(Request $request, SuppliesRequest $suppliesRequest)
    {
        // Check if the request belongs to the current doctor and is pending
        if ($suppliesRequest->doctor_id !== Auth::guard('doctor')->user()->id || $suppliesRequest->status !== 'pending') {
            return redirect()->route('doctor.supplies.request.index')
                ->with('error_message', 'You can only edit pending requests that belong to you.');
        }

        $validatedData = $request->validate([
            'medical_supplies_id' => 'required|exists:medical_supplies,id',
            'quantity' => 'required|integer|min:1',
            'taken_date' => 'nullable|date',
            're_entry_date' => 'nullable|date',
        ]);

        $medicalSupplies = MedicalSupplies::find($validatedData['medical_supplies_id']);
        if(!$medicalSupplies){
            return redirect()->route('doctor.supplies.request.edit', $suppliesRequest)
                ->with('error_message', 'Medical supplies not found.');
        }

        $type = $medicalSupplies->type;
        $medicalSuppliesQuantity = $medicalSupplies->quantity;
        
        // Check if the new quantity is available
        if($medicalSuppliesQuantity < $validatedData['quantity']){
            return redirect()->route('doctor.supplies.request.edit', $suppliesRequest)
                ->with('error_message', 'Quantity is not available.');
        }

        // Validate re-entry date for device type
        if ($type === 'device' && empty($validatedData['re_entry_date'])) {
            return redirect()->route('doctor.supplies.request.edit', $suppliesRequest)
                ->with('error_message', 'Re-entry date is required for device type.');
        }

        // Prepare update data
        $updateData = [
            'medical_supplies_id' => $validatedData['medical_supplies_id'],
            'type' => $type,
            'quantity' => $validatedData['quantity'],
            'taken_date' => $validatedData['taken_date'] ?? null,
        ];

        // Handle re-entry date based on type
        if ($type === 'device') {
            $updateData['re_entry_date'] = $validatedData['re_entry_date'];
        } else {
            $updateData['re_entry_date'] = null;
        }

        $suppliesRequest->update($updateData);

        return redirect()->route('doctor.supplies.request.index')
            ->with('success_message', 'Supplies request updated successfully.');
    }
}
