<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Hash;

class accountController extends Controller
{
    public function account()
    {
        $user= \App\Models\User::find(1);
        return View('account.account',compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = User::find(1);

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'designation' => 'nullable',
            'mobile' => 'nullable|numeric',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }
    
    public function updatePassword(Request $request){

       $user = User::find(1); 

        $attributes = request()->validate([
            'old_password'=>['required','max:25'],
            'new_password'=>['required','confirmed','min:8','max:25'],
        ]);

        if(!Hash::check($attributes['old_password'],$user->password)){
            return back()->withErrors([
                'old_password'=>'The old password does not match'
            ]);
        }
        $user->update([
            'password'=>Hash::make($attributes['new_password'])
        ]);
        return back()->with('success', 'Password changed successfully!');
    }
    public function myJob()
    {
        $jobs = Job::where('user_id',1)->orderBy('created_at', 'DESC')->get();
        
        $user = User::find(1);

        return View('account.my-jobs',compact('user','jobs'));
    }
}
