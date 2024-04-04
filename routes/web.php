<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\showDataController;
use App\Http\Controllers\storeDataController;
use App\Http\Controllers\smsController;
use App\Http\Controllers\smsTwilioController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['auth_check', 'prevent_back_history']], function () {
    Route::get('/login-page', [authController::class, 'loginPage'])->name('login');
    Route::post('/authentication', [authController::class, 'authentication'])->name('authentication');
    Route::post('/nurse-attendance', [storeDataController::class, 'nurseAttendance'])->name('attendance');

});

Route::group(['middleware' => ['auth', 'prevent_back_history']], function () {
    Route::get('/', [showDataController::class, 'dashboard'])->name('dashboard');
    Route::get('/show-nurse', [showDataController::class, 'showNurse'])->name('nurse');
    Route::post('/add-nurse', [storeDataController::class, 'addNurse'])->name('addnurse');
    Route::get('/show-attendance', [showDataController::class, 'attendanceRecord'])->name('showattendance');
    Route::get('/show-bed', [showDataController::class, 'showBed'])->name('showbed');
    Route::post('/add-bed', [storeDataController::class, 'addBed'])->name('addbed');
    Route::get('/show-request', [showDataController::class, 'showRequest'])->name('showrequest');

    //delete route
    Route::post('/delete-bed', [storeDataController::class, 'deleteBed'])->name('deletebed');
    Route::post('/delete-nurse', [storeDataController::class, 'deleteNurse'])->name('deletenurse');

    //African talking
    //Route::get('/sms', [storeDataController::class, 'sendSmsR'])->name('sms');
    Route::get('/sms', [storeDataController::class, 'sendSms'])->name('smstest');
    Route::get('/smstest', [storeDataController::class, 'sendSMSWithVonageAPI'])->name('smstesting');

    // Auth Controller functions
    Route::get('/logout-page', [authController::class, 'logout'])->name('logout');
    Route::post('/change-password', [authController::class, 'changePassword'])->name('changepassword');

});


//call event
Route::get('/seed-event', [storeDataController::class, 'seedEvent']);
Route::get('/optimize-event', [storeDataController::class, 'optimizeEvent']);
Route::get('/cache-event', [storeDataController::class, 'cacheEvent']);

//Sms route
Route::get('/smsnotification', [smsController::class, 'index']);
Route::get('sms/send', [SmsTwilioController::class, 'sendSms']);
