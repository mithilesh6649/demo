<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Consultant;
use App\Models\DietPlanSubscription;
use App\Models\DietSubscriptionFeatureMap;
use App\Models\SubscriptionSubPlanPricing;
use App\Models\DietSubPlanSubscriptionMap;
use App\Models\Feature;
use App\Models\MealPlanTemplate;
use App\Models\MealPlanTemplateTag;
use App\Models\HealthComplaint;
use App\Models\Dite;
use DB;


class MiscController extends Controller
{

    public function ConsultationList()
    {
        $allConsultants = Consultant::all();
        return view('consultant.list', compact('allConsultants'));
    }

    public function viewConsultation($id)
    {
        $data = Consultant::where('id', $id)->first();
        return view('consultant.view', compact('data'));
    }

    public function editConsultation($id)
    {
        $data = Consultant::where('id', $id)->first();
        return view('consultant.edit', compact('data'));
    }

    public function updateConsultation(Request $request)
    {
        // dd($request->all());

        $Consultant = Consultant::where('id', $request->consultation_id)->first();
        $Consultant->type = $request->name;
        $Consultant->description = $request->description;
        $Consultant->free = isset($request->is_paid) ? 0 : 1;
        $Consultant->discount = isset($request->is_paid) ? $request->discount : 0;

        if ($request->file("thumbnail")) {
            $ConsultantImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $ConsultantImage->getClientOriginalExtension();
            $ConsultantImage->move("images/media", $thumbnail);
            $Consultant->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
        }

        if ($Consultant->update()) {

            return redirect()->route('consultation.list')->with(['success' => 'Consultant  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    //DietSubscriptionPlanList

    public function DietSubscriptionPlanList()
    {
        $DietSubscriptionPlanList = DietPlanSubscription::get();
        return view('diet_subscription_plan.list', compact('DietSubscriptionPlanList'));
    }

    public function editDietSubscriptionPlan($id)
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        $data = DietPlanSubscription::with('DietSubscriptionFeatureMap.DietSubscriptionFeature')->where('id', $id)->first();
        $allPlanFeatures = Feature::where(['type'=>Feature::DIET_PLAN,'status'=>1])->get();
        return view('diet_subscription_plan.edit', compact('data', 'status', 'allPlanFeatures'));
    }

    public function viewDietSubscriptionPlan($id)
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        $data = DietPlanSubscription::with('DietSubscriptionFeatureMap.DietSubscriptionFeature')->where('id', $id)->first();
        $allPlanFeatures = Feature::where('status', 1)->get();
        return view('diet_subscription_plan.view', compact('data', 'status', 'allPlanFeatures'));
    }

    public function updateDietSubscriptionPlan(Request $request)
    {
        //dd($request->all());
        $DietPlanSubscription = DietPlanSubscription::where('id', $request->diet_subscription_plan_id)->first();
        $DietPlanSubscription->name = $request->name;
        $DietPlanSubscription->monthly_amount = $request->monthly_amount;
        $DietPlanSubscription->quaterly_amount = $request->quaterly_amount;
        $DietPlanSubscription->yearly_amount = $request->yearly_amount;
        $DietPlanSubscription->description = $request->description;
        $DietPlanSubscription->is_free = isset($request->is_paid) ? 0 : 1;
        $DietPlanSubscription->discount = isset($request->is_paid) ? $request->discount : 0;
        $DietPlanSubscription->status = $request->status;
        if ($request->file("thumbnail")) {
            $DietPlanSubscriptionImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $DietPlanSubscriptionImage->getClientOriginalExtension();
            $DietPlanSubscriptionImage->move("images/media", $thumbnail);
            $DietPlanSubscription->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
        }

        //Update or delete........
        DietSubscriptionFeatureMap::where('diet_plan_subscription_id', $request->diet_subscription_plan_id)->forceDelete();
        if ($request->features_id != "") {
            foreach ($request->features_id as $key => $id) {
                $DietSubscriptionFeatureMap = new DietSubscriptionFeatureMap();
                $DietSubscriptionFeatureMap->diet_plan_subscription_id = $request->diet_subscription_plan_id;
                $DietSubscriptionFeatureMap->feature_id = $id;
                $DietSubscriptionFeatureMap->save();
            }
        }

        if ($DietPlanSubscription->update()) {

            return redirect()->route('diet.subscription.plan.list')->with(['success' => 'Diet Plan Subscription  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }


    // start
 
  public function getHTML(){
    $MonthDurations = DB::table('md_dropdowns')->where('slug', 'plan_month_duration')->get();  
   $result_view = view("diet_subscription_plan.render.get_html",compact('MonthDurations'))->render();
   return json_encode(["html" => $result_view, "status" => true]);
  }

  public function getPricingDetails(Request $request){
      $DietSubscriptionPlanId = $request->id;
      $DietSubPlanSubscriptionMap = DietSubPlanSubscriptionMap::with('diet')->where('diet_plan_subscription_id',$DietSubscriptionPlanId)->get();
      $firstSubPlanId = $DietSubPlanSubscriptionMap[0]['diet']['id'];
      $firstSubPlanName = $DietSubPlanSubscriptionMap[0]['diet']['title']; 
      // dd($DietSubPlanSubscriptionMap[0]['diet']['id']);
      $allSubPricing =  SubscriptionSubPlanPricing::where('diet_id',$firstSubPlanId)->get();
      $MonthDurations = DB::table('md_dropdowns')->where('slug', 'plan_month_duration')->get();
      $result_view = view("diet_subscription_plan.render.get_price_details",compact('MonthDurations','DietSubPlanSubscriptionMap','allSubPricing','firstSubPlanId','firstSubPlanName'))->render();
    return json_encode(["html" => $result_view, "status" => true]);  
  }

  public function getPricingDetailsByDietId(Request $request){
           
           $DietSubscriptionPlanId = $request->id;
           $DietSubPlanSubscriptionMap = DietSubPlanSubscriptionMap::with('diet')->where('diet_plan_subscription_id',$DietSubscriptionPlanId)->get();
           $firstSubPlanId = $request->dietId;
           $firstSubPlanName =Dite::where('id',$firstSubPlanId)->value('title');
      // dd($DietSubPlanSubscriptionMap[0]['diet']['id']);
           $allSubPricing =  SubscriptionSubPlanPricing::where('diet_id',$firstSubPlanId)->get();
           $MonthDurations = DB::table('md_dropdowns')->where('slug', 'plan_month_duration')->get();
           $result_view = view("diet_subscription_plan.render.get_price_details",compact('MonthDurations','DietSubPlanSubscriptionMap','allSubPricing','firstSubPlanId','firstSubPlanName'))->render();
           return json_encode(["html" => $result_view, "status" => true]);
  } 
  
  public function saveSubPlans(Request $request){
           DB::beginTransaction();
           try
           {
             Dite::where('id',$request->diet_id)->update(['title'=>$request->sub_plan]);
             foreach ($request->id as $key => $id) {
                $subPlan = [
                   'diet_id'=> $request->diet_id,
                   'duration' => $request->duration[$key],
                   'amount' => $request->amount[$key],
                   'discount' => $request->discount[$key],
                   'status'=>1,
               ];

                    // Find the existing record by ID, or create a new one
               $subPlanModel = SubscriptionSubPlanPricing::updateOrCreate(
                ['id' => $id],
                $subPlan
            );
           }

           DB::commit();
           return response()->json([
            'success' => 1,
             'message' =>"Diet Sub Plan Updated successfully"
        ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => 0,
                'message' =>'Amount cannot be empty' //$e->getMessage()
            ]);
        }   
  }
// End
  
 public function deleteSubPlan(Request $request){
      SubscriptionSubPlanPricing::where('id',$request->id)->delete();
       return response()->json([
            'success' => 1,
             'message' =>"Diet Sub Plan deleted successfully"
        ]);
 }

//Diet Subscription Feature

//Diet Subscription Feature

public function DietSubscriptionFeatureList(){
    $allFeatures = Feature::get();
    return view('diet_subscription_features.list',compact('allFeatures'));
  }
  
  public function DietSubscriptionFeatureAdd()
  {
      $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      $featurTypes = DB::table('md_dropdowns')->where('slug', 'diet_subscription_feature_type')->get();
      return view('diet_subscription_features.add', compact('status','featurTypes'));
  }
  
  public function DietSubscriptionFeatureSave(Request $request)
  {
      
      if($request->type == 3 && $request->has('is_test')){
            $Feature  = new Feature;
            $Feature->name = $request->description;
            $Feature->type = $request->type;
            $Feature->is_genetic_test =1;
            $Feature->genetic_test_count = $request->genetic_test_count;
            $Feature->other_test_count = $request->other_test_count;
            $Feature->status = $request->status;
            $Feature->save();
  
      }else{
         $Feature = Feature::create($request->all());
      }  
   
      
  
      if ($Feature->wasRecentlyCreated) {
          return redirect()->route('diet.subscription.features.list')->with(['success' => 'Diet subscription feature   has been created successfully!']);
      } else {
          return redirect()->back()->with('warning', 'Something went wrong!');
      }
  }
  
  
  public function viewDietSubscriptionFeature($id)
  {
      $featurTypes = DB::table('md_dropdowns')->where('slug', 'diet_subscription_feature_type')->get();
      $data = Feature::where('id', $id)->first();
      $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      return view('diet_subscription_features.view', compact('status', 'data','featurTypes'));
  }
  
  public function editDietSubscriptionFeature($id)
  {
      $featurTypes = DB::table('md_dropdowns')->where('slug', 'diet_subscription_feature_type')->get();
      $data = Feature::where('id', $id)->first();
      $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      return view('diet_subscription_features.edit', compact('status', 'data','featurTypes'));
  }
  
  public function updateDietSubscriptionFeature(Request $request)
  {  
     // dd($request->all());
  
     
  
  
       if($request->type == 3 && $request->has('is_test')){
            $updateDiteFeature  =Feature::where('id', $request->feature_id)->first();
            $updateDiteFeature->name = $request->description;
            $updateDiteFeature->type = $request->type;
            $updateDiteFeature->is_genetic_test =1;
            $updateDiteFeature->genetic_test_count = $request->genetic_test_count;
            $updateDiteFeature->other_test_count = $request->other_test_count;
            $updateDiteFeature->status = $request->status;
            $updateDiteFeature->save();
  
      }else{
             $updateDiteFeature = Feature::where('id', $request->feature_id)
          ->update([
              'name' => $request->name,
              'type' => $request->type,
              'status' => $request->status,
              'is_genetic_test' => 0,
              'genetic_test_count' => null,
              'other_test_count' => null,
          ]);
      }  
  
      if ($updateDiteFeature) {
         return redirect()->route('diet.subscription.features.list')->with(['success' => 'Diet subscription feature   has been updated successfully!']);
      } else {
          return redirect()->back()->with('warning', 'Something went wrong!');
      }
  
  }

    public function deleteDietSubscriptionFeature(Request $request)
    {

        $findFeature = DietSubscriptionFeatureMap::where('feature_id', $request->id)->first();
        if ($findFeature) {
            $res['success'] = 0;
            $res['message'] = "You cannot delete this record as it's being used.";
            return json_encode($res);
        } else {
            $Feature = Feature::where('id', $request->id)->first();
            $deleteFeature = $Feature->delete();
            if ($deleteFeature) {
                $res['success'] = 1;
                return json_encode($res);
            } else {
                $res['success'] = 0;
                $res['message'] = "Something went wrong! Please try again.";
                return json_encode($res);
            }
        }

    }

    public function DietSubscriptionCheckFeature(Request $request)
    {

        $name = Feature::where("name", $request->name)->get();

        if (count($name) > 0) {
            $res = 1;
            return response()->json(["msg" => $res]);
        } else {
            $res = 0;
            return response()->json(["msg" => $res]);
        }
    }


    // MealTemplateList


    public function MealTemplateList(){
         $mealPlanTemplates = MealPlanTemplate::with('mealPlanTemplateTag.healthComplaint','Nutritionist')->get();
        return view('templates.list', compact('mealPlanTemplates'));
    }


    // YOur Health Guide..........

    public function healthGuideMessageList(){
        $healtGuide = DB::table('md_dropdowns')->where('module', 'your_health_guide_message')->get();
        return view('your_health_guide.list', compact('healtGuide'));
    }

    public function editHealthGuideMessageProvider($id){
       $data = DB::table('md_dropdowns')->where('id', $id)->first();
        return view('your_health_guide.edit', compact('data'));
    }

    public function updateHealthGuideMessage(Request $request){
        $data = DB::table('md_dropdowns')->where('id', $request->healt_guide_id)->update(['value'=>$request->title]);
          return redirect()->route('health_guide_message_list')->with(['success' => ' Message  has been updated successfully!']);
         
    }

    public function viewHealthGuideMessage($id){
       $data = DB::table('md_dropdowns')->where('id', $id)->first();
        return view('your_health_guide.view', compact('data'));
    }


}
