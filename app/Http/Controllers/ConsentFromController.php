<?php

namespace App\Http\Controllers;

use App\Models\ConsentFrom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use config\constants;


class ConsentFromController extends Controller
{
    public function getFormList(Request $request,$hospitalId,$branchId){
        try{
            $consent_obj = new ConsentFrom;
            $consentList=$consent_obj->getConsentFormList($hospitalId,$branchId);
            $result['Success']='Success';
            $result['consentList']=$consentList;
            return response()->json($result,200);
        }catch(\Throwable $th){
            $result['Success']='failure';
            $result['Message']=$th->getMessage();
            return response()->json($result,200);
        }
    } 
}
