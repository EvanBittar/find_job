<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Favorite;
use App\Models\job_applications;

class jobContorller extends Controller
{
    public function jobs()
    {
        return view('job.jobs');
    }
    public function jobDetail($id)
    {
        $job = Job::where('id',$id)->first();
        if ($job== null)
            return abort(404);
        $isFavorite = false;
        if (Auth::check()){
            $isFavorite = Favorite::where([
                'user_id' => Auth::user()->id,
                 'job_id' => $id
                 ])->exists();
        }
        return view('job.job-detail', compact(['job' , 'isFavorite']));

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
        return back()->with('error', 'Job not found');
    }

    // 2. منع التقديم على الوظيفة الخاصة
    if ($job->user_id == Auth::user()->id) {
        return back()->with('error', 'You cannot apply to your own job');
    }

    // 3. منع التكرار
    $jobApplicationCount = job_applications::where([
        'user_id' => Auth::user()->id,
        'job_id' => $id
    ])->count();

    if ($jobApplicationCount > 0) {
        return back()->with('error', 'You have already applied to this job');
    }

    // 4. حفظ الطلب
    $application = new job_applications();
    $application->job_id = $id;
    $application->user_id = Auth::user()->id;
    $application->applied_date = now();
    $application->save();

    // التوجيه لصفحة الوظائف التي قدم عليها مع رسالة نجاح
    return redirect()->route('jobApplied')->with('success', 'Applied successfully!');
}
    public function jobApplied()
    {
        $user = Auth::user();
        
        $applications = job_applications::where('user_id', $user->id)
            ->with('job') // جلب بيانات الوظيفة معها
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('job.job-applied', compact('applications', 'user'));
    }
    // 1. إضافة للمفضلة
public function addToFavorite(Request $request) {
    $id = $request->id;
    $job = Job::find($id);

    if ($job == null) {
        return back()->with('error', 'Job not found.');
    }

    $alreadyFavorited = Favorite::where([
        'user_id' => Auth::user()->id,
        'job_id' => $id
        ])->first();
    
    if ($alreadyFavorited) {
        $alreadyFavorited->delete(); 
        return back()->with('success', 'Removed from favorites.');
    }else{
        Favorite::create([
            'job_id' => $id,
            'user_id' => Auth::user()->id
        ]);
    }
    return back()->with('success', 'Job added to favorites ❤️');
}

// 2. عرض قائمة المفضلات
public function myFavorites() {
    $user = Auth::user();
    $favorites = Favorite::where('user_id', $user->id)
        ->with('job')
        ->orderBy('created_at', 'DESC')
        ->paginate(10);

    return view('job.my-favorites', compact('favorites', 'user'));
}

// 3. حذف من المفضلة
public function removeFavorite(Request $request) {
    Favorite::where(['user_id' => Auth::user()->id, 'id' => $request->id])->delete();
    return back()->with('success', 'Removed from favorites.');
}
}
