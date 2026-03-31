<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Favorite;
use App\Models\job_applications;

class jobContorller extends Controller
{
 public function index(Request $request) {
    $categories = DB::table('jobs')->select('category')->whereNotNull('category')->distinct()->get();

    $jobs = Job::where('status', 1);

    if (!empty($request->keyword)) {
        $jobs->where(function($query) use ($request) {
            $query->orWhere('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
        });
    }

    if (!empty($request->location)) {
        $jobs->where('location', 'like', '%' . $request->location . '%');
    }

    if (!empty($request->category)) {
        $jobs->where('category', $request->category);
    }

    if (!empty($request->job_type)) {
        $jobs->whereIn('job_nature', (array)$request->job_type);
    }


    $allJobs = $jobs->paginate(9)->withQueryString();

    return view('job.jobs', [
        'jobs' => $allJobs,
        'categories' => $categories
    ]);
}

    public function jobDetail($id)
    {
        $job = Job::where('id',$id)->first();
        if ($job== null)
            return abort(404);
        
        $count = 0;
            if (Auth::check()) {
            $count = job_applications::where([
                'user_id' => Auth::user()->id,
                'job_id' => $id
            ])->count();
        }

        $isFavorite = false;
        if (Auth::check()){
            $isFavorite = Favorite::where([

                'user_id' => Auth::user()->id,
                 'job_id' => $id

                 ])->exists();
        }
        return view('job.job-detail', compact(['job' , 'isFavorite','count']));

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
    public function applyJob(Request $request){
    
    $id = $request->id;
    $job = Job::where('id', $id)->first();

    if ($job == null) {
        return back()->with('error', 'Job not found');
    }

    if ($job->user_id == Auth::user()->id) {
        return back()->with('error', 'You cannot apply to your own job');
    }

    $jobApplicationCount = job_applications::where([
        'user_id' => Auth::user()->id,
        'job_id' => $id
    ])->count();
    
    if ($job->user_id == Auth::user()->id) {
        return redirect()->back()->with('error', 'You cannot apply to your own job.');
    }
    if ($jobApplicationCount > 0) {
        return back()->with('error', 'You have already applied to this job');
    }

    // 4. حفظ الطلب
    $application = new job_applications();
    $application->job_id = $id;
    $application->user_id = Auth::user()->id;
    $application->applied_date = now();
    $application->save();

    return redirect()->route('jobApplied')->with('success', 'Applied successfully!');
}
    public function jobApplied()
    {
        $user = Auth::user();
        
        $applications = job_applications::where('user_id', $user->id)
            ->with('job') 
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('job.job-applied', compact('applications', 'user'));
    }
    

    public function savedJob()
    {
    $user = Auth::user();
    
    $favorites = Favorite::where('user_id', $user->id)
        ->with('job') 
        ->orderBy('created_at', 'DESC')
        ->paginate(10);

    return view('job.saved-job', compact('favorites', 'user'));
    }
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
    public function removeFavorite(Request $request) {
    Favorite::where(['user_id' => Auth::user()->id, 'id' => $request->id])->delete();
    return back()->with('success', 'Removed from favorites.');
}
}
