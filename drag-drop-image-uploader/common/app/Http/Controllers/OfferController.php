<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Auth;
class OfferController extends Controller
{
     public function OfferList(){
         if (Auth::user()->can("view_offer")) {
          $offers =  Offer::get();
        return view('offers.list',compact('offers'));
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
    //     if (Auth::user()->can("add_offer")) {
       return view('offers.add');
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
          //   dd($request->all()); 
               
                   $picture_one = null;
                  $picture_two = null;
                  if ($request->file("picture_one")) {
                      $OffersImage = $request->file("picture_one");
                      $picture_one =
                          time() . "." . $OffersImage->getClientOriginalExtension();
                      $OffersImage->move("offers/image_one", $picture_one);
                  }

                  if ($request->file("picture_two")) {
                      $OffersImageTwo = $request->file("picture_two");
                      $picture_two = time() . "." . $OffersImageTwo->getClientOriginalExtension();
                      $OffersImageTwo->move("offers/image_two", $picture_two);
                  }

             
              $offer =  new Offer();
              $offer->offer_name = $request->offer_name;
              $offer->promocode = $request->promocode;
              $offer->start_date = $request->start_date;
              $offer->end_date = $request->end_date;
              $offer->description = $request->description;
              $offer->terms_and_conditions = $request->terms_and_conditions;
              $offer->discount_type = $request->discount_type;
              $offer->discount_amount = $request->discount_amount;
              $offer->minimum_order = isset($request->minimum_order) ? $request->minimum_order : null; 
              $offer->minimum_order_amount = isset($request->minimum_order_amount) ? $request->minimum_order_amount : null;
              $offer->maximum_order = isset($request->maximum_order) ? $request->maximum_order : null;
              $offer->maximum_order_amount = isset($request->maximum_order_amount) ? $request->maximum_order_amount : null;
              $offer->every_order =  isset($request->every_order) ? $request->every_order : null;
              $offer->first_order =  isset($request->first_order) ? $request->first_order : null;
              $offer->picture_one =  $picture_one;
              $offer->picture_two =  $picture_two;

                if ($offer->save()) {
            return redirect()
                ->route("offers.list")
                ->with("success", "Offer has been added successfully!");
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }

 
    }




   
    public function checkPromocode(Request $request)
    {
        $promocode = Offer::where("promocode", $request->promocode)->get();
        if (count($promocode) > 0) {
            $res = 1;
            return response()->json(["msg" => $res]);
        } else {
            $res = 0;
            return response()->json(["msg" => $res]);
        }
    }



    public function viewOffer($id){
 if (Auth::user()->can("view_offer")) {
     $offer =  Offer::find($id);
     return view('offers.view',compact('offer'));
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
 if (Auth::user()->can("view_offer")) {
      $offer =  Offer::find($id);
     return view('offers.edit',compact('offer'));
      } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }



    public function updateOffer(Request $request){
     

          

                  //   $picture_one = null;
                  // $picture_two = null;
                  // if ($request->file("picture_two")) {
                  //     $OffersImage = $request->file("picture_one");
                  //     $picture_one =
                  //         time() . "." . $OffersImage->getClientOriginalExtension();
                  //     $OffersImage->move("offers/image_one", $picture_one);
                  // }

                  // if ($request->file("picture_two")) {
                  //     $OffersImageTwo = $request->file("picture_two");
                  //     $picture_two = time() . "." . $OffersImageTwo->getClientOriginalExtension();
                  //     $OffersImageTwo->move("offers/image_two", $picture_two);
                  // }

             
              $offer =  Offer::where("id", $request->offer_id)->first();
              $offer->offer_name = $request->offer_name;
              $offer->promocode = $request->promocode;
              $offer->start_date = $request->start_date;
              $offer->end_date = $request->end_date;
              $offer->description = $request->description;
              $offer->terms_and_conditions = $request->terms_and_conditions;
              $offer->discount_type = $request->discount_type;
              $offer->discount_amount = $request->discount_amount;
              $offer->minimum_order = isset($request->minimum_order) ? $request->minimum_order : null; 
              $offer->minimum_order_amount = isset($request->minimum_order_amount) ? $request->minimum_order_amount : null;
              $offer->maximum_order = isset($request->maximum_order) ? $request->maximum_order : null;
              $offer->maximum_order_amount = isset($request->maximum_order_amount) ? $request->maximum_order_amount : null;
              $offer->every_order =  isset($request->every_order) ? $request->every_order : null;
              $offer->first_order =  isset($request->first_order) ? $request->first_order : null;
              $offer->status = $request->status;  


              
                 if ($request->file("picture_one")) {
                 $OffersImage = $request->file("picture_one");
                 $picture_one =rand().time() .".".$OffersImage->getClientOriginalExtension();
                 $OffersImage->move("offers/image_one", $picture_one);
                 $offer->picture_one = $picture_one;
                 }

                if ($request->file("picture_two")) {
                 $OffersImageTwo = $request->file("picture_two");
                 $picture_two =rand().time().".".$OffersImageTwo->getClientOriginalExtension();
                   $OffersImageTwo->move("offers/image_two", $picture_two);
                 $offer->picture_two = $picture_two;
                 }
 
          if ($offer->update()) {
            return redirect()
                ->route("offers.list")
                ->with(["success" => "Offer has been updated successfully !"]);
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }


 

    }




   public function deleteOffer(Request $request){

     $offer = Offer::find($request->id);
        $deleteOffer = $offer->delete();
        if($deleteOffer) {
            $res['success'] = 1;
            return json_encode($res);
        }
        else {
            $res['success'] = 0;
            return json_encode($res);
        }

   } 


   
   


    //deletedOfferList
    public function deletedOfferList()
    {
        
        $offersList =    Offer::onlyTrashed()->get();
        return view('offers.deleted_offers_list', compact("offersList"));
    }

    //Restore Offer
    public function restoreOffer(Request $request)
    {
        $offersList = Offer::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteOffer(Request $request)
    {
        $usersList = Offer::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }



}
