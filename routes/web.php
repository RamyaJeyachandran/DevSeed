<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HospitalSettingsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalBranchController;
use App\Http\Controllers\ConsentFromController;
use App\Http\Controllers\DashboardController;

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
Route::post('login',[AuthController::class,'loginUser']);
Route::get('login/{errorMsg}',[AuthController::class,'login']);
Route::get('login',[AuthController::class,'logout']);
// Route::post('login','AuthController@loginUser');
// Route::get('login/{errorMsg}','AuthController@login');
// Route::get('logout','AuthController@logout');

Route::get('Home',[DashboardController::class,'index'])->middleware('customAuth');
Route::get('Hospital',[HospitalSettingsController::class,'index'])->middleware('customAuth');
// Route::get('Home','DashboardController@index')->middleware('customAuth');
// Route::get('Hospital','HospitalSettingsController@index')->middleware('customAuth');


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
Route::get('reportSA', function () {
    return view('pages.reportSA');
});
Route::get('SearchConsent', function () {
    return view('pages.SearchConsentForm');
});
Route::get('ResetPassword', function () {
    return view('pages.changePassword');
});
Route::get('ViewConsent', function () {
    return view('pages.viewConsentForm');
});
Route::get('PatientAppointment', function () {
    return view('pages.addAppointment');
});
Route::get('AllAppointments', function () {
    return view('pages.searchAppointment');
});

Route::get('/ConsentForm/{patientConsentId?}',[ConsentFromController::class,'index']);

// Route::controller(LoginController::class)->group(function() {
//     Route::get('error', 'errorPage')->name('error');
//     Route::post('login', 'verifyUser')->name('loginVerify');
//     // Route::get('cityList', 'getCities')->name('cityList');
// });
Route::controller(HospitalSettingsController::class)->group(function() {
    Route::get('Hospital', 'show')->name('HospitalSettings');
});
Route::get('/showPatient/{id}',[PatientController::class,'showEdit']);
Route::get('/showDoctor/{id}',[DoctorController::class,'showEdit']);
Route::get('/showHospital/{id}',[HospitalSettingsController::class,'showEdit']);
Route::get('/showBranch/{id}',[HospitalBranchController::class,'showEdit']);

// Auth::routes();

