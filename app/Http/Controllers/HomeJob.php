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
        return view('login');
    }
    public function jobs()
    {
        return view('jobs');
    }
    public function jobDetail()
    {
        return view('job-detail');
    }
    public function postJob()
    {
        return view('post-job');
    }
    public function register()
    {
        return view('register');
    }
    public function jobApplied()
    {   
        return View('job-applied');
    }
    public function account()
    {
        return View('account');
    }   
    public function myJob()
    {
        return View('my-jobs');
    }
    public function savedJob()
    {
        return View('saved-job');
    }
}
