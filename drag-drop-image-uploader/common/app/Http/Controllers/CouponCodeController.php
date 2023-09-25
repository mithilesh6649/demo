<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CouponCode;
use App\Models\CouponCodeBranch;
use App\Models\CouponCodeItem;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Auth;
use DB;
use Illuminate\Http\Request;

class CouponCodeController extends Controller
{

    public function CouponCodeList()
    {
        if (Auth::user()->can("coupon_code_management")) {

            $CouponCode = CouponCode::get();
            return view('coupon-codes.list', compact('CouponCode'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function addCouponCode()
    {
        if (Auth::user()->can("add_coupon_offer")) {

            $branches = Branch::select('id', 'title_en')->where('status', 1)->get();

            $categories = MenuCategory::with('menuItems')->get();

            $menuItem = MenuItem::all();
            return view('coupon-codes.add', compact('branches', 'categories', 'branches', 'menuItem'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveCouponCode(Request $request)
    {

        // dd($request->all());

        DB::beginTransaction();

        try {

            $date = str_replace("/", "-", $request->end_date);
            $end_date = date('Y-m-d H:m:s', strtotime($date));
            $dates = str_replace("/", "-", $request->start_date);
            $start_date = date('Y-m-d H:m:s', strtotime($dates));

            $thumbnail = null;
            $CouponCode = new CouponCode();

            $CouponCode->coupon_name = $request->coupon_name;
            $CouponCode->description = $request->description;
            $CouponCode->start_date = $start_date;
            $CouponCode->end_date = $end_date;
            $CouponCode->discount_type = $request->discount_type;
            $CouponCode->discount_amount = $request->discount_amount;
            if ($request->city_id == "select_item") {$CouponCode->menu_item_id = null;} else { $CouponCode->menu_item_id = $request->city_id;
                $CouponCode->discount_amount = $request->discount_amount = null;}
            $CouponCode->coupon_type = $request->coupon_type;
            $CouponCode->minimum_order_amount = $request->minimum_order_amount;
            $CouponCode->discount_status = $request->discount_status;

            if ($request->file("thumbnail")) {
                $OffersImageTwo = $request->file("thumbnail");
                $thumbnail = time() . "." . $OffersImageTwo->getClientOriginalExtension();
                $OffersImageTwo->move("offers/coupon_code", $thumbnail);
            }

            $CouponCode->thumbnail = $thumbnail;

            if ($CouponCode->save()) {

                if (isset($request->menu_items)) {
                    foreach ($request->menu_items as $key => $id) {
                        $checkOutOfferItem = new CouponCodeItem();
                        $checkOutOfferItem->coupon_code_id = $CouponCode->id;
                        $checkOutOfferItem->menu_category_id = MenuItem::where('id', $id)->value('cat_id');
                        $checkOutOfferItem->menu_item_id = $id;
                        $checkOutOfferItem->save();
                    }
                }

                if (isset($request->branches)) {
                    foreach ($request->branches as $key => $id) {
                        $CheckoutOfferBranch = new CouponCodeBranch();
                        $CheckoutOfferBranch->coupon_code_id = $CouponCode->id;
                        $CheckoutOfferBranch->branch_id = $id;
                        $CheckoutOfferBranch->save();
                    }
                }

            }
            DB::commit();

            return redirect()
                ->route("coupon.code.list")
                ->with("success", "Coupon Code has been added successfully!");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("coupon.code.list")->with("error", "something went wrong");
        }

    }

    public function checkPromocode(Request $request)
    {
        $promocode = CouponCode::where("coupon_name", $request->promocode)->get();
        if (count($promocode) > 0) {
            $res = 1;
            return response()->json(["msg" => $res]);
        } else {
            $res = 0;
            return response()->json(["msg" => $res]);
        }
    }

    public function viewCouponCode($id)
    {

        if (Auth::user()->can("view_coupon_offer")) {

            $offer = CouponCode::with('CouponCodeBranch.Branch:id,title_en', 'CouponCodeItem.MenuItem.menuCategory')->find($id);

            $selected_menuItem = CouponCodeItem::select('menu_item_id', 'menu_category_id')->where('coupon_code_id', $id)->get()->groupBy('menu_category_id');

            $categories = MenuCategory::with('menuItems')->get();

            $menuItem = MenuItem::all();

            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();

            return view('coupon-codes.view', compact('offer', 'status', 'offerType', 'selected_menuItem', 'categories', 'menuItem'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function editCouponCode($id)
    {

        if (Auth::user()->can("edit_coupon_offer")) {

            $offer = CouponCode::where('id', $id)->first();
            // $offer =  CouponCode::with('CouponCodeBranch.Branch:id,title_en','CouponCodeItem.MenuItem.menuCategory')->find($id);
            $branches = Branch::select('id', 'title_en')->where('status', 1)->get();

            $categories = MenuCategory::with('menuItems')->get();

            $menuItem = MenuItem::all();
            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();

            $selected_menuItem = CouponCodeItem::select('menu_item_id', 'menu_category_id')->where('coupon_code_id', $id)->get()->groupBy('menu_category_id');
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('coupon-codes.edit', compact('offer', 'branches', 'categories', 'branches', 'status', 'selected_menuItem', 'offerType', 'menuItem'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function updateCouponCode(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {

            $date = str_replace("/", "-", $request->end_date);
            $end_date = date('Y-m-d H:m:s', strtotime($date));
            $dates = str_replace("/", "-", $request->start_date);
            $start_date = date('Y-m-d H:m:s', strtotime($dates));

            $CouponCode = CouponCode::where("id", $request->coupon_id)->first();
            CouponCodeItem::where('coupon_code_id', $request->coupon_id)->forceDelete();
            CouponCodeBranch::where('coupon_code_id', $request->coupon_id)->forceDelete();

            $CouponCode->coupon_name = $request->coupon_name;
            $CouponCode->description = $request->description;
            $CouponCode->start_date = $start_date;
            $CouponCode->end_date = $end_date;
            $CouponCode->discount_type = $request->discount_type;
            $CouponCode->discount_amount = $request->discount_amount;
            if ($request->discount_type != 2) {$CouponCode->menu_item_id = null;} else { $CouponCode->menu_item_id = $request->city_id;
                $CouponCode->discount_amount = $request->discount_amount = null;}
            $CouponCode->coupon_type = $request->coupon_type;
            $CouponCode->minimum_order_amount = $request->minimum_order_amount;
            $CouponCode->discount_status = $request->discount_status;

            if ($request->file("thumbnail")) {
                $OffersImageTwo = $request->file("thumbnail");
                $thumbnail = time() . "." . $OffersImageTwo->getClientOriginalExtension();
                $OffersImageTwo->move("offers/coupon_code", $thumbnail);
                $CouponCode->thumbnail = $thumbnail;
            }

            if ($CouponCode->update()) {

                if (isset($request->menu_items)) {

                    foreach ($request->menu_items as $key => $item_id) {
                        $CouponCodeItem = new CouponCodeItem();
                        $CouponCodeItem->coupon_code_id = $request->coupon_id;
                        $CouponCodeItem->menu_category_id = MenuItem::where('id', $item_id)->value('cat_id');
                        $CouponCodeItem->menu_item_id = $item_id;
                        $CouponCodeItem->save();
                    }
                }
                if (isset($request->branches)) {

                    foreach ($request->branches as $key => $branchs_id) {
                        $CouponCodeBranch = new CouponCodeBranch();
                        $CouponCodeBranch->coupon_code_id = $request->coupon_id;
                        $CouponCodeBranch->branch_id = $branchs_id;
                        $CouponCodeBranch->save();
                    }
                }

            }
            DB::commit();

            return redirect()->route("coupon.code.list")->with("success", "Coupon code has been updated successfully!");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("coupon.code.list")->with("success", "Something went to wrong !");
        }
    }

    public function deleteCouponCode(Request $request)
    {

        $offer = CouponCode::find($request->id);
        $deleteOffer = $offer->delete();
        if ($deleteOffer) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    //deletedOfferList
    public function deletedOfferList()
    {
        if (Auth::user()->can("manage_recyle_coupon_code_tab")) {

            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();
            $CouponCode = CouponCode::onlyTrashed()->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('coupon-codes.deleted_coupon_list', compact("CouponCode", 'offerType', 'status'));
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
    public function restoreOffer(Request $request)
    {
        $offersList = CouponCode::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteOffer(Request $request)
    {
        CouponCode::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

}
