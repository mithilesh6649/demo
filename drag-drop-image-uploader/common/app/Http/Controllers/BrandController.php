<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use DB,Session,Auth;
class BrandController extends Controller
{
      public function BrandsList(){
        
         if (Auth::user()->can("brands_management")) { 
       
        $allBrands = Brand::all();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view('misc.brands.list', compact('allBrands', 'status'));

          } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
      
      }


    public function addBrand()
    {
          if (Auth::user()->can("add_brand")) { 
       
         $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
         return view('misc.brands.add', compact('status'));

          } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }


    public function saveBrand(Request $request){
      // dd($request->all());

        $Brand = new Brand;
        $Brand->title_en = $request->title_en;
        $Brand->title_ar = $request->title_ar;
        $Brand->status = $request->status;

        $allowedfileExtension = ['jpg', 'png', 'jpeg'];
        $file = $request->file('Media_image');

        $fileName = $file->getClientOriginalName();
        $imageName = time() . '-' . str_replace(' ', '', $file->getClientOriginalName());

        $extension = $file->getClientOriginalExtension();
        $check = in_array($extension, $allowedfileExtension);
        if ($check) {
            if ($file->move(public_path('/brands'), $imageName)) {
                $Brand->image = $imageName;
            }

            if ($Brand->save()) {
                return redirect()->route("brands.list")->with("success", "Brand has been added successfully!");
            } else {
                return redirect()
                    ->back()
                    ->with("warning", "Something went wrong!");
            }

        } else {
            Session::flash('status', "Somthing went wrong.");
        }


    }



    public function viewBrand($id){
         if (Auth::user()->can("view_brand")) { 
       
         $brand = Brand::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view('misc.brands.view', compact('brand', 'status'));
          } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }
   
      public function editBrand($id)
    {
         if (Auth::user()->can("edit_brand")) {

        $brand = Brand::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view('misc.brands.edit', compact('brand', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }


    public function deleteBrandImage(Request $request)
    {
     
       $brands = Brand::where('id', $request->social_link_id)->update(['image'=>NULL]);

        if ($brands) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }


    }


    public function updateBrand(Request $request){
        //dd($request->all());

             if ($request->hasFile('Media_image')) {

            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            $file = $request->file('Media_image');

            $fileName = $file->getClientOriginalName();
            $imageName = time() . '-' . str_replace(' ', '', $file->getClientOriginalName());

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                if ($file->move(public_path('/brands'), $imageName)) {
                    Brand::where('id', $request->brand_id)->update([
                        'title_en' => $request->title_en,
                        'title_ar' => $request->title_ar,
                        'status' => $request->status,
                        'image' => $imageName,
                    ]);
                    return redirect()
                        ->route("brands.list")
                        ->with("success", "Brands has been updated successfully!");
                }

            } else {
                Session::flash('status', "Somthing went wrong.");
            }

        } else {
            Brand::where('id', $request->brand_id)->update([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'status' => $request->status,
            ]);
            return redirect()
                ->route("brands.list")
                ->with("success", "Brands has been updated successfully!");
        }



    }



        public function deleteBrand(Request $request)
    {

        $brand = Brand::where('id', $request->id);

        $brand = $brand->delete();

        if ($brand) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    } 




    //deletedList
    public function deletedBrandsList()
    {
      //  if (Auddth::user()->can("manage_recyle_designations_tab")) {

            $DeletedBrands = Brand::onlyTrashed()->get();

            return view('misc.brands.deleted_list', compact("DeletedBrands"));
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }


    
    //Restore
    public function restoreBrands(Request $request)
    {
        Brand::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete
    public function permanentDeleteBrands(Request $request)
    {
        Brand::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }




}
