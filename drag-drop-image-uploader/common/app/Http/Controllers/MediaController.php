<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerImage;
use App\Models\MediaImage;
use App\Models\MediaPage;
use Auth,DB,Session;

class MediaController extends Controller
{
    
    public function list() {
       if (Auth::user()->can("media_management")) {
        
        $banner=MediaPage::where('status',1)->get();
        return view("pages.media.list",compact('banner'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function editPageMedia($slug)
    {  
       if (Auth::user()->can("edit_media")) {
        $pages =MediaPage::where('page_slug',$slug)->first();
        $media = MediaImage::where('page_slug',$slug)->get();

        return view("pages.media.display")->with(['page_title'=>$pages->page_name,'section'=>$media]);
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    } 

    public function editSectionMedia($id)
    {
         if (Auth::user()->can("edit_media")) {
        $details=MediaImage::where('id',$id)->first();
        $page=MediaPage::where('page_slug',$details->page_slug)->first();

       return view("pages.media.edit")->with(['data'=>$details,'page_slug'=>$page->page_slug]);
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }


    public function saveSectionsImage(Request $request)
    {
        

        if ($request->hasFile('Media_image')) {

            $allowedfileExtension = ['jpg', 'png','jpeg'];
            $file =   $request->file('Media_image');

            $fileName = $file->getClientOriginalName();
            $imageName = time(). '-' . str_replace(' ', '',$file->getClientOriginalName());

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check)
            {
                if($file->move(public_path('/media'), $imageName))
                {
                    MediaImage::where('id',$request->id)->update(array('image' => $imageName));
                    Session::flash('message', "Images update successfully.");
                }

            }else{
                 Session::flash('message', "Somthing went wrong.");
            }
        }
           Session::flash('message', "No image found.");
           return redirect()->route('media-page.edit',$request->page_slug);
    }

    public function deleteMediaSection(Request $request){

        MediaImage::where('id', $request->id)
       ->update([
           'image' =>''
        ]);
       
       return 1;

    }



}
