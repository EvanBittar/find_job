<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\job_applications;

class jobContorller extends Controller
{
    public function jobs()
    {
        return view('job.jobs');
    }
    public function jobDetail($id)
    {
        $job = Job::findOrFail($id);
        return view('job.job-detail', compact('job'));
    }

    public function postJob()
    {
        $user = Auth::user();
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
            'user_id' =>Auth::user()->id
        ]);

        return back()->with('success', 'Job has been posted successfully!');
    }
    public function myJob()
    {
        $jobs = Job::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);

        $user = Auth::user(); // Assuming you want to fetch the authenticated user
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

        $job = Job::where(['id' => $id, 'user_id' => Auth::user()->id])->first();

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
        $job = Job::where(['id' => $id, 'user_id' => Auth::user()->id])->firstOrFail(); // Ensure the job belongs to the user 
        $user = Auth::user()->id;

        return view('job.edit', compact('job', 'user'));
    }
    public function deleteJob($id)
    {
        $job = Job::where(['id' => $id, 'user_id' => Auth::user()->id])->first();

        if (!$job) {
            return back()->with('error', 'Job not found.');
        }

        $job->delete();

        return back()->with('success', 'Job removed successfully!');
    }


    public function savedJob()
    {
        return View('job.saved-job');
    }
    public function applyJob(Request $request)
    {
        $id = $request->id;
        $job = Job::where('id', $id)->first();

        // 1. هل الوظيفة موجودة؟
        if ($job == null) {
            return response()->json(['status' => false, 'message' => 'Job not found']);
        }

        // 2. هل المستخدم يحاول التقديم على وظيفته الخاصة؟
        if ($job->user_id == Auth::user()->id) {
            return response()->json(['status' => false, 'message' => 'You cannot apply to your own job']);
        }

        // 3. هل قدم المستخدم على هذه الوظيفة من قبل？
        $jobApplicationCount = job_applications::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id
        ])->count();

        if ($jobApplicationCount > 0) {
            return response()->json(['status' => false, 'message' => 'You have already applied to this job']);
        }

        // 4. حفظ الطلب
        $application = new job_applications();
        $application->job_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $job->user_id;
        $application->applied_date = now();
        $application->save();

        return response()->json(['status' => true, 'message' => 'Applied successfully!']);
    }
    public function jobApplied()
    {
        $user = Auth::user();
        
        $applications = job_applications::where('user_id', Auth::user()->id)
            ->with(['job', 'job.jobType', 'job.category']) // جلب بيانات الوظيفة معها
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('job.job-applied', compact('applications', 'user'));
    }
}
