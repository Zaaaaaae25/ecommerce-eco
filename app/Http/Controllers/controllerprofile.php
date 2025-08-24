<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controllerprofile extends Controller
{
    public function index()
    {
        return view('profile');
    }
}
