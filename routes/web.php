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
Route::get('/job-detail',[jobContorller::class,'jobDetail']); 
Route::get('/post-job',[jobContorller::class,'postJob']); 
Route::get('/job-applied',[jobContorller::class,'jobApplied']);
Route::get('/saved-jobs',[jobContorller::class,'savedJob']);


Route::get('/account',[accountController::class,'account']);
Route::get('/my-jobs',[accountController::class,'myJob']);

Route::put('/account/update-password', [accountController::class, 'updatePassword'])->name('account.updatePassword');
Route::put('/account/update-profile', [accountController::class, 'updateProfile'])->name('account.updateProfile');
Route::put('/account/update-image', [accountController::class, 'updateImage'])->name('account.updateImage');