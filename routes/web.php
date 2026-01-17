<?php

use App\Http\Controllers\HomeJob;
use App\Http\Controllers\jobContorller;
use App\Http\Controllers\accountController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeJob::class,'index']); 
Route::get('/login',[HomeJob::class,'login']);
Route::get('/register',[HomeJob::class,'register']); 

Route::get('/jobs',[jobContorller::class,'jobs']); 
Route::get('/job-detail',[jobContorller::class,'jobDetail']); 
Route::get('/post-job',[jobContorller::class,'postJob']); 
Route::get('/job-applied',[jobContorller::class,'jobApplied']);
Route::get('/saved-jobs',[jobContorller::class,'savedJob']);


Route::get('/account',[accountController::class,'account']);
Route::get('/my-jobs',[accountController::class,'myJob']);

