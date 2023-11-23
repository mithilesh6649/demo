<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfidentialApiKey;
use DB;
class ConfidentialApiKeyController extends Controller
{
     public function ApiKeysList(){
        $allAPIKeys = DB::table('md_dropdowns')->where('module', 'confidential_api_key')->get();
        return view("api_keys.list", compact('allAPIKeys'));
     }


    public function editApiKey($slug)
    {
         
         $slugs = DB::table('md_dropdowns')->where('slug', $slug)->first();
         $ConfidentialApiKey = ConfidentialApiKey::where('slug', $slug)->where('key_slug','!=','zoom_refresh_token')->get();
 
        return view("api_keys.display")->with(['page_title' => $slugs->name, 'sections' => $ConfidentialApiKey]);
      

    }


    public function editApiKeyProvider($id){

        $ConfidentialApiKey = ConfidentialApiKey::where('id', $id)->first();
        $page = DB::table('md_dropdowns')->where('slug', $ConfidentialApiKey->slug)->first();
         return view("api_keys.edit")->with(['data' => $ConfidentialApiKey, 'page_slug' => $page]);

    }
}
