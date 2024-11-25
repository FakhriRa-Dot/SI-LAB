<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AsistenController extends Controller
{
    public function dashboard()
    {
        return view('asisten.dashboard');
    }
}