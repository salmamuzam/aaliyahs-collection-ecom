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
        return auth()->user()->user_type === 'admin'
            ? redirect()->route('admin.overview')
            : redirect('/');
    }
}
