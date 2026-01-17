<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class accountController extends Controller
{
    public function account()
    {
        return View('account.account');
    }
    public function myJob()
    {
        return View('account.my-jobs');
    }
}
