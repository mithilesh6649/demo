<?php

namespace App\Http\Controllers;

use App\Models\BannerImage;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class BannerController extends Controller
{

    function list() {
        if (Auth::user()->can("banners_management")) {

            $banner = BannerImage::select(DB::raw('count(*) as total'), 'page_name', 'type')->groupBy('page_name', 'type')->get();

            return view('pages.banner.list', compact('banner'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function add()
    {
        if (Auth::user()->can("add_banner")) {

            $existing_pages = BannerImage::pluck('page_name')->toArray();

            $pages_name = DB::table('md_dropdowns')->where('slug', 'pages_name')->get();

            return view('pages.banner.add', compact('pages_name', 'existing_pages'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveData(Request $request)
    {

        $bannerdata = Session::get('BannerImage');
        $proimages = $request->file('file');

        for ($i = 0; $i < count($proimages); $i++) {
            $image_path = $proimages[$i]->getClientOriginalName();
            $proimages[$i]->move(public_path('CMS/banner'), $image_path);

            $branchImage = BannerImage::create([
                'type' => $bannerdata[0]['type'],
                'banner' => $image_path,
                'page_name' => $bannerdata[0]['page'],

            ]);
        }

        if (Session::has('BannerImage')) {
            Session::forget('BannerImage');
        }

        return 'success';

    }

    public function data(Request $request)
    {

        // $banner=new BannerImage;
        $data = ['type' => $request->image_type,
            'page' => str_replace(' ', '_', strtolower($request->page_name))];
        if (Session::has('BannerImage')) {
            Session::forget('BannerImage');
        }
        Session::push('BannerImage', $data);
        return response()->json([
            'success' => true,
            'status' => 'success',
        ]);
    }

    public function view($page, $type)
    {
        if (Auth::user()->can("view_banner")) {

            $pages_name = DB::table('md_dropdowns')->where('slug', 'pages_name')->get();
            $banner = BannerImage::where('page_name', $page)->where('type', $type)->get();
            return view('pages.banner.view', compact('banner', 'pages_name'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function edit($page, $type)
    {
        if (Auth::user()->can("edit_banner")) {

            $pages_name = DB::table('md_dropdowns')->where('slug', 'pages_name')->get();
            $banner = BannerImage::where('page_name', $page)->where('type', $type)->get();
            $user_images = BannerImage::where('page_name', $page)->where('type', $type)->get()->toArray();
            return view('pages.banner.edit', compact('banner', 'user_images', 'pages_name'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function status(Request $request)
    {
        $status = BannerImage::where('id', $request->id)->update(['status' => $request->status]);
        $data = BannerImage::where('page_name', $request->type)->get();
        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $data,

        ]);
    }

    public function deletedByid(Request $request)
    {
        $delval = BannerImage::where('id', $request->id)->forceDelete();
        $data = BannerImage::where('page_name', $request->pagetype)->get();
        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function updateData(Request $request)
    {

        $data = [
            'type' => $request->image_type,
            'page' => $request->page_name,
        ];

        if (Session::has('BannerImage')) {
            Session::forget('BannerImage');
        }
        Session::push('BannerImage', $data);

        return response()->json([
            'success' => true,
            'status' => 'success',
        ]);
    }

    public function updateBannerImage(Request $request)
    {

        $bannerdata = Session::get('BannerImage');
        $proimages = $request->file('file');

        if ($bannerdata[0]['type'] == '0') {

            for ($i = 0; $i < count($proimages); $i++) {
                $image_path = $proimages[$i]->getClientOriginalName();
                $proimages[$i]->move(public_path('CMS/banner'), $image_path);

                $branchImage = BannerImage::where('page_name', $bannerdata[0]['page'])->where('type', $bannerdata[0]['type'])->update([
                    'banner' => $image_path,
                ]);
            }

            //BannerImage::where('page_name',$bannerdata[0]['page'])->where('type',$bannerdata[0]['type'])->delete();
        } else {

            for ($i = 0; $i < count($proimages); $i++) {
                $image_path = $proimages[$i]->getClientOriginalName();
                $proimages[$i]->move(public_path('CMS/banner'), $image_path);

                $branchImage = BannerImage::create([
                    'type' => $bannerdata[0]['type'],
                    'banner' => $image_path,
                    'page_name' => $bannerdata[0]['page'],
                ]);
            }
        }
        BannerImage::where('page_name', $bannerdata[0]['page'])->update(['type' => $bannerdata[0]['type']]);

        if (Session::has('BannerImage')) {
            Session::forget('BannerImage');
        }

        return 'success';

    }

    public function deletebanners(Request $request)
    {

        $banner = BannerImage::where('page_name', $request->page)->where('type', $request->type)->delete();

        if ($banner) {
            Session::flash('status', 'Banner Deleted Successfully!');
            Session::flash('class', 'alert-danger');
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    public function getUpdateData(Request $request)
    {
        $page = str_replace(' ', '_', strtolower($request->page));
        $banner = BannerImage::where('page_name', $page)->get();

        return response()->json([
            'success' => true,
            'data' => $banner,
            'status' => 'success',

        ]);
    }

}
