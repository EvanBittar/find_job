<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name'=>['required','max:25'],
            'email'=>['required','max:25','unique:users'],
            'password'=>['required','confirmed','min:8','max:25'],
        ]);
        
        $user = User::create([
            'name'=>$attributes['name'],
            'email'=>$attributes['email'],
            'password'=>Hash::make($attributes['password']),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
