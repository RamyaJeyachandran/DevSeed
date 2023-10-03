<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HospitalSettingsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalBranchController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('pages.login')->with('errorMsg','');
});
Route::get('login', function () {
    Session::flush();
    return view('pages.login')->with('errorMsg','');
});
Route::get('branches', function () {
    return view('pages.branches');
});
Route::get('Doctor', function () {
    return view('pages.addDoctor');
});
Route::get('SearchDoctor', function () {
    return view('pages.searchDoctor');
});
Route::get('Branch', function () {
    return view('pages.addBranch');
});
Route::get('SearchBranch', function () {
    return view('pages.searchBranch');
});


Route::get('Patient', function () {
    return view('pages.AddPatient');
});
Route::get('SearchPatient', function () {
    return view('pages.searchPatient');
});
Route::get('SearchHospital', function () {
    return view('pages.searchHospital');
});
Route::get('subscribe', function () {
    return view('pages.subscribe');
});
Route::get('ResetPassword', function () {
    return view('pages.changePassword');
});

Route::get('ConsentForm', function () {
    return view('pages.consentForm');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('error', 'errorPage')->name('error');
    Route::post('login', 'verifyUser')->name('home');
    // Route::get('cityList', 'getCities')->name('cityList');
});
Route::controller(HospitalSettingsController::class)->group(function() {
    Route::get('Hospital', 'show')->name('HospitalSettings');
});
Route::get('/showPatient/{id}',[PatientController::class,'showEdit']);
Route::get('/showDoctor/{id}',[DoctorController::class,'showEdit']);
Route::get('/showHospital/{id}',[HospitalSettingsController::class,'showEdit']);
Route::get('/showBranch/{id}',[HospitalBranchController::class,'showEdit']);

// Auth::routes();

