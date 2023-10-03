<?php
namespace App\Helpers;
 
use Illuminate\Http\Request;
use config\constants;
 
class Helper {
    public static function getResponseMessage($success,$code,$data,$msg="Success") {

    	$error['code']=$success?"":$code;
    	$error['description']=$success?"":$data;
    	$error['catchObject']=$success?"":$msg;

    	$payload['message']=$success?$msg:"";
    	$payload['data']=$success?$data:"";

    	$result['success']=$success;
    	$result['error']=$error;
    	$result['payload']=$payload;

    	return response()->json($result,config('constants.api_response.success_code'));
    }

}
