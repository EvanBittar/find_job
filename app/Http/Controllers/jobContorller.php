<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;

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
        $user = \App\Models\User::find(1);
        return view('job.post-job', compact('user'));
    }
    public function saveJob(Request $request)
    {
        // 1. التحقق من البيانات (Validation)
        $request->validate([
            'title' => 'required|max:200',
            'category' => 'required',
            'job_nature' => 'required',
            'vacancy' => 'required|integer|min:1',
            'location' => 'required',
            'description' => 'required',
            'company_name' => 'required',
        ]);

        // 2. الحفظ في قاعدة البيانات
        Job::create([
            'title' => $request->title,
            'category' => $request->category,
            'job_nature' => $request->job_nature,
            'vacancy' => $request->vacancy,
            'salary' => $request->salary,
            'location' => $request->location, // موقع الوظيفة
            'description' => $request->description,
            'benefits' => $request->benefits,
            'responsibility' => $request->responsibility,
            'qualifications' => $request->qualifications,
            'keywords' => $request->keywords,
            'company_name' => $request->company_name,
            'company_location' => $request->company_location, // موقع الشركة
            'company_website' => $request->website,
            'user_id' => 1
        ]);

        // 3. العودة مع رسالة نجاح
        return back()->with('success', 'Job has been posted successfully!');
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
