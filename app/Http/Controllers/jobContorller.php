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
    public function jobDetail($id)
    {
        $job=Job::findOrFail($id);
        return view('job.job-detail', compact('job'));
    }

    public function postJob()
    {
        $user = auth()->user();
        return view('job.post-job', compact('user'));
    }
    public function saveJob(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'category' => 'required',
            'job_nature' => 'required',
            'vacancy' => 'required|integer|min:1',
            'location' => 'required',
            'description' => 'required',
            'company_name' => 'required',
        ]);

        Job::create([
            'title' => $request->title,
            'category' => $request->category,
            'job_nature' => $request->job_nature,
            'vacancy' => $request->vacancy,
            'salary' => $request->salary,
            'location' => $request->location,
            'description' => $request->description,
            'benefits' => $request->benefits,
            'responsibility' => $request->responsibility,
            'qualifications' => $request->qualifications,
            'keywords' => $request->keywords,
            'company_name' => $request->company_name,
            'company_location' => $request->company_location,
            'company_website' => $request->website,
            'user_id' => 1
        ]);

        return back()->with('success', 'Job has been posted successfully!');
    }
    public function myJob()
    {
        $jobs = Job::where('user_id', 1)->orderBy('created_at', 'DESC')->paginate(10);
        
        $user = auth()->user(); // Assuming you want to fetch the authenticated user
        return View('account.my-jobs', compact('user', 'jobs'));
    }
    public function updateJob(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200',
            'category' => 'required',
            'job_nature' => 'required',
            'vacancy' => 'required|integer|min:1',
            'location' => 'required',
            'description' => 'required',
            'company_name' => 'required',
        ]);

        $job = Job::where(['id' => $id, 'user_id' => 1])->first();

        if (!$job) {
            return back()->with('error', 'Job not found or unauthorized.');
        }

        $job->update([
            'title' => $request->title,
            'category' => $request->category,
            'job_nature' => $request->job_nature,
            'vacancy' => $request->vacancy,
            'salary' => $request->salary,
            'location' => $request->location,
            'description' => $request->description,
            'benefits' => $request->benefits,
            'responsibility' => $request->responsibility,
            'qualifications' => $request->qualifications,
            'keywords' => $request->keywords,
            'company_name' => $request->company_name,
            'company_location' => $request->company_location,
            'company_website' => $request->website,
        ]);

        return back()->with('success', 'Job updated successfully!');
    }
    public function editJob($id)
    {
        $job = Job::where(['id' => $id, 'user_id' => 1])->firstOrFail(); // Ensure the job belongs to the user 
        $user = auth()->user();

        return view('job.edit', compact('job', 'user'));
    }
    public function deleteJob($id)
    {
        $job = Job::where(['id' => $id, 'user_id' => 1])->first();

        if (!$job) {
            return back()->with('error', 'Job not found.');
        }

        $job->delete();

        return back()->with('success', 'Job removed successfully!');
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
