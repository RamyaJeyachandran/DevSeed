<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\MixedTables;

class CommonController extends Controller
{
    public function getCities(Request $request)
    {
        try{
            $cities = new Cities;
            $city_list =  $cities->getCities(); 
            if($city_list!=null)
            {
                $result['cities']=$city_list;
                $result['Success']='Success';
                $result['Message']="Fetched Cities";
                return response()->json($result,200);
            }            
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
        $result['Success']='failure';
            $result['Message']="No cities found";
            return response()->json($result,200);
    }
    
    public function getPatientddl(Request $request)
    {
        try{
            $cities = new Cities;
            $city_list =  $cities->getCities(); 

            $mixedTable = new MixedTables;
            $genderList =  $mixedTable->getGender(); 
            $maritalStatusList=$mixedTable->getMartialStatus();
            $refferedByList=$mixedTable->getRefferedBy();
            $bloodGrp=$mixedTable->getBloodGrp();

                $result['cities']=$city_list;
                $result['gender']=$genderList;
                $result['martialStatus']=$maritalStatusList;
                $result['refferedBy']=$refferedByList;
                $result['bloodGrp']=$bloodGrp;
                $result['Success']='Success';
                $result['Message']="Fetched Successfully";
                return response()->json($result,200);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
        $result['Success']='failure';
            $result['Message']="No cities found";
            return response()->json($result,200);
    }
    public function getDoctorddl(Request $request)
    {
        try{
            $mixedTable = new MixedTables;
            $genderList =  $mixedTable->getGender(); 
            $departmentList=$mixedTable->getDepartment();
            $bloodGrp=$mixedTable->getBloodGrp();

                $result['gender']=$genderList;
                $result['department']=$departmentList;
                $result['bloodGrp']=$bloodGrp;
                $result['Success']='Success';
                $result['Message']="Fetched Successfully";
                return response()->json($result,200);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
        $result['Success']='failure';
            $result['Message']="No record found";
            return response()->json($result,200);
    }

}
