<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dite;
use App\Models\DietPlanSubscription;
use App\Models\DietSubPlanSubscriptionMap;
use App\Models\SubPlanFeatureMap;
use App\Models\SubscriptionSubPlanPricing;
use App\Models\SubPlanPricingFeatureMap;
use App\Models\Feature;
use DB;
class DietPlanSubscriptionSubController extends Controller
{
   public function DietSubscriptionSubPlanList(){
      //   return $subPlans = Dite::where('type',Dite::PLANS)->get();
      $subPlans = DB::table('diets')->join('diet_sub_plan_subscription_maps','diets.id','=','diet_sub_plan_subscription_maps.diet_id')->where('type',Dite::PLANS)->select('diets.*','diet_sub_plan_subscription_maps.diet_plan_subscription_id')->get();
      $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      return view('diet_subscription_sub_plan.list', ['subPlans' => $subPlans, 'status' => $status]);
  }

  public function addDietSubscriptionSubPlan(){

   // $allDietSubPlanFeatures = Feature::where(['type'=>Feature::DIET_SUB_PLAN,'status'=>1])->get();

    $allDietSubPlanFeatures = Feature::where(['status'=>1])->whereIn('type',['type'=>Feature::DIET_DURATION_PLAN,Feature::DIET_SUB_PLAN])->get();

    $allDietSubPlanDurationFeatures = Feature::where(['status'=>1])->whereIn('type',['type'=>Feature::DIET_DURATION_PLAN,Feature::DIET_SUB_PLAN])->get();
    //$allPlanFeatures = Feature::where(['status'=>1])->where('type','!=',1)->get();
    $DietSubscriptionPlanList = DietPlanSubscription::where('id','!=',1)->where(['status'=>1])->get();
    $MonthDurations = DB::table('md_dropdowns')->where('slug', 'plan_month_duration')->get(); 
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('diet_subscription_sub_plan.add', ['allDietSubPlanFeatures' => $allDietSubPlanFeatures,'allDietSubPlanDurationFeatures'=>$allDietSubPlanDurationFeatures, 'status' => $status,'DietSubscriptionPlanList'=>$DietSubscriptionPlanList,'MonthDurations'=>$MonthDurations]);
}

public function saveDietSubscriptionSubPlan(Request $request){
      //  dd($request->all());
           //Fist Store Sub Plan............
 $subPlan  =  new Dite();
 $subPlan->title = $request->name;
 $subPlan->amount = $request->amount; 
 $subPlan->type = 2;
 $subPlan->description = '';  
 $subPlan->discount = isset($request->is_paid) ? $request->discount : 0;
 $subPlan->status =  1;
 if($subPlan->save()){

  if ($request->features_id != "") {
    foreach ($request->features_id as $key => $id) {
        $DietSubPlanFeatureMap = new SubPlanFeatureMap();
        $DietSubPlanFeatureMap->diet_id = $subPlan->id;
        $DietSubPlanFeatureMap->feature_id = $id;
        $DietSubPlanFeatureMap->save();
    }
}


$DietSubPlanSubscriptionMap =  new  DietSubPlanSubscriptionMap();
$DietSubPlanSubscriptionMap->diet_plan_subscription_id = $request->diet_plan_subscription_id;
$DietSubPlanSubscriptionMap->diet_id = $subPlan->id;
$DietSubPlanSubscriptionMap->save();  

    //Store Sub Plans Pricing........

foreach($request->plan_duration as $key => $value){

 $SubscriptionSubPlanPricing =  new SubscriptionSubPlanPricing;
 $SubscriptionSubPlanPricing->diet_id = $subPlan->id;
 $SubscriptionSubPlanPricing->duration = $request->plan_duration[$key][0];
 $SubscriptionSubPlanPricing->amount = $request->plan_amount[$key][0];
 $SubscriptionSubPlanPricing->discount = $request->plan_discount[$key][0];
 $SubscriptionSubPlanPricing->status = 1;
 $SubscriptionSubPlanPricing->save();


         //Store sub_plan_pricing_feature_maps;
 if ($request->plan_feature_id != "") { 
  if(isset($request->plan_feature_id[$key])){
    foreach($request->plan_feature_id[$key] as $price_key=>$price_feature_id){
     $SubPlanPricingFeatureMap =   new SubPlanPricingFeatureMap;
     $SubPlanPricingFeatureMap->subscription_sub_plan_pricing_id = $SubscriptionSubPlanPricing->id;
     $SubPlanPricingFeatureMap->feature_id =$price_feature_id;
     $SubPlanPricingFeatureMap->save(); 
 } 
}
}


          // dd($request->plan_duration[$key][0]);
}    

// dd('erer');


}   

return redirect()->route('diet.subscription.sub.plan.list')->with(['success' => 'Diet Plan Sub Subscription  has been added successfully!']);

}


// public function editDietSubscriptionSubPlan($id){

//    $data =  Dite::with('subPlanFeatureMap','dietSubPlanSubscriptionMap.diet')->where('id',$id)->first();
//    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
//    $DietSubscriptionPlanList = DietPlanSubscription::where('id','!=',1)->where(['status'=>1])->get();
//    $allPlanFeatures = Feature::where(['type'=>Feature::DIET_SUB_PLAN,'status'=>1])->get();
//    return view('diet_subscription_sub_plan.edit', compact('data', 'status', 'allPlanFeatures','DietSubscriptionPlanList'));
// }

public function editDietSubscriptionSubPlan($id){

   $data =  Dite::with('subPlanFeatureMap','dietSubPlanSubscriptionMap.diet')->where('id',$id)->first();

   $SubsSubPlanPricing = SubscriptionSubPlanPricing::with('subPlanPricingFeatureMap')->where('diet_id',$id)->get();
   $MonthDurations = DB::table('md_dropdowns')->where('slug', 'plan_month_duration')->get(); 
  // dd($SubscriptionSubPlanPricing);
   $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
   $DietSubscriptionPlanList = DietPlanSubscription::where('id','!=',1)->where(['status'=>1])->get();
    //  $allDietSubPlanFeatures = Feature::where(['type'=>Feature::DIET_SUB_PLAN,'status'=>1])->get();
    // $allDietSubPlanDurationFeatures = Feature::where(['status'=>1])->whereIn('type',['type'=>Feature::DIET_DURATION_PLAN,Feature::DIET_SUB_PLAN])->get();

   $allDietSubPlanFeatures = Feature::where(['status'=>1])->whereIn('type',['type'=>Feature::DIET_DURATION_PLAN,Feature::DIET_SUB_PLAN])->get();

    $allDietSubPlanDurationFeatures = Feature::where(['status'=>1])->whereIn('type',['type'=>Feature::DIET_DURATION_PLAN,Feature::DIET_SUB_PLAN])->get();
   return view('diet_subscription_sub_plan.edit', compact('data', 'status', 'allDietSubPlanFeatures','allDietSubPlanDurationFeatures','DietSubscriptionPlanList','MonthDurations','SubsSubPlanPricing'));
}




public function updateDietSubscriptionSubPlan(Request $request){
        //dd($request->all());
 $subPlan  =  Dite::where('id',$request->id)->first();
 $subPlan->title = $request->name;
 $subPlan->amount = $request->amount; 
 $subPlan->type = 2;
 $subPlan->description = '';  
 $subPlan->discount = isset($request->is_paid) ? $request->discount : 0;
 $subPlan->status =  1;
 if($subPlan->update()){

    DietSubPlanSubscriptionMap::updateOrCreate(
        ['diet_id' =>$request->id],
        [
         'diet_plan_subscription_id' => $request->diet_plan_subscription_id,
     ]
 );


        //Update or delete........
    SubPlanFeatureMap::where('diet_id', $request->id)->forceDelete();
    if ($request->features_id != "") {
        foreach ($request->features_id as $key => $id) {

            $DietSubPlanFeatureMap = new SubPlanFeatureMap();
            $DietSubPlanFeatureMap->diet_id = $request->id;
            $DietSubPlanFeatureMap->feature_id = $id;
            $DietSubPlanFeatureMap->save();
        }
    }



//xxxxxxxxxxxxxx
     //Store Sub Plans Pricing........
  //SubscriptionSubPlanPricing::where('diet_id', $request->id)->forceDelete();
    foreach($request->sub_plan_pricing_id as $key => $value){
     $subscription_sub_plan_pricing_id = $value[0]; 

     $subsSubPlan = SubscriptionSubPlanPricing::updateOrCreate(
        ['id' =>$subscription_sub_plan_pricing_id],
        [
         'diet_id' => $request->id,
         'duration'=>$request->plan_duration[$key][0],
         'amount'=>$request->plan_amount[$key][0],
         'discount'=>$request->plan_discount[$key][0],
         'status'=>1,
     ] 
 );
       // dump($subsSubPlan->id);
     SubPlanPricingFeatureMap::where('subscription_sub_plan_pricing_id', $subsSubPlan->id)->forceDelete();
         //Store sub_plan_pricing_feature_maps;
     if ($request->plan_feature_id != "") { 
      if(isset($request->plan_feature_id[$key])){
        foreach($request->plan_feature_id[$key] as $price_key=>$price_feature_id){
           $SubPlanPricingFeatureMap =   new SubPlanPricingFeatureMap;
           $SubPlanPricingFeatureMap->subscription_sub_plan_pricing_id = $subsSubPlan->id;
           $SubPlanPricingFeatureMap->feature_id =$price_feature_id;
           $SubPlanPricingFeatureMap->save(); 
       } 
   }
}


          // dd($request->plan_duration[$key][0]);
} 
// xxxxxxxxx
//dd('sdffffff');


return redirect()->route('diet.subscription.sub.plan.list')->with(['success' => 'Diet Plan Sub Subscription  has been update successfully!']);
}
}



// public function viewDietSubscriptionSubPlan($id){

//    $data =  Dite::with('subPlanFeatureMap','dietSubPlanSubscriptionMap.diet')->where('id',$id)->first();
//    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
//    $DietSubscriptionPlanList = DietPlanSubscription::where('id','!=',1)->where(['status'=>1])->get();
//    $allPlanFeatures = Feature::where(['type'=>Feature::DIET_SUB_PLAN,'status'=>1])->get();
//    return view('diet_subscription_sub_plan.view', compact('data', 'status', 'allPlanFeatures','DietSubscriptionPlanList'));
// }


public function viewDietSubscriptionSubPlan($id){

   $data =  Dite::with('subPlanFeatureMap','dietSubPlanSubscriptionMap.diet')->where('id',$id)->first();

   $SubsSubPlanPricing = SubscriptionSubPlanPricing::with('subPlanPricingFeatureMap')->where('diet_id',$id)->get();
   $MonthDurations = DB::table('md_dropdowns')->where('slug', 'plan_month_duration')->get(); 
  // dd($SubscriptionSubPlanPricing);
   $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
   $DietSubscriptionPlanList = DietPlanSubscription::where('id','!=',1)->where(['status'=>1])->get();
    //  $allDietSubPlanFeatures = Feature::where(['type'=>Feature::DIET_SUB_PLAN,'status'=>1])->get();
    // $allDietSubPlanDurationFeatures = Feature::where(['type'=>Feature::DIET_DURATION_PLAN,'status'=>1])->get();

   $allDietSubPlanFeatures = Feature::where(['status'=>1])->whereIn('type',['type'=>Feature::DIET_DURATION_PLAN,Feature::DIET_SUB_PLAN])->get();

    $allDietSubPlanDurationFeatures = Feature::where(['status'=>1])->whereIn('type',['type'=>Feature::DIET_DURATION_PLAN,Feature::DIET_SUB_PLAN])->get();
   return view('diet_subscription_sub_plan.view', compact('data', 'status', 'allDietSubPlanFeatures','allDietSubPlanDurationFeatures','DietSubscriptionPlanList','MonthDurations','SubsSubPlanPricing'));
}


public function DietSubscriptionSubPlanPricingList(){
 $subPlans = DB::table('diets')->join('diet_sub_plan_subscription_maps','diets.id','=','diet_sub_plan_subscription_maps.diet_id')->where('type',Dite::PLANS)->select('diets.*','diet_sub_plan_subscription_maps.diet_plan_subscription_id')->get();
 $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
 return view('diet_subscription_sub_plan_pricing.list', ['subPlans' => $subPlans, 'status' => $status]);
}


public function deleteDietSubscriptionSubPlanDuration(Request $request){
   $delete =   SubscriptionSubPlanPricing::where('id',$request->id)->delete();
   if ($delete) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
}



}
