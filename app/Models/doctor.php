<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use config\constants;

class doctor extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = [
        'profileImage',
        'name',
        'dob',
        'gender',
        'bloodGroup',
        'phoneNo',
        'email',
        'address',
        'hospitalId',
        'branchId',
        'is_active',
        'created_by',
        'updated_by',
        'education',
        'designation',
        'experience',
        'departmentId',
        'doctorCodeNo'
    ];
    public static function checkPhoneNo($phoneNo,$hospitalId,$branchId){
        $phoneNoList=DB::table('doctors')->select('doctorCodeNo')->where("phoneNo","=",$phoneNo)->where(function($q)use($phoneNo,$hospitalId,$branchId)  {
            $q
            ->Where("hospitalId","=",$hospitalId)
            ->orWhere("branchId","=",$branchId);
          })->first();
         return $phoneNoList; 
    }
    public static function checkPhoneNoById($phoneNo,$doctorId){
        $where_sts="id <>".$doctorId;
        $phoneNoList=DB::table('doctors')->select('doctorCodeNo')->where("phoneNo","=",$phoneNo)->whereRaw($where_sts)->first();
         return $phoneNoList; 
    }
    public function getAllDoctor($hospitalId,$branchId,$pagination)
    {
        $skip=$pagination['page'] ==1 ?0:(($pagination['page'] * $pagination['size'])-$pagination['size']);
        $where_sts="doctors.is_active=1 and doctors.hospitalId=".$hospitalId." and doctors.branchId=".$branchId." ".(($pagination['filters_field'] =="" || $pagination['filters_value']=="")?"":" and doctors.".$pagination['filters_field']." ".$pagination['filters_type']." '".$pagination['filters_value']."%'");
        
        $doctorList['doctorList']=DB::table('doctors')->selectRaw("HEX(AES_ENCRYPT(doctors.id,UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))) as id,doctors.doctorCodeNo,doctors.name,doctors.profileImage,doctors.bloodGroup,doctors.phoneNo,doctors.email,doctors.gender,doctors.education,doctors.designation,COALESCE(departments.name,'') as department,doctors.experience")
                                     ->leftJoin('departments', 'departments.id', '=', 'doctors.departmentId')
                                     ->whereRaw($where_sts)
                                     ->skip($skip)->take($pagination['size']) //pagination
                                    ->orderBy($pagination['sorters_field'],$pagination['sorters_dir']) 
                                   ->get();

        $lastPage=DB::table('doctors')->whereRaw($where_sts)->count();

        $doctorList['last_page']=ceil($lastPage/$pagination['size']);
        
        return $doctorList;
    }
    public function getDoctorById($id)
    {
        $where_sts="doctors.id=".$id;
        $patientDetails=DB::table('doctors')->selectRaw("COALESCE(doctors.bloodGroup,0) as bloodGroup,COALESCE(doctors.dob,'') as dob,COALESCE(doctors.gender,0) as gender,COALESCE(doctors.education,'') as education,COALESCE(doctors.designation,'') as designation,COALESCE(doctors.departmentId,0) as departmentId,COALESCE(doctors.experience,'') as experience,COALESCE(doctors.address,'') as address,COALESCE(doctors.hospitalId,'') as hospitalId,COALESCE(doctors.branchId,'') as branchId,COALESCE(doctors.is_active,'') as status,doctors.name,doctors.doctorCodeNo,doctors.phoneNo,doctors.email,doctors.profileImage,HEX(AES_ENCRYPT(doctors.id,UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))) as doctorId,COALESCE(departments.name,'') as department")
                                    ->leftJoin('departments', 'departments.id', '=', 'doctors.departmentId')
                                    ->whereRaw($where_sts)
                                   ->first();
        return $patientDetails;
    }
    public function deleteDoctorById($id,$userId)
    {
        $patientId="AES_DECRYPT(UNHEX('".$id."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
        $where_sts="id=".$patientId;
        $user = new Users;
        $original_userId=$user->getDecryptedId($userId);
        
        return static::whereRaw($where_sts)->update(
            [
             'is_active'=>0,
             'updated_by'=>$original_userId
            ]
        );
    }   
    public static function generateDoctorCodeNo($hospitalId){
        $doctorCodeNoList=DB::table('doctors')->where('hospitalId','=',$hospitalId)->pluck('doctorCodeNo');
        do{
            $doctorCodeNo=random_int(10000,99999);
        }while($doctorCodeNoList->contains($doctorCodeNo));
        return $doctorCodeNo;
    }
    public static function addDoctor(Request $request,$doctorCodeNo,$profileImage){
        $user = new Users;
        $userId=$user->getDecryptedId($request->userId);

        $name=$request->name;
        $phoneNo=$request->phoneNo;
        $email=$request->email;
        $dob=(isset($request->dob) && !empty($request->dob)) ?date("Y-m-d", strtotime($request->dob)) : NULL;
        $gender=(isset($request->gender) && !empty($request->gender)) ?$request->gender : NULL;
        $bloodGrp=(isset($request->bloodGrp) && !empty($request->bloodGrp)) ?$request->bloodGrp : NULL;
        $education=(isset($request->education) && !empty($request->education)) ?$request->education : NULL;
        $designation=(isset($request->designation) && !empty($request->designation)) ?$request->designation : NULL;
        $departmentId=(isset($request->departmentId) && !empty($request->departmentId)) ?$request->departmentId : NULL;
        $address=(isset($request->address) && !empty($request->address)) ?$request->address : NULL;
        $experience=(isset($request->experience) && !empty($request->experience)) ?$request->experience : NULL;
        $hospitalId=(isset($request->hospitalId) && !empty($request->hospitalId)) ?$request->hospitalId : NULL;
        $branchId=(isset($request->branchId) && !empty($request->branchId)) ?$request->branchId : NULL;

        return static::create(
            ['doctorCodeNo'=>$doctorCodeNo,
             'profileImage'=>$profileImage,
             'name' => $name,
             'dob' => $dob,
             'gender'=>$gender,
             'bloodGroup'=>$bloodGrp,
             'education'=>$education,
             'designation'=>$designation,
             'departmentId'=>$departmentId,
             'phoneNo'=>$phoneNo,
             'email'=>$email,
             'address'=>$address,
             'experience'=>$experience,
             'hospitalId'=>$hospitalId,
             'branchId'=>$branchId,
             'created_by'=>$userId
            ]
        );
    }
    public static function updateDoctor(Request $request,$profileImage){
        $user = new Users;
        $userId=$user->getDecryptedId($request->userId);

        $name=$request->name;
        $phoneNo=$request->phoneNo;
        $email=$request->email;
        $dob=(isset($request->dob) && !empty($request->dob)) ?date("Y-m-d", strtotime($request->dob)) : NULL;
        $gender=(isset($request->gender) && !empty($request->gender)) ?$request->gender : NULL;
        $bloodGrp=(isset($request->bloodGrp) && !empty($request->bloodGrp)) ?$request->bloodGrp : NULL;
        $education=(isset($request->education) && !empty($request->education)) ?$request->education : NULL;
        $designation=(isset($request->designation) && !empty($request->designation)) ?$request->designation : NULL;
        $departmentId=(isset($request->departmentId) && !empty($request->departmentId) && $request->departmentId!=0) ?$request->departmentId : NULL;
        $address=(isset($request->address) && !empty($request->address)) ?$request->address : NULL;
        $experience=(isset($request->experience) && !empty($request->experience)) ?$request->experience : NULL;

        $doctorId="AES_DECRYPT(UNHEX('".$request->doctorId."'), UNHEX(SHA2('".config('constant.mysql_custom_encrypt_key')."',512)))";
        $where_sts="id=".$doctorId;
        
        return static::whereRaw($where_sts)->update(
            [
             'name' => $name,
             'profileImage'=>$profileImage,
             'dob' => $dob,
             'gender'=>$gender,
             'bloodGroup'=>$bloodGrp,
             'education'=>$education,
             'designation'=>$designation,
             'departmentId'=>$departmentId,
             'phoneNo'=>$phoneNo,
             'email'=>$email,
             'address'=>$address,
             'experience'=>$experience,
             'updated_by'=>$userId
            ]
        );
    }
    
}
