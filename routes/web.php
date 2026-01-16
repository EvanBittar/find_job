<?php

use App\Http\Controllers\HomeJob;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeJob::class,'index']); 
Route::get('/login',[HomeJob::class,'login']);
Route::get('/jobs',[HomeJob::class,'jobs']); 
Route::get('/job-detail',[HomeJob::class,'jobDetail']); 
Route::get('/post-job',[HomeJob::class,'postJob']); 
Route::get('/register',[HomeJob::class,'register']); 
Route::get('/job-applied',[HomeJob::class,'jobApplied']);
Route::get('/account',[HomeJob::class,'account']);
Route::get('/my-jobs',[HomeJob::class,'myJob']);
Route::get('/saved-jobs',[HomeJob::class,'savedJob']);
