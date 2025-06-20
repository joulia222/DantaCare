<?php

namespace App\Http\Controllers\StoreKeeperEmployee\SuppliesRequest;

use App\Http\Controllers\Controller;
use App\Models\MedicalSupplies;
use App\Models\SuppliesRequest;
use Illuminate\Http\Request;

class SuppliesRequestController extends Controller
{
    //

    public function index($status = 'all')
    {
        if ($status === 'all') {
            $suppliesRequests = SuppliesRequest::all();
        } else {
            $suppliesRequests = SuppliesRequest::where('status', $status)->get();
        }
        
        return view('StoreKeeperEmployee.SuppliesRequest.index', compact('suppliesRequests', 'status'));
    }

    public function approve($id)
    {
       $suppliesRequest = SuppliesRequest::where('id' , $id)->first();
       if(!$suppliesRequest)
       {
        return redirect()->back()->with('error_message' , 'Supplies Request Dont Found');
       }

       $medicalSuppliesID = $suppliesRequest->medical_supplies_id;
       $medicalSupplies = MedicalSupplies::where('id' , $medicalSuppliesID)->first();
       if(!$medicalSupplies)
       {
        return redirect()->back()->with('error_message' , 'Medical Supplies Dont Found');
       }
       $medicalSuppliesQuantity = $medicalSupplies->quantity;
       $suppliesRequestQuantity = $suppliesRequest->quantity;
       if($suppliesRequestQuantity > $medicalSuppliesQuantity)
       {
        return redirect()->back()->with('error_message' , 'Medical Supplies Quantity Dont Enough');
       }

       $newQuantity = $medicalSuppliesQuantity - $suppliesRequestQuantity;

       $medicalSupplies->update([
        'quantity' => $newQuantity
       ]);

       $suppliesRequest->update([
        'status' => 'completed'
       ]);

       return redirect()->back()->with('success_message' , 'Supplies Request Completed Successfully');

    }

    public function reject(Request $request , $id)
    {
        $validatedData = $request->validate([
            'reject_cause' => 'required|string'
        ]);

       $suppliesRequest = SuppliesRequest::where('id' , $id)->first();
       if(!$suppliesRequest)
       {
        return redirect()->back()->with('error_message' , 'Supplies Request Dont Found');
       }

       $suppliesRequest->update([
        'status' => 'cancelled',
        'reject_cause' => $validatedData['reject_cause']
       ]);

       return redirect()->back()->with('success_message' , 'Supplies Request Cancelled Successfully');
    
    }

    public function return(Request $request , $id)
    {
        $validatedData = $request->validate([
            're_entry_date' => 'required',
            'is_return_in_date' => 'required'
        ]);

       $suppliesRequest = SuppliesRequest::where('id' , $id)->first();
       if(!$suppliesRequest)
       {
        return redirect()->back()->with('error_message' , 'Supplies Request Dont Found');
       }

       $suppliesRequest->update([
        're_entry_date' => $validatedData['re_entry_date'],
        'is_return_in_date' => $validatedData['is_return_in_date']
       ]);

       $medicalSuppliesID = $suppliesRequest->medical_supplies_id;
       $medicalSupplies = MedicalSupplies::where('id' , $medicalSuppliesID)->first();
       if(!$medicalSupplies)
       {
        return redirect()->back()->with('error_message' , 'Medical Supplies Dont Found');
       }
       $medicalSuppliesQuantity = $medicalSupplies->quantity;
       $suppliesRequestQuantity = $suppliesRequest->quantity;
       $newQuantity = $suppliesRequestQuantity + $medicalSuppliesQuantity;
       $medicalSupplies->update([
          'quantity' => $newQuantity
       ]);

       return redirect()->back()->with('success_message' , 'Supplies Request Returned Quantity Successfully');

    }


}
