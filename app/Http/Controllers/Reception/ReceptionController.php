<?php

namespace App\Http\Controllers\Reception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    //

    public function index()
    {
        return view('Reception.index');
    }

}
