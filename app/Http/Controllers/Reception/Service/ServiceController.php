<?php

namespace App\Http\Controllers\Reception\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
class ServiceController extends Controller
{
    //

    public function index()
    {
        $services = Service::all();
        return view('Reception.Service.index', compact('services'));
    }

    public function create()
    {
        return view('Reception.Service.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'more_info' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service = Service::where('name', $validatedData['name'])->first();
        if ($service) {
            return redirect()->route('reception.service.index')->with('error_message', 'Service already exists');
        }

        $image = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('ServiceImage', $image, 'image');

        $service = Service::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'more_info' => $validatedData['more_info'],
            'status' => $validatedData['status'],
            'image' => $path,
            'created_by' => Auth::guard('reception')->user()->id,
        ]);
        return redirect()->route('reception.service.index')->with('success_message', 'Service created successfully');
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('Reception.Service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'more_info' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service = Service::find($id);
        
        if ($service->name !== $validatedData['name']) {
            $existingService = Service::where('name', $validatedData['name'])->first();
            if ($existingService) {
                return redirect()->route('reception.service.index')->with('error_message', 'Service name already exists');
            }
        }

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('ServiceImage', $image, 'image');
            $validatedData['image'] = $path;
        }

        $service->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'more_info' => $validatedData['more_info'],
            'status' => $validatedData['status'],
            'image' => $validatedData['image'] ?? $service->image,
        ]);

        return redirect()->route('reception.service.index')->with('success_message', 'Service updated successfully');
    }

    public function delete($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return redirect()->route('reception.service.index')->with('error_message', 'Service not found');
        }
        $service->delete();
        return redirect()->route('reception.service.index')->with('success_message', 'Service deleted successfully');
    }
    
    
    
    
}
