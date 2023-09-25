<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Page;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function websitePagesList(Request $request)
    {
        if (Auth::user()->can("website_content_management")) {

            $websitePagesList = Page::all();
            return view('pages/web/website_pages_list', compact('websitePagesList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function addWebsitePage(Request $request)
    {
        return view('pages/web/add_website_page');
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function saveWebsitePage(Request $request)
    {

        $pageContent = Page::where("title_en", $request->title_en)
            ->where("device_type", 'web')
            ->get();
        $banner = null;
        if ($request->file('banner')) {
            $CMSBanner = $request->file('banner');
            $banner = time() . '.' . $CMSBanner->getClientOriginalExtension();
            $CMSBanner->move('CMS/banner', $banner);
        }

        if (count($pageContent) <= 0) {
            $pageContent = new Page;
            $pageContent->title_en = $request->title_en;
            $pageContent->title_ar = $request->title_ar;
            $pageContent->content_en = $request->content_en;
            $pageContent->content_ar = $request->content_ar;
            $pageContent->banner = $banner;
            $pageContent->device_type = 'web';
            $pageContent->support_number=$request->support!=null?$request->support:null;
            $pageContent->address=$request->address!=null?$request->address:null;
            $pageContent->email=$request->email!=null?$request->email:null;
            $pageContent->address_two=$request->address_two!=null?$request->address_two:null;
            $pageContent->added_by_id = Auth::id();
            $pageContent->updated_by_id = Auth::id();
            $pageContent->last_updated_at = Carbon::now();

            if ($pageContent->save()) {
                return redirect()->route('pages.list')->with('success', 'Page Created Successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong! Please try again later.');
            }
        } else {
            return redirect()->back()->with('error', 'The Page Already exists! Please Edit the Page to Change Content.');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function editWebsitePage($id)
    {

        if (Auth::user()->can("edit_website_content")) {

            $pageContent = Page::find($id);
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('pages/web/edit_website_page', compact('pageContent','status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function updateWebsitePage(Request $request)
    {

        $pageContent = Page::where('id', $request->page_content_id)->first();

        $pageContent->title_en = $request->title_en;
        $pageContent->title_ar = $request->title_ar;
        $pageContent->content_en = $request->content_en;
        $pageContent->content_ar = $request->content_ar;
        $pageContent->device_type = 'web';
        $pageContent->support_number=$request->support!=null?$request->support:null;
        $pageContent->whats_app_number=$request->whats_app_number!=null?$request->whats_app_number:null;
        $pageContent->address=$request->address!=null?$request->address:null;
        $pageContent->email=$request->email!=null?$request->email:null;
        $pageContent->address_two=$request->address_two!=null?$request->address_two:null;
        $pageContent->status = $request->status;
        $pageContent->added_by_id = Auth::id();
        $pageContent->updated_by_id = Auth::id();
        $pageContent->last_updated_at = Carbon::now();

        if ($request->file('banner')) {
            $CMSBanner = $request->file('banner');
            $banner = rand() . time() . '.' . $CMSBanner->getClientOriginalExtension();
            $banner_data = $CMSBanner->move('CMS/banner', $banner);

            $pageContent->banner = $banner;
        }

        if ($pageContent->update()) {

            return redirect()->route('pages.list')->with(['success' => 'Content has been updated successfully !']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    /**
     * This function is used to View Website Content
     */
    public function viewWebsitePage($id)
    {
        if (Auth::user()->can("view_website_content")) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $pageContent = Page::find($id);
            $addedBy = Admin::find($pageContent->added_by_id);
            $updatedBy = Admin::find($pageContent->updated_by_id);

            return view('pages/web/view_website_page', compact('pageContent', 'addedBy','status', 'updatedBy'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    /**
     * This function is used to View Website Content
     */
    public function deleteWebsitePage(Request $request)
    {
        $page = Page::find($request->id);
        $deletePage = $page->delete();
        if ($deletePage) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function deletedWebsitePages()
    {

        $deletedWebsitePages = Page::onlyTrashed()->orderBy('title_en')->get();
        return view('pages/web/deleted_website_pages_list', ['deletedWebsitePages' => $deletedWebsitePages]);
    }

    //Restore Pages
    public function restoreWebsitePage(Request $request)
    {
        $blogList = Page::withTrashed()->find($request->id)->restore();
        return "success";
    }

    //Permanent Delete Pages
    public function permanentDeleteWebsitePage(Request $request)
    {
        $blogList = Page::onlyTrashed()->find($request->id)->forceDelete();
        return "success";
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function mobilePagesList(Request $request)
    {
        if (Auth::user()->can('manage_mobile_pages')) {
            $mobilePagesList = Page::orderBy('title')->where('device_type', 'mobile')->get();
            return view('pages/mobile/mobile_pages_list')->with('mobilePagesList', $mobilePagesList);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function addMobilePage(Request $request)
    {
        if (Auth::user()->can('add_mobile_page')) {
            $pageSections = DB::table('pages_sections')->get();
            return view('pages/mobile/add_mobile_page', ['pageSections' => $pageSections]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function saveMobilePage(Request $request)
    {
        // dd($request);
        $pageContent = Page::where("section", $request->section)
            ->where("device_type", 'mobile')
            ->get();
        if (count($pageContent) <= 0) {
            $pageContent = new Page;
            $pageContent->title = $request->title;
            $pageContent->content = $request->content;
            $pageContent->section = $request->section;
            $pageContent->device_type = 'mobile';
            $pageContent->added_by_id = Auth::id();
            $pageContent->updated_by_id = Auth::id();
            if ($pageContent->save()) {
                return redirect()->back()->with('success', 'Page Created Successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong! Please try again later.');
            }
        } else {
            return redirect()->back()->with('error', 'The Page Already exists! Please Edit the Page to Change Content.');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function editMobilePage($id)
    {
        if (Auth::user()->can('edit_mobile_page')) {
            $pageContent = Page::find($id);
            $pageSections = DB::table('pages_sections')->get();
            return view('pages/mobile/edit_mobile_page', [
                'pageContent' => $pageContent,
                'pageSections' => $pageSections,
            ]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function updateMobilePage(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'Title is required',
            'content.required' => 'Content is required',
        ]);
        $data = [
            'content' => $request->content,
            'updated_by_id' => Auth::id(),
        ];
        $updateContent = Page::where("id", $request->id)->update($data);
        if ($updateContent) {
            $mobilePagesList = Page::all();
            return redirect()->route('mobile_pages_list', ['mobilePagesList' => $mobilePagesList])->with('success', 'Page Updated successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * This function is used to View Mobile Content
     */
    public function viewMobilePage($id)
    {
        if (Auth::user()->can('view_mobile_page')) {
            $pageContent = Page::find($id);
            $section = DB::table('pages_sections')->where('slug', $pageContent->section)->first();
            $addedBy = Admin::find($pageContent->added_by_id);
            $updatedBy = Admin::find($pageContent->updated_by_id);
            return view('pages/mobile/view_mobile_page', [
                'addedBy' => $addedBy,
                'updatedBy' => $updatedBy,
                'section' => @$section->title,
                'pageContent' => $pageContent,
            ]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to View Mobile Content
     */
    public function deleteMobilePage(Request $request)
    {
        $page = Page::find($request->id);
        $deletePage = $page->delete();
        if ($deletePage) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function deletedMobilePages()
    {
        $deletedMobilePages = Page::onlyTrashed()->orderBy('title')->get();
        return view('pages/mobile/deleted_mobile_pages_list', ['deletedMobilePages' => $deletedMobilePages]);
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function restoreMobilePage(Request $request)
    {
        $restoreMobilePage = Page::where('id', $request->id)->restore();
        if ($restoreMobilePage) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

}
