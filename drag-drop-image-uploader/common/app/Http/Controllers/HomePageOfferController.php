<?php

namespace App\Http\Controllers;

use App\Models\HomePageOffer;
use App\Models\HomePageOfferAssociation;
use App\Models\MenuItem;
use DB,Auth;
use Illuminate\Http\Request; 

class HomePageOfferController extends Controller
{
    public function CurrentOfferList()
    {   
     if(Auth::user()->can("current_offer_management")) {
        $allHomePageCurrentOffers = HomePageOffer::all();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get(); 
        return view('homepage_current_offer.list', compact('allHomePageCurrentOffers', 'status'));
           } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function addCurrentOffer()
    {
        if(Auth::user()->can("add_current_offer")) {
        $MenuItems = MenuItem::where('status', 1)->orderBy('item_name_en')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        $current_offer_types = DB::table('md_dropdowns')->where('slug', 'current_offer_type')->get();
        return view('homepage_current_offer.add', compact('status', 'MenuItems','current_offer_types'));
              } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveCurrentOffer(Request $request)
    {
       
        DB::beginTransaction();

        try {

            $date = str_replace("/", "-", $request->end_date);
            $end_date = date('Y-m-d H:00:00', strtotime($date));
            $dates = str_replace("/", "-", $request->start_date);
            $start_date = date('Y-m-d H:00:00', strtotime($dates));
            $HomePageOffer = new HomePageOffer();
            $HomePageOffer->offer_name = $request->offer_name;
            $HomePageOffer->description = $request->description;
            $HomePageOffer->start_date = $start_date;
            $HomePageOffer->end_date = $end_date;
            $HomePageOffer->offer_type = $request->offer_type;
            $HomePageOffer->offer_amount = $request->offer_amount;
            //$HomePageOffer->offer_item_id = $request->offer_item_id;
            $HomePageOffer->status = $request->offer_status;
            $HomePageOffer->pop_up_image_status = $request->popup_image_status;

            if ($request->file("thumbnail")) {
                $OffersImageTwo = $request->file("thumbnail");
                $thumbnail = time() . "." . $OffersImageTwo->getClientOriginalExtension();
                $OffersImageTwo->move("offers/current_offer", $thumbnail);
                $HomePageOffer->regular_image = $thumbnail;
            }

            if ($request->file("thumbnail_popup")) {
                $OffersImageTwo = $request->file("thumbnail_popup");
                $thumbnail = time() * 2 . "." . $OffersImageTwo->getClientOriginalExtension();
                $OffersImageTwo->move("offers/current_offer_popup", $thumbnail);
                $HomePageOffer->pop_up_image = $thumbnail;
            }

            if ($HomePageOffer->save()) {
                // if (isset($request->associated_item_id)) {
                //     foreach ($request->associated_item_id as $key => $id) {
                //         $HomePageOfferAssociation = new HomePageOfferAssociation();
                //         $HomePageOfferAssociation->home_page_offer_id = $HomePageOffer->id;
                //         $HomePageOfferAssociation->associated_item_id = $id;
                //         $HomePageOfferAssociation->save();
                //     }
                // }

            }

            DB::commit();

            return redirect()->route("current.offers.homepage.list")->with("success", "Current Offer has been added successfully!");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("current.offers.homepage.list")->with("error", "something went wrong");
        }

    }

    public function deleteCurrentOffer(Request $request)
    {

        $HomePageOffer = HomePageOffer::where('id', $request->id)->first();
        if ($HomePageOffer) {
            $HomePageOffer->delete();
            return response()->json([
                'success' => 1,
            ]);
        } else {
            return response()->json([
                'success' => 0,
            ]);
        }
    }

    public function viewCurrentOffer($id)
    {

        if(Auth::user()->can("view_current_offer")) {

        $HomePageOffer = HomePageOffer::where('id', $id)->first();
        $HomePageOfferAssociation = HomePageOfferAssociation::where('home_page_offer_id', $id)->get();
          $current_offer_types = DB::table('md_dropdowns')->where('slug', 'current_offer_type')->get();
        $MenuItems = MenuItem::where('status', 1)->orderBy('item_name_en')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view('homepage_current_offer.view', compact('HomePageOffer', 'MenuItems', 'status', 'HomePageOfferAssociation','current_offer_types'));
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editCurrentOffer($id)
    {
        if(Auth::user()->can("edit_current_offer")) {
       
        $HomePageOffer = HomePageOffer::where('id', $id)->first();
        $HomePageOfferAssociation = HomePageOfferAssociation::where('home_page_offer_id', $id)->get();
          $current_offer_types = DB::table('md_dropdowns')->where('slug', 'current_offer_type')->get();
        $MenuItems = MenuItem::where('status', 1)->orderBy('item_name_en')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view('homepage_current_offer.edit', compact('HomePageOffer', 'MenuItems', 'status', 'HomePageOfferAssociation','current_offer_types'));
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function updateCurrentOffer(Request $request)
    {
  
        DB::beginTransaction();

        try {

            $date = str_replace("/", "-", $request->end_date);
            $end_date = date('Y-m-d H:m:s', strtotime($date));
            $dates = str_replace("/", "-", $request->start_date);
            $start_date = date('Y-m-d H:m:s', strtotime($dates));
            $HomePageOffer = HomePageOffer::where("id", $request->current_offers_id)->first();
          //  HomePageOfferAssociation::where('home_page_offer_id', $request->current_offers_id)->forceDelete();
            $HomePageOffer->offer_name = $request->offer_name;
            $HomePageOffer->description = $request->description;
            $HomePageOffer->start_date = $start_date;
            $HomePageOffer->end_date = $end_date;
            $HomePageOffer->offer_amount = $request->offer_amount;
            $HomePageOffer->offer_type = $request->offer_type;
          //  $HomePageOffer->offer_item_id = $request->offer_item_id;
            $HomePageOffer->status = $request->offer_status;
            $HomePageOffer->pop_up_image_status = $request->popup_image_status;
            if ($request->file("thumbnail")) {
                $OffersImageTwo = $request->file("thumbnail");
                $thumbnail = time() . "." . $OffersImageTwo->getClientOriginalExtension();
                $OffersImageTwo->move("offers/current_offer", $thumbnail);
                $HomePageOffer->regular_image = $thumbnail;
            }

            if ($request->file("thumbnail_popup")) {
                $OffersImageTwo = $request->file("thumbnail_popup");
                $thumbnail = time() * 2 . "." . $OffersImageTwo->getClientOriginalExtension();
                $OffersImageTwo->move("offers/current_offer_popup", $thumbnail);
                $HomePageOffer->pop_up_image = $thumbnail;
            }

            if ($HomePageOffer->update()) {
                // if (isset($request->associated_item_id)) {
                //     foreach ($request->associated_item_id as $key => $id) {
                //         $HomePageOfferAssociation = new HomePageOfferAssociation();
                //         $HomePageOfferAssociation->home_page_offer_id = $HomePageOffer->id;
                //         $HomePageOfferAssociation->associated_item_id = $id;
                //         $HomePageOfferAssociation->save();
                //     }
                // }

            }

            DB::commit();

            return redirect()->route("current.offers.homepage.list")->with("success", "Current Offer has been Updated successfully!");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("current.offers.homepage.list")->with("error", "something went wrong");
        }

    }


    public function CurrentOfferImageStatus(Request $request){

                if ($request->status_value == 0){
            $HomePageOffer = HomePageOffer::where('id', $request->id)->update([
                'status' => '0',
            ]);
            return response()->json([
                'status' => 'group_inactive',
                'message' => "Choice Group Inactive",
            ]);
        } else {
            $HomePageOffer = HomePageOffer::where('id', $request->id)->update([
                'status' => '1',
            ]);
            return response()->json([
                'status' => 'group_active',
                'message' => "Choice Group Active",
            ]);
        }

    }


        public function CurrentOfferPopupImageStatus(Request $request){
 
                if ($request->status_value == 0){
            $HomePageOffer = HomePageOffer::where('id', $request->id)->update([
                'pop_up_image_status' => '0',
            ]);
            return response()->json([
                'status' => 'group_inactive',
                'message' => "Choice Group Inactive",
            ]);
        } else {
            $HomePageOffer = HomePageOffer::where('id', $request->id)->update([
                'pop_up_image_status' => '1',
            ]);
            return response()->json([
                'status' => 'group_active',
                'message' => "Choice Group Active",
            ]);
        }

    }
 

         //deletedOfferList
    public function deletedCurrentOfferList()
    {

        if (Auth::user()->can("manage_recyle_checkout_offer_tab")) {

         
        $HomePageDeletedOffers =    HomePageOffer::onlyTrashed()->get();
         
        return view('homepage_current_offer.deleted_offers_list', compact("HomePageDeletedOffers"));
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Restore Offer
    public function restoreCurrentOffer(Request $request)
    {
        $offersList = HomePageOffer::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteCurrentOffer(Request $request)
    {
        HomePageOffer::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }



}
