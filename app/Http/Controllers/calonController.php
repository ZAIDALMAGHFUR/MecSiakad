<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class calonController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('dashboard.calon');
    }
}
