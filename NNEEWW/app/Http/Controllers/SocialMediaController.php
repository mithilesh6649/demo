<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use DB,Auth;
use Illuminate\Http\Request;
use Session;

class SocialMediaController extends Controller
{
    public function socialmediaList()
    {
        if (Auth::user()->can("social_links_management")) {

        $social_links = SocialLink::get();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view('social_media.list', compact('social_links', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function addSocialMedia()
    {
          if (Auth::user()->can("add_social_links")) {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('social_media.add', compact('status'));
          } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveSocialMedia(Request $request)
    {

        $SocialLink = new SocialLink;
        $SocialLink->name = $request->name;
        $SocialLink->social_url = $request->profile_url;
        $SocialLink->slug = \Str::slug($request->name);
        $SocialLink->status = $request->status;
        if ($SocialLink->save()) {

            return redirect()->route('social-media.list')->with(['success' => 'Social media has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        } 


    }

    public function viewSocialMedia($id)
    {
       if (Auth::user()->can("view_social_links")) {

        $social_link = SocialLink::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('social_media.view', compact('social_link', 'status'));
    } else {
        return redirect()
        ->route("dashboard")
        ->with(
            "warning",
            "You do not have permission for this action!"
        );
    }
}

public function editSocialMedia($id)
{
  if (Auth::user()->can("edit_social_links")) {

    $social_link = SocialLink::where('id', $id)->first();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('social_media.edit', compact('social_link', 'status'));
} else {
    return redirect()
    ->route("dashboard")
    ->with(
        "warning",
        "You do not have permission for this action!"
    );
}

}

public function updateSocialMedia(Request $request)
{

    SocialLink::where('id', $request->social_login_id)->update([
            'name' => $request->name,
            'social_url' => $request->profile_url,
            'status' => $request->status,
        ]);
        return redirect()
        ->route("social-media.list")
        ->with("success", "Social media has been updated successfully!");  

}

public function deleteSocialMedia(Request $request)
{

    $social_link = SocialLink::where('id', $request->id);

    $social_link_data = $social_link->delete();

    if ($social_link_data) {
        $res['success'] = 1;
        return json_encode($res);
    } else {
        $res['success'] = 0;
        return json_encode($res);
    }

}

public function deleteSocialMediaImage(Request $request)
{

    $social_link_data = SocialLink::where('id', $request->social_link_id)->update(['image'=>NULL]);

    if ($social_link_data) {
        $res['success'] = 1;
        return json_encode($res);
    } else {
        $res['success'] = 0;
        return json_encode($res);
    }

}

    //deletedOfferList
    // public function deletedSocialMediaList()
    // {
    //     // if (Auth::user()->can("manage_recyle_question_tab")) {

    //         $allQuestions = SocialLink::onlyTrashed()->get();
    //         $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

    //         return view('security-questions.deleted_list', compact("allQuestions", 'status'));
    //     // } else {
    //     //     return redirect()
    //     //         ->route("dashboard")
    //     //         ->with(
    //     //             "warning",
    //     //             "You do not have permission for this action!"
    //     //         );
    //     // }
    // }

    //Restore Offer
    // public function restoreSocialMedia(Request $request)
    // {
    //     SocialLink::withTrashed()
    //         ->find($request->id)
    //         ->restore();
    //     return "success";
    // }

    //Permanent Delete Offer
    // public function permanentDeleteSocialMedia(Request $request)
    // {
    //     SocialLink::onlyTrashed()
    //         ->find($request->id)
    //         ->forceDelete();
    //     return "success";
    // }

}
