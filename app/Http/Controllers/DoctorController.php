<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use config\constants;
use App\Models\Users;
use App\Models\MixedTables;
use Illuminate\Support\Facades\Response;
use Image;

class DoctorController extends Controller
{
    /**
     * Display a add doctor screen
     */
    
    public function viewDoctor()
    {
        return View("addDoctor");
    }
    public function getAllDoctor(Request $request)
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

            $doctor_obj = new Doctor;
            $doctorList=$doctor_obj->getAllDoctor($hospitalId,$branchId,$pagination);
            
            $result['last_page']=$doctorList['last_page'];
            $result['data']=$doctorList['doctorList'];
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }
    public function registerDoctor(Request $request)
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

            //----------------Store Image ---Begin 
            $profileImage =config('constant.doctor_default_profileImage');
            if($request->hasfile('profileImage')){
                $hospital_id_store=($hospitalId==NULL?0:$hospitalId);
                $img_location="images/doctors/";
                $img_name =config('constant.prefix_doctor_profile_image').$hospital_id_store.'_'.time().'.'.$request->profileImage->getClientOriginalExtension();
                $request->profileImage->move(public_path($img_location), $img_name);

                $profileImage =$img_location.$img_name;
            }
            
            //-------------------Store Image ---End
            
            $doctor_obj = new Doctor;
            //Check phone no -- Begin
            $chkPhoneNo=$doctor_obj->checkPhoneNo($request->phoneNo,$hospitalId,$branchId);
            if($chkPhoneNo!=NULL){
                $result['ShowModal']=1;
                $result['Success']='Phone No already exists.';
                $result['Message']="Phone No registered doctor number is ".$chkPhoneNo->doctorCodeNo;
                return response()->json($result,200);
            }
            //Check phone no -- Begin
            
            //Generate doctor code number 
            $doctorCodeNo=$doctor_obj->generateDoctorCodeNo($hospitalId);
            $doctors =  $doctor_obj->addDoctor($request,$doctorCodeNo,$profileImage); 
            $doctorId=$doctors->id;
            
            //Login creation
            if($doctorId>0){
                 
                $login_created=0;
                $password=(isset($request->password) && !empty($request->password)) ?$request->password : NULL;
                if($password!=NULL){
                    $user_obj = new Users;
                    $user_details=$user_obj->createLogin($request,config('constant.doctor_user_type_id'),$doctorId);
                    $login_created=1;
                }
            }

            $result['ShowModal']=1;
            $result['Success']='Success';
            $result['Message']="Doctor registered successfully";
            $result['doctorCodeNo']="Doctor Access Number is ".$doctorCodeNo;
            $result['loginCreation']=$login_created;
            $result['profileImage']=$profileImage;
            DB::commit();
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['ShowModal']=1;
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }

    public function updateDoctor(Request $request)
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

            //----------------Store Image ---Begin 
            if($request->isImageChanged==1)
            {
                $profileImage =config('constant.doctor_default_profileImage');
                if($request->hasfile('profileImage')){
                    $hospital_id_store=($hospitalId==NULL?0:$hospitalId);
                    $img_location="images/doctors/";
                    $img_name =config('constant.prefix_doctor_profile_image').$hospital_id_store.'_'.time().'.'.$request->profileImage->getClientOriginalExtension();
                    $request->profileImage->move(public_path($img_location), $img_name);

                    $profileImage =$img_location.$img_name;
                }
            }else{
                $profileImage=$request->profileImage;
            }
            
            //-------------------Store Image ---End
            $profile_image=($profileImage==""?config('constant.doctor_default_profileImage'):$profileImage);
            
            $doctor_obj = new Doctor;
            $doctorId="AES_DECRYPT(UNHEX('".$request->doctorId."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
            $chkPhoneNo=$doctor_obj->checkPhoneNoById($request->phoneNo,$doctorId);
            if($chkPhoneNo!=NULL){
                $result['ShowModal']=1;
                $result['Success']='Phone No already exists.';
                $result['Message']="Phone No registered doctor number : ".$chkPhoneNo->doctorCodeNo;
                return response()->json($result,200);
            }
            $doctors = $doctor_obj->updateDoctor($request,$profile_image); 

            $result['ShowModal']=1;
            $result['Success']='Success';
            $result['Message']="Doctor updated successfully";
            DB::commit();
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['ShowModal']=1;
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }
    public function deleteDoctor(Request $request,$id,$userId){
        try{
            $doctor_obj = new Doctor;
            $doctorDetails=$doctor_obj->deleteDoctorById($id,$userId);
            $result['Success']='Success';
            $result['ShowModal']= 1;
            $result['doctorDetails']=$doctorDetails;
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
            $doctor_obj = new Doctor;
            $doctorDetails=$doctor_obj->getDoctorById($id_orignal);

            $mixedTable = new MixedTables;
            $doctorDetails->genderList =  $mixedTable->getGender(); 
            $doctorDetails->bloodGrpList=$mixedTable->getBloodGrp();
            $doctorDetails->departmentList=$mixedTable->getDepartment();

            return view('pages.editDoctor')->with('doctorDetails', $doctorDetails);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }

    public function getDoctorById(Request $request,$id){
        try{
            $id_orignal="AES_DECRYPT(UNHEX('".$id."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
            $doctor_obj = new Doctor;
            $doctorDetails=$doctor_obj->getDoctorById($id_orignal);
            $result['Success']='Success';
            $result['doctorDetails']=$doctorDetails;
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    }

}
