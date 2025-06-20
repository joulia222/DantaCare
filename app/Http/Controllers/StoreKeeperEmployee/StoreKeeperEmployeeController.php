<?php

namespace App\Http\Controllers\StoreKeeperEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreKeeperEmployeeController extends Controller
{
    //
    public function index()
    {
        return view('StoreKeeperEmployee.index');
    }
}
