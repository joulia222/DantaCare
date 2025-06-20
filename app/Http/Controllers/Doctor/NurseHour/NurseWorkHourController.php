<?php

namespace App\Http\Controllers\Doctor\NurseHour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\NurseWorkHour;
use Illuminate\Support\Facades\Auth;
use App\Models\Nurse;

class NurseWorkHourController extends Controller
{
    //
    public function index()
    {
            $doctorDepartment = Doctor::where('id' , Auth::guard('doctor')->user()->id)->first()->department_id;
            $nurseWorkHours = NurseWorkHour::whereHas('nurse' , function($query) use ($doctorDepartment){
                $query->where('department_id' , $doctorDepartment);
            })->get();
            return view('doctor.NurseHour.index', compact('nurseWorkHours'));
    }

    public function create()
    {
        $doctorDepartment = Doctor::where('id' , Auth::guard('doctor')->user()->id)->first()->department_id;
        $nurses = Nurse::where('department_id' , $doctorDepartment)->get();
        return view('doctor.NurseHour.create', compact('nurses'));
    }

    public function store(Request $request)
    {
        $valedatedData = $request->validate([
            'nurse_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $checkNurseWorkHour = NurseWorkHour::where('nurse_id' , $valedatedData['nurse_id'])->where('date' , $valedatedData['date'])->first();
        if($checkNurseWorkHour){
            return redirect()->route('doctor.nurse.hour.index')->with('error_message' , 'Nurse Work Hour Already Exists');
        }
        NurseWorkHour::create([
            'nurse_id' => $valedatedData['nurse_id'],
            'date' => $valedatedData['date'],
            'start_time' => $valedatedData['start_time'],
            'end_time' => $valedatedData['end_time'],
            'created_by' => Auth::guard('doctor')->user()->id,
        ]);
        return redirect()->route('doctor.nurse.hour.index')->with('success_message' , 'Nurse Work Hour Created Successfully');
    }

    public function edit($id)
    {
        $nurseWorkHour = NurseWorkHour::find($id);
        return view('doctor.NurseHour.edit', compact('nurseWorkHour'));
    }

    public function update(Request $request , $id)
    {   
        $valedatedData = $request->validate([
            'nurse_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $nurseWorkHour = NurseWorkHour::find($id);

        // Check if another record exists for same nurse and date (excluding current record)
        $exists = NurseWorkHour::where('nurse_id', $valedatedData['nurse_id'])
            ->where('date', $valedatedData['date'])
            ->where('id', '!=', $id)
            ->exists();

        if($exists) {
            return redirect()->route('doctor.nurse.hour.index')
                ->with('error_message', 'Nurse Work Hour Already Exists for this Date');
        }

        $nurseWorkHour->update([
            'nurse_id' => $valedatedData['nurse_id'],
            'date' => $valedatedData['date'],
            'start_time' => $valedatedData['start_time'],
            'end_time' => $valedatedData['end_time'],
            'created_by' => Auth::guard('doctor')->user()->id,
        ]);

        return redirect()->route('doctor.nurse.hour.index')
            ->with('success_message', 'Nurse Work Hour Updated Successfully');
    }

    public function destroy($id)
    {
        $nurseWorkHour = NurseWorkHour::find($id);
        $nurseWorkHour->delete();
        return redirect()->route('doctor.nurse.hour.index')->with('success_message' , 'Nurse Work Hour Deleted Successfully');
    }
}