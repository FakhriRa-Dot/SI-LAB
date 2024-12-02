<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get logged-in user's data
        $user = Auth::user(); // Fetch the authenticated user
        
        // Pass the data to the view
        return view('admin.dashboard', compact('user'));
    }
}
