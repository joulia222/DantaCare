<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    public function index ()
    {
        $appointments = Appointment::all();
        return view("Admin.Appointment.index",compact('appointments'));
    }
}
