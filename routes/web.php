<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\HospitalSettingsController;

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
Route::get('/login', function () {
    return view('pages.login')->with('errorMsg','');
});
Route::get('/branches', function () {
    return view('pages.branches');
});

Route::controller(loginController::class)->group(function() {
    Route::get('/error', 'errorPage')->name('error');
    Route::post('/login', 'verifyUser')->name('home');
});
Route::controller(HospitalSettingsController::class)->group(function() {
    Route::get('/dashboard', 'show')->name('HospitalSettings');
});

// Auth::routes();

