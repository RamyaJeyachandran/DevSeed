<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\Users;
use App\Models\HospitalSettings;

class loginController extends Controller
{
    public function errorPage()
    {
        return View("pages.error")->with('errorNo',400)->with('errorMsg','Error Contact Support team');
    }
    public function verifyUser(Request $request)
    {
        try{
            $validateUser=Validator::make($request->all(), [
                'userName'=>'required',
                'password'=>'required',
            ]);
            if($validateUser->fails()){
                return view('pages.login')->with('errorMsg','Please enter User name and password');
            }
            $user = new Users;
            $user_details =  $user->getLoginUser($request); 
            if($user_details!=null)
            {
                $request->session()->put('userType', $user_details->user_type_id);
                $request->session()->put('userId', $user_details->id);
                switch($user_details->user_type_id)
                {
                    case 1:
                        $hospitalId=$user->getEncryptedId(0);
                        $request->session()->put('hospitalId', $hospitalId);
                        $request->session()->put('branchId',$hospitalId);
                        $request->session()->put('userName', $user_details->name);
                        return view('pages.hospitalSettings');
                        break;
                    case 2:
                        $request->session()->put('hospitalId', $user_details->user_id);
                        $request->session()->put('branchId',0);
                        $hospitalId = "AES_DECRYPT(UNHEX('" . $user_details->user_id . "'), UNHEX(SHA2('" . config('constant.mysql_custom_encrypt_key') . "',512)))";
                        $hospital_obj=new HospitalSettings;
                        $loginDetails=$hospital_obj->getHospitalSettingsById($hospitalId);

                        if($loginDetails!=null){
                            $request->session()->put('logo', $loginDetails->logo);
                            $request->session()->put('userName', $loginDetails->hospitalName);
                        }else{
                            return view('pages.login')->with('errorMsg','Invalid user name or password');
                        }
                        return view('pages.hospitalSettings');
                        break;
                    case 3:

                        return view('pages.branches');
                        break;
                    default:
                        return view('pages.error')->with('errorMsg','No Access')->with('errorNo','401');
                        break;
                }
            }else{
                return view('pages.login')->with('errorMsg','Invalid user name or password');
            }
        }catch(\Throwable $th){
            return view('pages.login')->with('errorMsg',$th->getMessage());
        }
    }
    // public function convertToHash(Request $request,$id){
    //     // echo Hash::make($id);
    //     $hashed = Hash::make($id, [
    //         'rounds' => 12,
    //     ]);
    //     return $hashed;
    // }
    public function getCrypId(Request $request){
        $user = new Users;
        $user_cryptId=$user->getDecrypedId("F4EA38807AEC5F2F2BCE7E336D251538");
        return $user_cryptId;
    }
}
