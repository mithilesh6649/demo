    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loyalty;

class LoyaltyController extends Controller
{

   
     
    public function LoyaltyList(){
         $loyalties =  Loyalty::orderBy('created_at','desc')->get();
        return view('loyalties.list',compact('loyalties'));
    }


    public function viewLoyalty($id){
           $loyalty = Loyalty::where('id',$id)->first();
           return view('loyalties.view',compact('loyalty'));

    }

   
   public function editLoyalty($id){
           $loyalty = Loyalty::where('id',$id)->first();
           return view('loyalties.edit',compact('loyalty'));

    }   
 

    public function updateLoyalty(Request $request){
     
             $loyalty =  Loyalty::where("id", $request->loyalty_id)->first();
             $loyalty->loyalty_type = $request->loyalty_type;
             $loyalty->applicable_from = $request->applicable_from;
             $loyalty->applicable_to = $request->applicable_to;
             $loyalty->amount_text = $request->amount_text;
             $loyalty->amount = $request->amount; 
             $loyalty->redeem_text = $request->redeem_text;
             $loyalty->redeem_amount = $request->redeem_amount;
             $loyalty->status = $request->status;

                 if ($request->file("thumbnail")) {
            $loyaltyThumbnail = $request->file("thumbnail");
            $thumbnail =
                rand() .
                time() .
                "." .
                $loyaltyThumbnail->getClientOriginalExtension();
            $loyaltyThumbnail->move("loyalty/thumbnail", $thumbnail);

            $loyalty->loyalty_image = $thumbnail;
        } 


            if($loyalty->update()){
                    return redirect()->route('loyalty.list')->with(['success'=>'Loyalty has been Updated successfully !']);
                }else{
                    return redirect()->back()->with('warning','Something went wrong!');
                }
            

    } 


}
