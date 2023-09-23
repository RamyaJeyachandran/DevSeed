<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;

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
    
    public function getBloodGroup(Request $request)
    {
        return response()->json("failure",200);
        // try{
        //     return response()->json("success",200);
        // }catch(\Throwable $th){
        //     return response()->json($th->getMessage(),200);
        // }
        // return response()->json("failure",200);
    }
}
