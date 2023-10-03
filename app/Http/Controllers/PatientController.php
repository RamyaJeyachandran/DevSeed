<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Patient;
use config\constants;
use App\Models\MixedTables;
use App\Models\Cities;

class PatientController extends Controller
{
    public function registerPatient(Request $request)
    {
        try{
            $result=array();
            DB::beginTransaction();
            $validateUser=Validator::make($request->all(), [
                'name'=>'required',
                'phoneNo'=>'required',
                'email'=>'required'
            ]);
            if($validateUser->fails()){
                $result['ShowModal']=1;
                $result['Success']='Failure';
                $result['Message']="Validation failed. Please fill the required field marked as *";
                $result=json_encode($request);
                return response()->json($result,200);
            }
            $hospitalId=(isset($request->hospitalId) && !empty($request->hospitalId)) ?$request->hospitalId : NULL;
            $branchId=(isset($request->branchId) && !empty($request->branchId)) ?$request->branchId : NULL;
            $patient_obj = new Patient;
            $chkPhoneNo=$patient_obj->checkPhoneNo($request->phoneNo,$hospitalId,$branchId);
            if($chkPhoneNo!=NULL){
                $result['ShowModal']=1;
                $result['Success']='Phone No already exists.';
                $result['Message']="Phone No registered patient number : ".$chkPhoneNo->hcNo;
                return response()->json($result,200);
            }
            $hcNo=$patient_obj->generateHcNo($hospitalId);
            $patients =  $patient_obj->addPatient($request,$hcNo); 
            $patientId=$patients->id;
            $result['ShowModal']=1;
            $result['Success']='Success';
            $result['Message']="Patient registered successfully";
            $result['hcNo']="Patient registered Number is ".$hcNo;
            DB::commit();
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['ShowModal']=1;
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }
    public function getAllPatient(Request $request)
    {
        try{
            $pagination['page']=(isset($request->page) && !empty($request->page)) ?$request->page : 1;
            $pagination['size']=(isset($request->size) && !empty($request->size)) ?$request->size : 10;
            $pagination['sorters_field']=(isset($request->sorters[0]['field']) && !empty($request->sorters[0]['field'])) ?$request->sorters[0]['field'] : "id";
            $pagination['sorters_dir']=(isset($request->sorters[0]['dir']) && !empty($request->sorters[0]['dir'])) ?$request->sorters[0]['dir'] : "desc";

            $pagination['filters_field']=(isset($request->filters[0]['field']) && !empty($request->filters[0]['field'])) ?$request->filters[0]['field'] : "";
            $pagination['filters_type']=(isset($request->filters[0]['type']) && !empty($request->filters[0]['type'])) ?$request->filters[0]['type'] : "";
            $pagination['filters_value']=(isset($request->filters[0]['value']) && !empty($request->filters[0]['value'])) ?$request->filters[0]['value'] :"";

            $hospitalId=(isset($request->hospitalId) && !empty($request->hospitalId)) ?$request->hospitalId : NULL;
            $branchId=(isset($request->branchId) && !empty($request->branchId)) ?$request->branchId : 0;

            $patient_obj = new Patient;
            $patientList=$patient_obj->getAllPatient($hospitalId,$branchId,$pagination);
            
            $result['last_page']=$patientList['last_page'];
            $result['data']=$patientList['patientList'];
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }
    public function showEdit(Request $request,$id){
        try{
            $id_orignal="AES_DECRYPT(UNHEX('".$id."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
            $patient_obj = new Patient;
            $patientDetails=$patient_obj->getPatientById($id_orignal);
            $cities = new Cities;
            $patientDetails->city_list =  $cities->getCities(); 

            $mixedTable = new MixedTables;
            $patientDetails->genderList =  $mixedTable->getGender(); 
            $patientDetails->maritalStatusList=$mixedTable->getMartialStatus();
            $patientDetails->refferedByList=$mixedTable->getRefferedBy();
            $patientDetails->bloodGrp=$mixedTable->getBloodGrp();

            return view('pages.editPatient')->with('patientDetails', $patientDetails);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }

    public function getPatientById(Request $request,$id){
        try{
            $id_orignal="AES_DECRYPT(UNHEX('".$id."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
            $patient_obj = new Patient;
            $patientDetails=$patient_obj->getPatientById($id_orignal);
            $result['Success']='Success';
            $result['patientDetails']=$patientDetails;
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }
    public function updatePatient(Request $request)
    {
        try{
            $result=array();
            DB::beginTransaction();
            $validateUser=Validator::make($request->all(), [
                'name'=>'required',
                'phoneNo'=>'required',
                'email'=>'required'
            ]);
            if($validateUser->fails()){
                $result['ShowModal']=1;
                $result['Success']='Failure';
                $result['Message']="Validation failed. Please fill the required field marked as *";
                return response()->json($result,200);
            }
            $patient_obj = new Patient;
            $patientId="AES_DECRYPT(UNHEX('".$request->patientId."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
            $chkPhoneNo=$patient_obj->checkPhoneNoById($request->phoneNo,$patientId);
            if($chkPhoneNo!=NULL){
                $result['ShowModal']=1;
                $result['Success']='Phone No already exists.';
                $result['Message']="Phone No registered patient number : ".$chkPhoneNo->hcNo;
                return response()->json($result,200);
            }
            $patients = $patient_obj->updatePatient($request); 

            $result['ShowModal']=1;
            $result['Success']='Success';
            $result['Message']="Patient updated successfully";
            DB::commit();
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['ShowModal']=1;
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }
    public function deletePatient(Request $request,$id,$userId){
        try{
            $patient_obj = new Patient;
            $patientDetails=$patient_obj->deletePatientById($id,$userId);
            $result['Success']='Success';
            $result['ShowModal']= 1;
            $result['patientDetails']=$patientDetails;
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }   
}
