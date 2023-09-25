<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckoutOffer;
use App\Models\CheckoutOfferBranch;
use App\Models\CheckoutOfferItem;
use App\Models\Offer;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Branch;
use DB,Auth;

class CheckoutOfferController extends Controller
{
     
    public function OfferList(){
        if (Auth::user()->can("checkout_offer_management")) {

         $offerType=DB::table('md_dropdowns')->where('slug','offer_type')->get();
         $offers =  CheckoutOffer::orderBy('created_at','DESC')->get();
         $status=DB::table('md_dropdowns')->where('slug','status_data')->get();
        return view('checkout-offers.list',compact('offers','status','offerType'));  
         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
     } 


    public function addOffer(){
        if (Auth::user()->can("add_checkout_offer")) {

       $branches = Branch::select('id','title_en')->where('status',1)->get();
        
       $categories = MenuCategory::with('menuItems')->get(); 
        
       $menuItem = MenuItem::all(); 

        $status=DB::table('md_dropdowns')->where('slug','status_data')->get();
     
       return view('checkout-offers.add',compact('branches','categories','branches','status'));
       } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
  }


   public function saveOffer(Request $request){
    
         DB::beginTransaction();

        try {


           $date=str_replace("/","-",$request->end_date);
           $end_date =date('Y-m-d H:00:00',strtotime($date));
           $dates=str_replace("/","-",$request->start_date);
           $start_date =date('Y-m-d H:00:00',strtotime($dates));
           $CheckoutOffer =  new  CheckoutOffer();
           $CheckoutOffer->offer_name = $request->offer_name;
           $CheckoutOffer->description   = $request->description;
           $CheckoutOffer->start_date = $start_date;
           $CheckoutOffer->end_date = $end_date;
           $CheckoutOffer->offer_type= $request->offer_type;
           $CheckoutOffer->offer_amount= $request->offer_amount;
           $CheckoutOffer->status=$request->discount_status;
           if($CheckoutOffer->save()){
           if(isset($request->menu_items)){
               foreach($request->menu_items as $key => $id){
                   $checkOutOfferItem = new CheckoutOfferItem();
                   $checkOutOfferItem->checkout_offer_id = $CheckoutOffer->id;
                   $checkOutOfferItem->menu_category_id =  MenuItem::where('id',$id)->value('cat_id');
                   $checkOutOfferItem->menu_item_id    = $id;
                   $checkOutOfferItem->save();  
               }
             } 
            if(isset($request->branches)){
                  foreach($request->branches as $key => $id){
                    $CheckoutOfferBranch  = new CheckoutOfferBranch();
                     $CheckoutOfferBranch->checkout_offer_id = $CheckoutOffer->id;
                     $CheckoutOfferBranch->branch_id = $id;
                     $CheckoutOfferBranch->save();    
               }
             }       
           } 


            
            DB::commit();

        return redirect()->route("checkout.offers.list")->with("success", "Checkout Offer has been added successfully!");
           
        } catch (\Exception $e) {
            DB::rollback();
           return redirect()->route("checkout.offers.list")->with("error", "something went wrong"); 
        }











   }



       public function viewOffer($id){
        if (Auth::user()->can("view_checkout_offer")) {
        
           $offer =  CheckoutOffer::with('CheckoutOfferBranch.Branch:id,title_en','CheckoutOfferItem.MenuItem.menuCategory')->find($id);
             
           $selected_menuItem=CheckoutOfferItem::select('menu_item_id','menu_category_id')->where('checkout_offer_id',$id)->get()->groupBy('menu_category_id');
        

           $categories = MenuCategory::with('menuItems')->get(); 
        
           $menuItem = MenuItem::all(); 

           $status=DB::table('md_dropdowns')->where('slug','status_data')->get();
           $offerType=DB::table('md_dropdowns')->where('slug','offer_type')->get();

     return view('checkout-offers.view',compact('offer','status','offerType','selected_menuItem','categories','menuItem'));

      } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
         
    }


      public function editOffer($id){
        if (Auth::user()->can("edit_checkout_offer")) {

           $offer =  CheckoutOffer::where('id',$id)->first();
        
           $branches = Branch::select('id','title_en')->where('status',1)->get();
        
           $categories = MenuCategory::with('menuItems')->get(); 
          
           $menuItem = MenuItem::all(); 
           $offerType=DB::table('md_dropdowns')->where('slug','offer_type')->get();

        $selected_menuItem=CheckoutOfferItem::select('menu_item_id','menu_category_id')->where('checkout_offer_id',$id)->get()->groupBy('menu_category_id');
        $status=DB::table('md_dropdowns')->where('slug','status_data')->get();
      
       return view('checkout-offers.edit',compact('offer','branches','categories','branches','status','selected_menuItem','offerType'));
       } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    
    }
   
    public function updateOffer(Request $request)
    {
        
          

          DB::beginTransaction();

        try {

                 $date=str_replace("/","-",$request->end_date);
           $end_date =date('Y-m-d H:00:00',strtotime($date));
           $dates=str_replace("/","-",$request->start_date);
           $start_date =date('Y-m-d H:00:00',strtotime($dates));

           $CheckoutOffer = CheckoutOffer::where('id',$request->offers_id)->first();
           $CheckoutOffer->offer_name = $request->offer_name;
           $CheckoutOffer->description   = $request->description;
           $CheckoutOffer->start_date = $start_date;
           $CheckoutOffer->end_date = $end_date;
           $CheckoutOffer->offer_type= $request->offer_type;
           $CheckoutOffer->offer_amount= $request->offer_amount;
           $CheckoutOffer->status=$request->discount_status;
           if($CheckoutOffer->update()){

            CheckoutOfferItem::where('checkout_offer_id',$request->offers_id)->forceDelete();

           if(isset($request->menu_items)){
               foreach($request->menu_items as $key => $id){
                   $checkOutOfferItem = new CheckoutOfferItem();
                   $checkOutOfferItem->checkout_offer_id = $CheckoutOffer->id;
                   $checkOutOfferItem->menu_category_id =  MenuItem::where('id',$id)->value('cat_id');
                   $checkOutOfferItem->menu_item_id    = $id;
                   $checkOutOfferItem->save();  
               }
             } 

            CheckoutOfferBranch::where('checkout_offer_id',$request->offers_id)->forceDelete();
            if(isset($request->branches)){
                  foreach($request->branches as $key => $id){
                    $CheckoutOfferBranch  = new CheckoutOfferBranch();
                     $CheckoutOfferBranch->checkout_offer_id = $CheckoutOffer->id;
                     $CheckoutOfferBranch->branch_id = $id;
                     $CheckoutOfferBranch->save();    
               }
             }       
           }

            
            DB::commit();

         return redirect()->route("checkout.offers.list")->with("success", "Checkout Offer has been updated successfully!");

           
        } catch (\Exception $e) {
            DB::rollback();
           return redirect()->route("checkout.offers.list")->with("error", "something went wrong"); 
        }














    }




    public function deleteOffer(Request $request)
    {
       
        $checkout=CheckoutOffer::where('id',$request->id)->first();
        if($checkout)
        {
           $checkout->delete();
            return response()->json([
                  'success'=>1
            ]);
       }else
       {
        return response()->json([
                 'success'=>0
         ]);
       }
    }




     //deletedOfferList
    public function deletedOfferList()
    {

        if (Auth::user()->can("manage_recyle_checkout_offer_tab")) {

         $offerType=DB::table('md_dropdowns')->where('slug','offer_type')->get();
        $offersList =    CheckoutOffer::onlyTrashed()->get();
         $status=DB::table('md_dropdowns')->where('slug','status_data')->get();

        return view('checkout-offers.deleted_offers_list', compact("offersList",'offerType','status'));
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
        $offersList = CheckoutOffer::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteOffer(Request $request)
    {
        CheckoutOffer::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }



}
