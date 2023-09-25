<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ChoiceGroup;
use App\Models\CurrentOffer;
use App\Models\CurrentOfferBranch;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class CurrentOfferController extends Controller
{
    public function index()
    {

        if (Auth::user()->can("add_item")) {
            $menuCategories = MenuCategory::where("status", "1")->get([
                "id",
                "name_en",
                "name_ar",
            ]);
            $choicegroup = ChoiceGroup::with("Choice")
                ->where("menu_item_id", Session::get("menu_item_id"))
                ->get();
            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $branchs = Branch::select('id', 'city_id', 'title_en')->where('status', '1')->get();

            return view("menu-management.items.add", compact('menuCategories', 'choicegroup', 'branchs', 'status', 'offerType'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function save(Request $request)
    {

        $date = str_replace("/", "-", $request->current_offer_enddate);
        $end_date = date('Y-m-d H:m:s', strtotime($date));
        $dates = str_replace("/", "-", $request->current_offer_startdate);
        $start_date = date('Y-m-d H:m:s', strtotime($dates));

        $c_offers = new CurrentOffer();
        $c_offers->offer_name = $request->current_offer_name;
        $c_offers->offer_description = $request->current_offer_description;
        $c_offers->items_id = Session::get("menu_item_id");
        $c_offers->current_offer_type = $request->offers_type;
        $c_offers->amount = $request->current_offer_amount;
        //$c_offers->branch_id=json_encode($request->branchs);
        $c_offers->status = $request->current_offer_status;
        $c_offers->start_date = $start_date;
        $c_offers->end_date = $end_date;
        if ($request->file('c_offerimage') != "") {
            $filename = "current_offer_" . rand() . time() . "." . $request->file('c_offerimage')->getClientOriginalExtension();
            if ($request->file('c_offerimage')) {
                $request->file('c_offerimage')->move('CMS/banner', $filename);
                $c_offers->image = $filename;
            }
        }
        if ($c_offers->save()) {
            if ($request->branches) {
                foreach ($request->branches as $data) {
                    $CurrentOffer = new CurrentOfferBranch();
                    $CurrentOffer->current_offer_id = $c_offers->id;
                    $CurrentOffer->branch_id = $data;
                    $CurrentOffer->save();
                }
            }

        }

        return redirect()->route('menu.item.list');
    }

    public function edit($id)
    {
        if (Auth::user()->can("edit_item")) {

            $menuItem = MenuItem::with(
                "menuCategory:id,name_en,name_ar",
                "ChoiceGroups",
                "ChoiceGroups.Choice"
            )
                ->where("id", $id)
                ->orderBy("created_at", "DESC")
                ->first();

            $menuCategories = MenuCategory::where("status", "1")->get([
                "id",
                "name_en",
                "name_ar",
            ]);

            $current_offers = CurrentOffer::with('brachlist')->where('items_id', $id)->get();

            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            $branchs = Branch::select('id', 'city_id', 'title_en')->where('status', '1')->get();

            return view(
                "menu-management.items.edit",
                compact("menuItem", "menuCategories", "current_offers", "branchs", 'offerType', 'status')
            );

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function updateData(Request $request)
    {

        $date = str_replace("/", "-", $request->current_offer_enddate);
        $end_date = date('Y-m-d H:m:s', strtotime($date));
        $dates = str_replace("/", "-", $request->current_offer_startdate);
        $start_date = date('Y-m-d H:m:s', strtotime($dates));

        $c_offer = CurrentOffer::where('id', $request->current_offers_id)->first();
        if ($c_offer) {
            $c_offer->offer_name = $request->current_offer_name;
            $c_offer->offer_description = $request->current_offer_description;

            $c_offer->current_offer_type = $request->offers_type;
            $c_offer->amount = $request->current_offer_amount;
            //$c_offer->branch_id=json_encode($request->branchs);
            $c_offer->start_date = $start_date;
            $c_offer->end_date = $end_date;
            $c_offer->status = $request->current_offer_status;

            if ($request->file('c_offerimage') != "") {
                $filename = "current_offer_" . rand() . time() . "." . $request->file('c_offerimage')->getClientOriginalExtension();

                if ($request->file('c_offerimage')) {
                    $request->file('c_offerimage')->move('CMS/banner', $filename);

                    $c_offer->image = $filename;

                }
            }

            if ($c_offer->update()) {
                CurrentOfferBranch::where('current_offer_id', $request->current_offers_id)->forceDelete();

                foreach ($request->branches as $data) {
                    $CurrentOffer = new CurrentOfferBranch();
                    $CurrentOffer->current_offer_id = $c_offer->id;
                    $CurrentOffer->branch_id = $data;
                    $CurrentOffer->save();
                }
            }

            return redirect()->route("menu.item.list")->with(["success" => "Current offer updated successfully !"]);
        } else {

            $c_offer = new CurrentOffer();
            $c_offer->items_id = $request->menuitem_id;
            $c_offer->offer_name = $request->current_offer_name;
            $c_offer->offer_description = $request->current_offer_description;
            $c_offer->current_offer_type = $request->offers_type;
            $c_offer->amount = $request->current_offer_amount;
            //$c_offer->branch_id=json_encode($request->branchs);
            $c_offer->start_date = $start_date;
            $c_offer->end_date = $end_date;
            $c_offer->status = $request->current_offer_status;

            if ($request->file('c_offerimage') != "") {
                $filename = "current_offer_" . rand() . time() . "." . $request->file('c_offerimage')->getClientOriginalExtension();
                if ($request->file('c_offerimage')) {
                    $request->file('c_offerimage')->move('CMS/banner', $filename);
                    $c_offer->image = $filename;
                }
            }
            if ($c_offer->save()) {

                foreach ($request->branches as $data) {
                    $CurrentOffer = new CurrentOfferBranch();
                    $CurrentOffer->current_offer_id = $c_offer->id;
                    $CurrentOffer->branch_id = $data;
                    $CurrentOffer->save();
                }

            }

            return redirect()->route("menu.item.list")->with(["success" => "Current offer Added successfully !"]);
        }

    }

}
