<?php

namespace App\Http\Controllers;

use App\Models\Media;
use DB,Auth;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function MediaList()
    {
       if (Auth::user()->can('media_management')) {
        $allMediaPages = DB::table('md_dropdowns')->where('module', 'media_page')->get();
        return view("pages.media.list", compact('allMediaPages'));
    } else {
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    }
}

public function editPageMedia($slug)
{
    if (Auth::user()->can('edit_media')) {  
        $pages = DB::table('md_dropdowns')->where('slug', $slug)->first();
        $media = Media::where('page_slug', $slug)->get();

        return view("pages.media.display")->with(['page_title' => $pages->name, 'sections' => $media]);
    } else {
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    }
}

public function editSectionMedia($id)
{
   if (Auth::user()->can('edit_media')) {  
    $details = Media::where('id', $id)->first();
    $page = DB::table('md_dropdowns')->where('slug', $details->page_slug)->first();
    return view("pages.media.edit")->with(['data' => $details, 'page_slug' => $page]);
      } else {
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    }

}

public function updateSectionsImage(Request $request)
{
        //dd($request->all());
    $media = Media::find($request->id);
    $page_slug = $media->page_slug;
    if ($request->file("image")) {
        $MediaImage = $request->file("image");
        $image = rand() . time() . "." . $MediaImage->getClientOriginalExtension();
        $MediaImage->move("images/media", $image);
            //$media->image = $image;
        $media->image = env('IMAGE_BASE_URL') . '/images/media/' . $image;
    }

    if ($media->update()) {

        return redirect()->route('media-page.edit', $page_slug)->with(['success' => 'Media  has been updated successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }

}

public function deleteMediaSection(Request $request)
{

    $media = Media::where('id', $request->id)
    ->update([
        'image' => '',
    ]);

    if ($media) {
        $res['success'] = 1;
        return json_encode($res);
    } else {
        $res['success'] = 0;
        return json_encode($res);
    }

}

}
