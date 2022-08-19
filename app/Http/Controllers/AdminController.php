<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function subscribers()
    {
        if (Auth::user()->is_admin != TRUE) {
            return view('admin.dashbaord');
        } else {
            return view('home');
        }
    }
}