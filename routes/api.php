<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalSettingsController;
use App\Http\Controllers\HospitalBranchController;
use App\Http\Controllers\ConsentFromController;
use App\Http\Controllers\AppointmentController;
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

Route::get('getCommonData',[CommonController::class,'getPatientddl']);
Route::get('listCity',[CommonController::class,'getCities']);
Route::get('listBloodGroup',[CommonController::class,'getBloodGroup']);
Route::get('listAppointmentDDl',[CommonController::class,'getAppointmentddl']);


Route::get('patientList',[PatientController::class,'getAllPatient']);
// Route::get('getsamplehospital',[PatientController::class,'getsamplehospital']);
// Route::get('getsampledoctor',[PatientController::class,'getsampledoctor']);
Route::post('addPatient',[PatientController::class,'registerPatient']);
Route::get('patientInfo/{id}',[PatientController::class,'getPatientById']);
Route::post('updatePatient',[PatientController::class,'updatePatient']);
Route::get('deletePatient/{id}/{userId}',[PatientController::class,'deletePatient']);
Route::post('addDoctor',[DoctorController::class,'registerDoctor']);
Route::get('doctorList',[DoctorController::class,'getAllDoctor']);
Route::get('getDoctorCommonData',[CommonController::class,'getDoctorddl']);
Route::get('doctorInfo/{id}',[DoctorController::class,'getDoctorById']);
Route::post('updateDoctor',[DoctorController::class,'updateDoctor']);
Route::get('deleteDoctor/{id}/{userId}',[DoctorController::class,'deleteDoctor']);
Route::get('doctorByDepartment/{hospitalId}/{branchId}/{departId}',[DoctorController::class,'getDoctorByDepartment']);
Route::post('addHospital',[HospitalSettingsController::class,'saveHospitalSettings']);
Route::get('hospitalList',[HospitalSettingsController::class,'getAllHospitalSettings']);
Route::get('deleteHospital/{id}/{userId}',[HospitalSettingsController::class,'deleteHospital']);
Route::post('updateHospital',[HospitalSettingsController::class,'updateHospitalSetings']);
Route::get('hospitalInfo/{id}',[HospitalSettingsController::class,'getHospitalSettingsById']);
Route::get('listAllHospital',[HospitalBranchController::class,'getHospitalList']);
Route::post('addBranch',[HospitalBranchController::class,'saveHospitalBranch']);
Route::get('branchList',[HospitalBranchController::class,'getAllHospitalBranch']);
Route::get('branchInfo/{id}',[HospitalBranchController::class,'getHospitalBranchById']);
Route::get('deleteBranch/{id}/{userId}',[HospitalBranchController::class,'deleteBranch']);
Route::post('updateBranch',[HospitalBranchController::class,'updateBranchHospital']);
// Route::get('convertToHash/{id}',[loginController::class,'convertToHash']);
Route::get('getCrypId',[loginController::class,'getCrypId']);
Route::get('consentFormList/{hospitalId}/{branchId}/{hcNo}',[ConsentFromController::class,'getFormList']);
Route::post('savePatientConsent',[ConsentFromController::class,'saveConsentForm']);
Route::get('patientConsentList',[ConsentFromController::class,'getPatientConsentDetails']);
Route::get('registeredPatientInfo/{hcNo}/{hospitalId}/{branchId}',[AppointmentController::class,'getPatientInfo']);
Route::post('addPatientAppointment',[AppointmentController::class,'addAppointment']);
Route::get('appointmentList',[AppointmentController::class,'getAllAppointment']);



