<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Discount;
use App\Models\DiscountBranch;
use App\Models\DiscountItem;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Auth;
use DB;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        if (Auth::user()->can("discount_offers_management")) {

            $discount = Discount::with('discountItem', 'discountbranch')->orderBy('created_at', 'DESC')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('discount.list', compact('discount', 'status'));
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
        if (Auth::user()->can("add_discount_offer")) {

            $branches = Branch::select('id', 'title_en')->where('status', 1)->get();
            $categories = MenuCategory::with('menuItems')->get();
            $menuItem = MenuItem::all();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('discount.add', compact('branches', 'menuItem', 'categories', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function viewDiscount(Request $request, $id)
    {
        if (Auth::user()->can("view_discount_offer")) {

            $discount = Discount::with('discountItem.MenuItem.menuCategory', 'discountbranch.Branch:id,title_en')->where('id', $id)->first();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            $discountItem = DiscountItem::select('menu_item_id', 'menu_category_id')->where('discount_id', $id)->get()->groupBy('menu_category_id');

            return view('discount.view', compact('discount', 'discountItem', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }
    public function edit($id)
    {
        if (Auth::user()->can("edit_discount_offer")) {

            $branches = Branch::select('id', 'title_en')->where('status', 1)->get();
            $categories = MenuCategory::with('menuItems')->get();
            $menuItem = MenuItem::all();

            $discount = Discount::with('discountItem', 'discountbranch')->where('id', $id)->first();

            $discountItem = DiscountItem::select('menu_item_id', 'menu_category_id')->where('discount_id', $id)->get()->groupBy('menu_category_id');

            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('discount.edit', compact('branches', 'menuItem', 'categories', 'discount', 'discountItem', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function saveDiscount(Request $request)
    {

        DB::beginTransaction();

        try {

            $date = str_replace("/", "-", $request->end_date);
            $end_date = date('Y-m-d H:m:s', strtotime($date));
            $dates = str_replace("/", "-", $request->start_date);
            $start_date = date('Y-m-d H:m:s', strtotime($dates));

            $Discount = new Discount();
            $Discount->discount_name = $request->discount_title;
            $Discount->discount_description = $request->discount_description;
            $Discount->discount_type = strtolower($request->discount_type);
            $Discount->start_date = $start_date;
            $Discount->end_date = $end_date;
            $Discount->discount_amount = $request->discount_amount;
            $Discount->status = $request->discount_status;
            if ($Discount->save()) {

                if (isset($request->menu_items)) {
                    foreach ($request->menu_items as $key => $item_id) {
                        $Discountitem = new DiscountItem();
                        $Discountitem->discount_id = $Discount->id;
                        $Discountitem->menu_category_id = MenuItem::where('id', $item_id)->value('cat_id');
                        $Discountitem->menu_item_id = $item_id;
                        $Discountitem->save();
                    }
                }
                if (isset($request->branches)) {

                    foreach ($request->branches as $key => $branchs_id) {
                        $Discountbranch = new DiscountBranch();
                        $Discountbranch->discount_id = $Discount->id;
                        $Discountbranch->branch_id = $branchs_id;
                        $Discountbranch->save();
                    }
                }
            }
            DB::commit();

            return redirect()->route("discount.list")->with("success", "Discount has been added successfully!");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("discount.list")->with("error", "something went wrong");
        }

    }

    public function updateDiscount(Request $request)
    {

        DB::beginTransaction();

        try {

            $date = str_replace("/", "-", $request->end_date);
            $end_date = date('Y-m-d H:m:s', strtotime($date));
            $dates = str_replace("/", "-", $request->start_date);
            $start_date = date('Y-m-d H:m:s', strtotime($dates));

            $Discount = Discount::where('id', $request->discount_id)->first();
            DiscountItem::where('discount_id', $request->discount_id)->forceDelete();
            DiscountBranch::where('discount_id', $request->discount_id)->forceDelete();
            $Discount->discount_name = $request->discount_title;
            $Discount->discount_description = $request->discount_description;
            $Discount->discount_type = strtolower($request->discount_type);
            $Discount->start_date = $start_date;
            $Discount->end_date = $end_date;
            $Discount->discount_amount = $request->discount_amount;
            $Discount->status = $request->discount_status;
            if ($Discount->update()) {

                if (isset($request->menu_items)) {

                    foreach ($request->menu_items as $key => $item_id) {
                        $Discountitem = new DiscountItem();
                        $Discountitem->discount_id = $request->discount_id;
                        $Discountitem->menu_category_id = MenuItem::where('id', $item_id)->value('cat_id');
                        $Discountitem->menu_item_id = $item_id;
                        $Discountitem->save();
                    }
                }
                if (isset($request->branches)) {

                    foreach ($request->branches as $key => $branchs_id) {
                        $Discountbranch = new DiscountBranch();
                        $Discountbranch->discount_id = $request->discount_id;
                        $Discountbranch->branch_id = $branchs_id;
                        $Discountbranch->save();
                    }
                }
            }
            DB::commit();

            return redirect()->route("discount.list")->with("success", "Discount has been updated successfully!");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("discount.list")->with("error", "something went wrong");
        }
    }

    public function deleteDiscount(Request $request)
    {
        $discount = Discount::where('id', $request->id)->first();
        if ($discount) {
            $discount->delete();
            return response()->json([
                'success' => 1,
            ]);
        } else {
            return response()->json([
                'success' => 0,
            ]);
        }

    }

    //deletedOfferList
    public function deletedOfferList()
    {

        if (Auth::user()->can("manage_recyle_discount_offer_tab")) {

            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();
            $discount = Discount::onlyTrashed()->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('discount.deleted_list', compact("discount", 'offerType', 'status'));
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
        $offersList = Discount::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteOffer(Request $request)
    {
        Discount::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

}
