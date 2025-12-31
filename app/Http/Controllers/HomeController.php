<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// Checks whether the user is logged in
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Check the user type
        // If the user type is customer, the user will be directed to the home page
        // However, if the user type is admin, the user will be directed to the admin dashboard page

        // When a user tries to log in,
        // Get the user_type from the users table in the database
        if (Auth::user()->user_type == 'customer') {
            return redirect('/');
        } else {
            return redirect()->route('admin.overview');
        }
    }
}
