<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class ContentController extends Controller
{
    public function privacyPolicy(){
        try{
            $data = Page::where(['section'=>'privacy_policy','device_type'=>'mobile'])->first();
            if($data){
                $res = [
                    'status' => 200,
                    'data' => $data,
                ];
                return response()->json($res,200);
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'Data not found!',  
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),  
            ];
            return response()->json($res,400);
        }
    }

    public function accountDisclosure(){
        try{
            $data = Page::where(['section'=>'account_disclosure','device_type'=>'mobile'])->first();
            if($data){
                $res = [
                    'status' => 200,
                    'data' => $data,
                ];
                return response()->json($res,200);
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'Data not found!',  
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),  
            ];
            return response()->json($res,400);
        }
    }

    public function termsAndConditions(){
        try{
            $data = Page::where(['section'=>'terms_and_conditions','device_type'=>'mobile'])->first();
            if($data){
                $res = [
                    'status' => 200,
                    'data' => $data,
                ];
                return response()->json($res,200);
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'Data not found!',  
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),  
            ];
            return response()->json($res,400);
        }
    }

    public function aboutUs(){
        try{
            $data = Page::where(['section'=>'about_us','device_type'=>'mobile'])->first();
            if($data){
                $res = [
                    'status' => 200,
                    'data' => $data,
                ];
                return response()->json($res,200);
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'Data not found!',  
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),  
            ];
            return response()->json($res,400);
        }
    }

}
