<?php

namespace App\Http\Controllers;

use App\Models\LoyalityLevel;
use Auth;
use DB;
use Illuminate\Http\Request;

class LoyalityLevelController extends Controller
{

    public function LoyaltyList()
    {
        if (Auth::user()->can("loyalites_management")) {

        
             $loyalties = LoyalityLevel::whereNotIn('rewards_programm', ['online_order','dine_in'])->orderBy('position', 'ASC')->get();
            return view('loyalties-level.list', compact('loyalties'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function addLoyalty()
    {
        $rewards_programm = DB::table('md_dropdowns')->where('slug', 'rewards_programm')->get();
        $all_inserted_loyalities = LoyalityLevel::where('rewards_programm', '!=', 'loyality_level')->pluck('rewards_programm')->toArray();
        //dd($all_inserted_loyalities);
        return view('loyalties-level.add', compact('rewards_programm', 'all_inserted_loyalities'));
    }

    public function saveLoyalty(Request $request)
    {
        dd($request->all());

        $loyaltyLevel = new LoyalityLevel();
        //Start logic

        if ($request->rewards_programm == 'loyality_level') {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = $request->points_from;
            $loyaltyLevel->points_to = $request->points_to;
            $loyaltyLevel->regular_items_points = $request->regular_items_points;
            $loyaltyLevel->offers_items_points = $request->offers_items_points;
            $loyaltyLevel->events_points = $request->birthday_points;
            $loyaltyLevel->events_points_expiry = $request->birthday_points_expiry_day;

            $loyaltyLevel->register_bonus_newuser = null;
            $loyaltyLevel->bonus_active_newuser = null;
            $loyaltyLevel->minimun_order_amount = null;

            //return 'loyality_level';
        } elseif ($request->rewards_programm == 'sign_up') {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = null;
            $loyaltyLevel->points_to = null;
            $loyaltyLevel->regular_items_points = null;
            $loyaltyLevel->offers_items_points = null;
            $loyaltyLevel->events_points = $request->sign_up_items_points;
            $loyaltyLevel->events_points_expiry = $request->sign_up_points_expiry_day;

            $loyaltyLevel->register_bonus_newuser = null;
            $loyaltyLevel->bonus_active_newuser = null;
            $loyaltyLevel->minimun_order_amount = null;

        } elseif ($request->rewards_programm == 'referral') {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = null;
            $loyaltyLevel->points_to = null;
            $loyaltyLevel->regular_items_points = null;
            $loyaltyLevel->offers_items_points = null;
            $loyaltyLevel->events_points = null;
            $loyaltyLevel->events_points_expiry = null;

            $loyaltyLevel->register_bonus_newuser = $request->register_bonus_newuser;
            $loyaltyLevel->bonus_active_newuser = $request->bonus_active_newuser;
            $loyaltyLevel->minimun_order_amount = null;

        } elseif ($request->rewards_programm == 'online_order') {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = null;
            $loyaltyLevel->points_to = null;
            $loyaltyLevel->regular_items_points = null;
            $loyaltyLevel->offers_items_points = null;
            $loyaltyLevel->events_points = $request->online_order_points;
            $loyaltyLevel->events_points_expiry = null;

            $loyaltyLevel->register_bonus_newuser = null;
            $loyaltyLevel->bonus_active_newuser = null;
            $loyaltyLevel->minimun_order_amount = $request->online_order_minimun_order_amount;

        } else {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = null;
            $loyaltyLevel->points_to = null;
            $loyaltyLevel->regular_items_points = null;
            $loyaltyLevel->offers_items_points = null;
            $loyaltyLevel->events_points = $request->dine_in_points;
            $loyaltyLevel->events_points_expiry = null;

            $loyaltyLevel->register_bonus_newuser = null;
            $loyaltyLevel->bonus_active_newuser = null;
            $loyaltyLevel->minimun_order_amount = $request->dine_in_minimun_order_amount;

        }

        if ($loyaltyLevel->save()) {
            return redirect()->route('loyalty.level.list')->with(['success' => 'Loyalty   has been added successfully !']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

        //End logic

    }

    public function viewLoyalty($id)
    {
        if (Auth::user()->can("view_loyalty")) {

            $loyalty = LoyalityLevel::where('id', $id)->first();
            $rewards_programm = DB::table('md_dropdowns')->where('slug', 'rewards_programm')->get();
            return view('loyalties-level.view', compact('loyalty', 'rewards_programm'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function editLoyalty($id)
    {
        if (Auth::user()->can("edit_loyalty")) {

            $loyalty = LoyalityLevel::where('id', $id)->first();
            $rewards_programm = DB::table('md_dropdowns')->where('slug', 'rewards_programm')->get();
            // dd($rewards_programm);
            return view('loyalties-level.edit', compact('loyalty', 'rewards_programm'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function updateLoyalty(Request $request)
    {

        $loyaltyLevel = LoyalityLevel::where("id", $request->loyalty_id)->first();
        //Start logic

        // //update position
        //     $old_position = LoyalityLevel::where('position',$request->position)->first();
        //     $old_position->position = LoyalityLevel::where("id", $request->loyalty_id)->pluck('position')[0];
        //     $old_position->save();
        $loyaltyLevel->position = $request->position;
        if ($request->rewards_programm == 'loyality_level') {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = $request->points_from;
            $loyaltyLevel->points_to = $request->points_to;
            $loyaltyLevel->regular_items_points = $request->regular_items_points;
            $loyaltyLevel->offers_items_points = $request->offers_items_points;
            $loyaltyLevel->events_points = $request->birthday_points;
            $loyaltyLevel->events_points_expiry = $request->birthday_points_expiry_day;

            $loyaltyLevel->register_bonus_newuser = null;
            $loyaltyLevel->bonus_active_newuser = null;
            $loyaltyLevel->minimun_order_amount = null;

            //return 'loyality_level';
        } elseif ($request->rewards_programm == 'sign_up') {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = null;
            $loyaltyLevel->points_to = null;
            $loyaltyLevel->regular_items_points = null;
            $loyaltyLevel->offers_items_points = null;
            $loyaltyLevel->events_points = $request->sign_up_items_points;
            $loyaltyLevel->events_points_expiry = $request->sign_up_points_expiry_day;

            $loyaltyLevel->register_bonus_newuser = null;
            $loyaltyLevel->bonus_active_newuser = null;
            $loyaltyLevel->minimun_order_amount = null;

        } elseif ($request->rewards_programm == 'referral') {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = null;
            $loyaltyLevel->points_to = null;
            $loyaltyLevel->regular_items_points = null;
            $loyaltyLevel->offers_items_points = null;
            $loyaltyLevel->events_points = null;
            $loyaltyLevel->events_points_expiry = null;

            $loyaltyLevel->register_bonus_newuser = $request->register_bonus_newuser;
            $loyaltyLevel->bonus_active_newuser = $request->bonus_active_newuser;
            $loyaltyLevel->minimun_order_amount = null;

        } elseif ($request->rewards_programm == 'online_order') {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = null;
            $loyaltyLevel->points_to = null;
            $loyaltyLevel->regular_items_points = null;
            $loyaltyLevel->offers_items_points = null;
            $loyaltyLevel->events_points = $request->online_order_points;
            $loyaltyLevel->events_points_expiry = null;

            $loyaltyLevel->register_bonus_newuser = null;
            $loyaltyLevel->bonus_active_newuser = null;
            $loyaltyLevel->minimun_order_amount = $request->online_order_minimun_order_amount;

        } else {

            $loyaltyLevel->loyalty_name = $request->loyalty_name;
            $loyaltyLevel->loyalty_description = $request->loyalty_description;
            $loyaltyLevel->rewards_programm = $request->rewards_programm;
            $loyaltyLevel->status = $request->status;

            $loyaltyLevel->points_from = null;
            $loyaltyLevel->points_to = null;
            $loyaltyLevel->regular_items_points = null;
            $loyaltyLevel->offers_items_points = null;
            $loyaltyLevel->events_points = $request->dine_in_points;
            $loyaltyLevel->events_points_expiry = null;

            $loyaltyLevel->register_bonus_newuser = null;
            $loyaltyLevel->bonus_active_newuser = null;
            $loyaltyLevel->minimun_order_amount = $request->dine_in_minimun_order_amount;

        }

        if ($loyaltyLevel->update()) {
            return redirect()->route('loyalty.level.list')->with(['success' => 'Loyalty   has been updated successfully !']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

        //End logic

    }

}
