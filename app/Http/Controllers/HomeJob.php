<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeJob extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('log-reg.login');
    }
    public function register()
    {
        return view('log-reg.register');
    }

}
