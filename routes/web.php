<?php

use App\Http\Controllers\HomeJob;
use App\Http\Controllers\jobContorller;
use App\Http\Controllers\accountController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionCollector;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeJob::class,'index']); 

Route::get('/login',[SessionCollector::class,'login']);
Route::post('/login',[SessionCollector::class,'store']);

Route::get('/register',[RegisterUserController::class,'register']); 
Route::post('/register',[RegisterUserController::class,'store']);

Route::get('/jobs',[jobContorller::class,'jobs']); 
Route::get('/job-detail/{id}',[jobContorller::class,'jobDetail'])->name('jobDetail'); 
Route::get('/post-job',[jobContorller::class,'postJob'])->name('postJob'); 
Route::get('/job-applied',[jobContorller::class,'jobApplied']);
Route::get('/saved-jobs',[jobContorller::class,'savedJob']);
Route::get('/my-jobs',[jobContorller::class,'myJob'])->name('job.myJob');
Route::get('/my-jobs/edit/{id}',[jobContorller::class,'editJob'])->name('job.editJob');
Route::put('/my-jobs/update/{id}',[jobContorller::class,'updateJob'])->name('job.updateJob');

Route::get('/account',[accountController::class,'account']);
Route::put('/account/update-password', [accountController::class, 'updatePassword'])->name('account.updatePassword');
Route::put('/account/update-profile', [accountController::class, 'updateProfile'])->name('account.updateProfile');
Route::put('/account/update-image', [accountController::class, 'updateImage'])->name('account.updateImage');

Route::post('/post-job',[jobContorller::class,'saveJob'])->name('saveJob');