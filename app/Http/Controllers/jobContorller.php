<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jobContorller extends Controller
{
    public function jobs()
    {
        return view('job.jobs');
    }
    public function jobDetail()
    {
        return view('job.job-detail');
    }
    public function postJob()
    {
        return view('job.post-job');
    }
    public function jobApplied()
    {
        return View('job.job-applied');
    }
    public function savedJob()
    {
        return View('job.saved-job');
    }
}
