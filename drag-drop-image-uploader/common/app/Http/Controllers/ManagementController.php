<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Management;
use App\Models\ManagementRole;
use DB,Auth;

class ManagementController extends Controller
{
    public function index()
    {
           if (Auth::user()->can("managements_management")) { 
        $managementList=Management::with('Managementrole')->get();

        return view('management.list',compact('managementList'));
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }
 
    public function editpage($id)
    {
           if (Auth::user()->can("edit_management")) { 
        $managementedit=Management::where('id',$id)->first();
        $role=ManagementRole::where('status',1)->get();

        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

        return view('management.edit',compact('managementedit','status','role'));
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
        
    }

    public function viewdetails($id)
    {

           if (Auth::user()->can("view_management")) { 
        $managementedit=Management::where('id',$id)->first();
        $role=ManagementRole::where('status',1)->get();

        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

        return view('management.view',compact('managementedit','status','role'));
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    } 

    public function updatedetails(Request $request)
    {
        $management_det=Management::where('id',$request->id)->first();
        $management_det->name_en=$request->name_en;
        $management_det->name_ar=$request->name_ar;

        $management_det->organization_en=$request->organization_en;
        $management_det->organization_ar=$request->organization_ar;

        $management_det->management_role_id=$request->designation;
        $management_det->content_en=$request->content_en;
        $management_det->content_ar=$request->content_ar;

        $management_det->status=$request->status;

        $fileName = null;
        if ($request->file("thumbnail")) {
            $profile = $request->file("thumbnail");
            $fileName =rand() . time() . "." . $profile->getClientOriginalExtension();
            $profile->move("management", $fileName);

            if ($management_det->image_name != "") {
                if (
                    file_exists(
                        public_path() .
                            "/management/" .
                            $management_det->image_name
                    )
                ) {
                    unlink("management/" . $management_det->image_name);
                }
            }

            $management_det->image_name = $fileName;
        }

        $management_det->update();

        return redirect()->route('management.list');


    }
} 