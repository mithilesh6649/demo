<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Faq;
use App\Models\Page;
use Auth;
use App\Models\PageContentLog;
use DB;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function websitePagesList(Request $request)
    {
         if(Auth::user()->can('website_management')) {
        $websitePagesList = Page::orderBy('created_at')->where('device_type', 'web')->get();
        return view('pages/web/website_pages_list')->with('websitePagesList', $websitePagesList);
        }
        else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function editWebsitePage($id)
    {
     if(Auth::user()->can('edit_website')) {
        $pageContent = Page::find($id);
        return view('pages/web/edit_website_page', [
            'pageContent' => $pageContent,
        ]);
        }
        else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function updateWebsitePage(Request $request)
    {

      // \Artisan::call('iseed pages --classnameprefix='.date('d-m-y')."split".time());
      //PageContentLog
        $current_time = strtotime(now());
        
      //dd(date('d-m-y H:i:s',$current_time));
       \Artisan::call('iseed pages --classnameprefix=custom'.$current_time.'custom');
        $this->StoreContentLog($current_time);
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'Title is required',
            'content.required' => 'Content is required',
        ]);
        $data = [
            'content' => $request->content,
        ];
        $updateContent = Page::where("id", $request->id)->update($data);
        if ($updateContent) {
            $websitePagesList = Page::all();
            return redirect()->route('website_pages_list', ['websitePagesList' => $websitePagesList])->with('success', 'Page Updated successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
   
     public function StoreContentLog($data=''){
             $pageContentLog = new PageContentLog();
             $pageContentLog->title = 'custom'.$data.'customPagesTableSeeder';
             $pageContentLog->save(); 
     }

    /**
     * This function is used to View Website Content
     */
    public function viewWebsitePage($id)
    {
        // if(Auth::user()->can('view_website_page')) {
        $pageContent = Page::find($id);
        //   $addedBy = Admin::find($pageContent->added_by_id);
        // $updatedBy = Admin::find($pageContent->updated_by_id);
        return view('pages/web/view_website_page', [
            //'addedBy' => $addedBy,
            //  'updatedBy' => $updatedBy,
            'pageContent' => $pageContent,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    //Faq

    public function mobilePagesFaqList()
    {
        $mobilePagesFaqList = Faq::get();
        return view('pages/web/faq/index')->with('mobilePagesFaqList', $mobilePagesFaqList);
    }

    public function mobilePagesFaqAdd()
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('pages/web/faq/add', compact('status'));
    }

    public function mobilePagesFaqSave(Request $request)
    {
        $mobilePagesFaqAdd = new Faq();
        $mobilePagesFaqAdd->question = $request->question;
        $mobilePagesFaqAdd->status = $request->status;
        $mobilePagesFaqAdd->answer = $request->content;

        if ($mobilePagesFaqAdd->save()) {
            return redirect()
                ->route("mobile_pages_faq_list")
                ->with("success", "Faq has been added successfully!");
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }
    }

    public function viewMobileFaqPage($id)
    {

        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();

        $Faq = Faq::where('id', $id)->first();
        return view('pages/web/faq/view', compact('status', 'Faq'));

    }

    public function editMobileFaqPage($id)
    {

        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();

        $Faq = Faq::where('id', $id)->first();
        return view('pages/web/faq/edit', compact('status', 'Faq'));

    }

    public function updateMobileFaqPage(Request $request)
    {

        $mobilePagesFaqAdd = Faq::find($request->id);
        $mobilePagesFaqAdd->question = $request->question;
        $mobilePagesFaqAdd->status = $request->status;
        $mobilePagesFaqAdd->answer = $request->content;

        if ($mobilePagesFaqAdd->update()) {
            return redirect()
                ->route("mobile_pages_faq_list")
                ->with("success", "Faq has been updated successfully!");
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }
    }

    //End Faq

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function mobilePagesList(Request $request)
    {
        if (Auth::user()->can('mobile_management')) {
            $mobilePagesList = Page::where('device_type', 'mobile')->get();
            return view('pages/mobile/mobile_pages_list')->with('mobilePagesList', $mobilePagesList);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function editMobilePage($id)
    {
        if (Auth::user()->can('edit_mobile')) {
            $pageContent = Page::find($id);
            return view('pages/mobile/edit_mobile_page', [
                'pageContent' => $pageContent,
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
            $addedBy = Admin::find($pageContent->added_by_id);
            $updatedBy = Admin::find($pageContent->updated_by_id);
            return view('pages/mobile/view_mobile_page', [
                'addedBy' => $addedBy,
                'updatedBy' => $updatedBy,
                'pageContent' => $pageContent,
            ]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }



    //For Seeders............
      
       public function websitePagesSeederList(){
         $allSeedersList = PageContentLog::OrderByDesc('created_at')->get();
         $count = PageContentLog::count();
        return view('pages/web/website_logs/list')->with(['allSeedersList' =>$allSeedersList,'count'=>$count]);
       }


       public function websitePagesSeederRun(Request $request){
           $runSeeder = PageContentLog::where('id',$request->id)->value('title');
           $response  =  \Artisan::call('db:seed --class='.$runSeeder);
            return response()->json([
                'success' => 1,
            ]);
       }


}
