<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\PatientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route::controller(LoginController::class)->group(function() {
//     Route::get('getCities')->name('listCity');
//     Route::get('getBloodGroup')->name('listBloodGroup');
//     // Route::get('cityList', 'getCities')->name('cityList');
// });

Route::get('listCity',[CommonController::class,'getCities']);
Route::get('listBloodGroup',[CommonController::class,'getBloodGroup']);
Route::get('getsamplepatient',[PatientController::class,'getsamplepatient']);
Route::get('getsamplehospital',[PatientController::class,'getsamplehospital']);
Route::get('getsampledoctor',[PatientController::class,'getsampledoctor']);