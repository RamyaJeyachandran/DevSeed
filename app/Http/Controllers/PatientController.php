<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function getsamplepatient(Request $request)
    {
        $patient = new Patient;
            $user_details =  $patient->getpatient($request); 
        $result['last_page']=4;
        $result['data']=$user_details;
        return response()->json($result,200);
    }   
    public function getsamplehospital(Request $request)
    {
        $patient = new Patient;
            $user_details =  $patient->gethospital($request); 
        $result['last_page']=1;
        $result['data']=$user_details;
        return response()->json($result,200);
    } 
    public function getsampledoctor(Request $request)
    {
        $patient = new Patient;
            $user_details =  $patient->getdoctor($request); 
        $result['last_page']=4;
        $result['data']=$user_details;
        return response()->json($result,200);
    } 
}
