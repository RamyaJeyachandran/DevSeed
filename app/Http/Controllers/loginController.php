<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\Users;

class loginController extends Controller
{
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
                switch($user_details->user_type_id)
                {
                    case 1:
                        return view('pages.hospitalSettings')->with('userDetails',$user_details);
                        break;
                    case 2:
                        return view('pages.branches')->with('userDetails',$user_details);
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
}
