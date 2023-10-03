<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use config\constants;

class Patient extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        'hcNo',
        'name',
        'dob',
        'age',
        'gender',
        'bloodGroup',
        'martialStatus',
        'patientWeight',
        'patientHeight',
        'phoneNo',
        'email',
        'address',
        'city',
        'state',
        'pincode',
        'spouseName',
        'spousePhnNo',
        'refferedBy',
        'refDoctorName',
        'refDrHospitalName',
        'reason',
        'hospitalId',
        'branchId',
        'is_active',
        'created_by',
        'updated_by'
    ];

    public static function addPatient(Request $request,$hcNo){
        $user = new Users;
        $userId=$user->getDecryptedId($request->userId);

        $name=$request->name;
        $age=(isset($request->age) && !empty($request->age)) ?$request->age : NULL;
        $dob=(isset($request->dob) && !empty($request->dob)) ?date("Y-m-d", strtotime($request->dob)) : NULL;
        $gender=(isset($request->gender) && !empty($request->gender)) ?$request->gender : NULL;
        $bloodGrp=(isset($request->bloodGrp) && !empty($request->bloodGrp)) ?$request->bloodGrp : NULL;
        $martialStatus=(isset($request->martialStatus) && !empty($request->martialStatus)) ?$request->martialStatus : NULL;
        $weight=(isset($request->weight) && !empty($request->weight)) ?$request->weight : NULL;
        $height=(isset($request->height) && !empty($request->height)) ?$request->height : NULL;
        $phoneNo=$request->phoneNo;
        $email=$request->email;
        $address=(isset($request->address) && !empty($request->address)) ?$request->address : NULL;
        $city=(isset($request->city) && !empty($request->city)) ?$request->city : NULL;
        $state=(isset($request->state) && !empty($request->state)) ?$request->state : NULL;
        $pincode=(isset($request->pincode) && !empty($request->pincode)) ?$request->pincode : NULL;
        $spouseName=(isset($request->spouseName) && !empty($request->spouseName)) ?$request->spouseName : NULL;
        $spousePhnNo=(isset($request->spousePhnNo) && !empty($request->spousePhnNo)) ?$request->spousePhnNo : NULL;
        $refferedBy=(isset($request->refferedBy) && !empty($request->refferedBy)) ?$request->refferedBy : NULL;
        $docName=(isset($request->docName) && !empty($request->docName)) ?$request->docName : NULL;
        $docHpName=(isset($request->docHpName) && !empty($request->docHpName)) ?$request->docHpName : NULL;
        $reason=(isset($request->reason) && !empty($request->reason)) ?$request->reason : NULL;
        $hospitalId=(isset($request->hospitalId) && !empty($request->hospitalId)) ?$request->hospitalId : NULL;
        $branchId=(isset($request->branchId) && !empty($request->branchId)) ?$request->branchId : NULL;

        return static::create(
            ['hcNo'=>$hcNo,
             'name' => $name,
             'dob' => $dob,
             'age'=>$age,
             'gender'=>$gender,
             'bloodGroup'=>$bloodGrp,
             'martialStatus'=>$martialStatus,
             'patientWeight'=>$weight,
             'patientHeight'=>$height,
             'phoneNo'=>$phoneNo,
             'email'=>$email,
             'address'=>$address,
             'city'=>$city,
             'state'=>$state,
             'pincode'=>$pincode,
             'spouseName'=>$spouseName,
             'spousePhnNo'=>$spousePhnNo,
             'refferedBy'=>$refferedBy,
             'refDoctorName'=>$docName,
             'refDrHospitalName'=>$docHpName,
             'reason'=>$reason,
             'hospitalId'=>$hospitalId,
             'branchId'=>$branchId,
             'created_by'=>$userId
            ]
        );
    }
    public static function updatePatient(Request $request){
        $user = new Users;
        $userId=$user->getDecryptedId($request->userId);

        $name=$request->name;
        $dob=(isset($request->dob) && !empty($request->dob)) ?date("Y-m-d", strtotime($request->dob)) : NULL;
        $age=(isset($request->age) && !empty($request->age)) ?$request->age : NULL;
        $gender=(isset($request->gender) && !empty($request->gender)) ?$request->gender : NULL;
        $bloodGrp=(isset($request->bloodGrp) && !empty($request->bloodGrp)) ?$request->bloodGrp : NULL;
        $martialStatus=(isset($request->martialStatus) && !empty($request->martialStatus)) ?$request->martialStatus : NULL;
        $weight=(isset($request->weight) && !empty($request->weight)) ?$request->weight : NULL;
        $height=(isset($request->height) && !empty($request->height)) ?$request->height : NULL;
        $phoneNo=$request->phoneNo;
        $email=$request->email;
        $address=(isset($request->address) && !empty($request->address)) ?$request->address : NULL;
        $city=(isset($request->city) && !empty($request->city)) ?$request->city : NULL;
        $state=(isset($request->state) && !empty($request->state)) ?$request->state : NULL;
        $pincode=(isset($request->pincode) && !empty($request->pincode)) ?$request->pincode : NULL;
        $spouseName=(isset($request->spouseName) && !empty($request->spouseName)) ?$request->spouseName : NULL;
        $spousePhnNo=(isset($request->spousePhnNo) && !empty($request->spousePhnNo)) ?$request->spousePhnNo : NULL;
        $refferedBy=(isset($request->refferedBy) && !empty($request->refferedBy)) ?$request->refferedBy : NULL;
        $docName=(isset($request->docName) && !empty($request->docName)) ?$request->docName : NULL;
        $docHpName=(isset($request->docHpName) && !empty($request->docHpName)) ?$request->docHpName : NULL;
        $reason=(isset($request->reason) && !empty($request->reason)) ?$request->reason : NULL;
        
        $patientId="AES_DECRYPT(UNHEX('".$request->patientId."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
        $where_sts="id=".$patientId;
        
        return static::whereRaw($where_sts)->update(
            [
             'name' => $name,
             'dob' => $dob,
             'age'=>$age,
             'gender'=>$gender,
             'bloodGroup'=>$bloodGrp,
             'martialStatus'=>$martialStatus,
             'patientWeight'=>$weight,
             'patientHeight'=>$height,
             'phoneNo'=>$phoneNo,
             'email'=>$email,
             'address'=>$address,
             'city'=>$city,
             'state'=>$state,
             'pincode'=>$pincode,
             'spouseName'=>$spouseName,
             'spousePhnNo'=>$spousePhnNo,
             'refferedBy'=>$refferedBy,
             'refDoctorName'=>$docName,
             'refDrHospitalName'=>$docHpName,
             'reason'=>$reason,
             'updated_by'=>$userId
            ]
        );
    }
    public static function generateHcNo($hospitalId){
        $hcNoList=DB::table('patients')->where('hospitalId','=',$hospitalId)->pluck('hcNo');
        do{
            $hcNo=random_int(10000,99999);
        }while($hcNoList->contains($hcNo));
        return $hcNo;
    }
    
    public static function checkPhoneNo($phoneNo,$hospitalId,$branchId){
        $phoneNoList=DB::table('patients')->select('hcNo')->where("phoneNo","=",$phoneNo)->where(function($q)use($phoneNo,$hospitalId,$branchId)  {
            $q
            ->Where("hospitalId","=",$hospitalId)
            ->orWhere("branchId","=",$branchId);
          })->first();
         return $phoneNoList; 
    }
    public static function checkPhoneNoById($phoneNo,$patientId){
        $where_sts="id <>".$patientId;
        $phoneNoList=DB::table('patients')->select('hcNo')->where("phoneNo","=",$phoneNo)->whereRaw($where_sts)->first();
         return $phoneNoList; 
    }

    public function getAllPatient($hospitalId,$branchId,$pagination)
    {
        $skip=$pagination['page'] ==1 ?0:(($pagination['page'] * $pagination['size'])-$pagination['size']);
        $where_sts="is_active=1 and hospitalId=".$hospitalId." and branchId=".$branchId." ".(($pagination['filters_field'] =="" || $pagination['filters_value']=="")?"":" and ".$pagination['filters_field']." ".$pagination['filters_type']." '".$pagination['filters_value']."%'");
        
        $patientList['patientList']=DB::table('patients')->selectRaw("HEX(AES_ENCRYPT(id,UNHEX(SHA2('seedproject',512)))) as id,hcNo,name,spouseName,bloodGroup,phoneNo,email,gender")
                                    ->whereRaw($where_sts)
                                    ->skip($skip)->take($pagination['size']) //pagination
                                    ->orderBy($pagination['sorters_field'],$pagination['sorters_dir']) 
                                   ->get();
        $lastPage=DB::table('patients')->whereRaw($where_sts)->count();

        $patientList['last_page']=ceil($lastPage/$pagination['size']);

        return $patientList;
    }
    public function getPatientById($id)
    {
        $where_sts="id=".$id;
        $patientDetails=DB::table('patients')->selectRaw("COALESCE(age,0) as age,COALESCE(bloodGroup,0) as bloodGroup,COALESCE(dob,'') as dob,COALESCE(gender,0) as gender,COALESCE(martialStatus,0) as martialStatus,COALESCE(patientWeight,'') as weight,COALESCE(patientHeight,'') as height,COALESCE(address,'') as address,COALESCE(city,'') as city,COALESCE(state,'') as state,COALESCE(pincode,'') as pincode,COALESCE(spouseName,'') as spouseName,COALESCE(spousePhnNo,'') as spousePhnNo,COALESCE(refferedBy,'') as refferedBy,COALESCE(refDoctorName,'') as refDoctorName,COALESCE(refDrHospitalName,'') as refDrHospitalName,COALESCE(reason,'') as reason,COALESCE(hospitalId,'') as hospitalId,COALESCE(branchId,'') as branchId,COALESCE(is_active,'') as status,name,hcNo,phoneNo,email,HEX(AES_ENCRYPT(id,UNHEX(SHA2('seedproject',512)))) as patientId")
                                    ->whereRaw($where_sts)
                                   ->first();
        return $patientDetails;
    }
    public function deletePatientById($id,$userId)
    {
        $patientId="AES_DECRYPT(UNHEX('".$id."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
        $where_sts="id=".$patientId;
        $user = new Users;
        $orignal_userId=$user->getDecryptedId($userId);
        
        return static::whereRaw($where_sts)->update(
            [
             'is_active'=>0,
             'updated_by'=>$orignal_userId
            ]
        );
    }   

    // public function gethospital()
    // {
    //     $cities=DB::table('samplehospital')->select('id','name','address','phoneNo','email')
    //                                ->get();
    //     return $cities;
    // }
    // public function getdoctor()
    // {
    //     $cities=DB::table('sampledoctor')->select('id','name','department','designation','education','phoneNo','email')
    //                                ->get();
    //     return $cities;
    // }
}
