<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function FeatureList()
    {
        $websitePagesList = Feature::all();
        return view('pages/feature/list', compact('websitePagesList'));
    }

    public function addFeature()
    {
        return view('pages/feature/add');
    }

    public function saveFeature(Request $request)
    {
        //  dd($request->all());

        $icon = null;
        if ($request->file('banner')) {
            $FeatureIcon = $request->file('banner');
            $icon = time() . '.' . $FeatureIcon->getClientOriginalExtension();
            $FeatureIcon->move('CMS/feature/icon', $icon);
        }

        $feature = new Feature;
        $feature->title_en = $request->title_en;
        $feature->title_ar = $request->title_ar;
        $feature->content_en = $request->content_en;
        $feature->content_ar = $request->content_ar;
        $feature->icon = $icon;
        if ($feature->save()) {
            return redirect()->route('features.list')->with('success', 'Feature Created Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong! Please try again later.');
        }
    }

    public function viewFeature($id)
    {

        $feature = Feature::find($id);
        return view('pages/feature/view', compact('feature'));

    }

    public function editFeature($id)
    {
        $feature = Feature::find($id);

        return view('pages/feature/edit', compact('feature'));
    }

    public function updateFeature(Request $request)
    {

        $feature = Feature::where('id', $request->page_content_id)->first();

        $feature->title_en = $request->title_en;
        $feature->title_ar = $request->title_ar;
        $feature->content_en = $request->content_en;
        $feature->content_ar = $request->content_ar;

        if ($request->file('banner')) {
            $FeatureIcon = $request->file('banner');
            $icon = rand() . time() . '.' . $FeatureIcon->getClientOriginalExtension();
            $icon_data = $FeatureIcon->move('CMS/feature/icon', $icon);

            $feature->icon = $icon;
        }

        if ($feature->update()) {

            return redirect()->route('features.list')->with(['success' => 'Feature has been updated successfully !']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function deleteFeature(Request $request)
    {
        $feature = Feature::find($request->id);
        $deleteFeature = $feature->delete();
        if ($deleteFeature) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

}
