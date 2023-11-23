<?php
namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use DB;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    //Users List
    public function plansList()
    {
        // if (Auth::user()->can('view_subscription_plans'))
        // {
        $plansList = SubscriptionPlan::get();
        $plans = DB::table('md_dropdowns')->where('slug', 'subscription_plan_duration')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    
        return view('subscription_plans/list', compact('plansList', 'plans','status'));
        // }
        // else{
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }

    }

   

    //Add user
    public function addPlan()
    {

        // if (Auth::user()->can('view_subscription_plans'))
        // {

        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        $plans = DB::table('md_dropdowns')->where('slug', 'subscription_plan_duration')->get();
        return view('subscription_plans.add')->with(['status' => $status, 'plans' => $plans]);
        //      }
        //  else{
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    //Save User
    public function savePlan(Request $request)
    {
      // dd($request->all());
        $plan = new SubscriptionPlan();
        $plan->title = $request->plan_name;
        $plan->description = $request->description;
        $plan->monthly_amount = $request->monthly_amount;
        $plan->quarterly_amount = $request->quarterly_amount;
        $plan->annual_amount = $request->annual_amount;
        $plan->status = $request->status;
     
        $plan->save();
        return redirect()
            ->route('subscription-plan.plan_list')
            ->with('success', 'Subscription Plan Added  successfully');

    }

    // View User
    public function viewPlan($id)
    {
        // if (Auth::user()->can('view_subscription_plans'))
        // {
        $subscription_plan = SubscriptionPlan::find($id);

        return view('subscription_plans/view', compact('subscription_plan'));
        //  }else{
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }

    }

    //edit User
    public function editPlan($id)
    {
        // if (Auth::user()->can('edit_subscription_plans'))
        // {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        $plans = DB::table('md_dropdowns')->where('slug', 'subscription_plan_duration')->get();
        $editPlan = SubscriptionPlan::find($id);
        return view('subscription_plans/edit', compact('editPlan', 'plans', 'status'));
        //  }else{
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    //update User
    public function updatePlan(Request $request)
    {
          // return $request->all();
        $plan = SubscriptionPlan::find($request->plan_id);
        if ($plan) {
            $plan->title = $request->plan_name;
            $plan->description = $request->description;
            $plan->monthly_amount = $request->monthly_amount;
            $plan->quarterly_amount = $request->quarterly_amount;
            $plan->annual_amount = $request->annual_amount;
            $plan->status = $request->status;
         
            $plan->save();
            return redirect()
                ->route('subscription-plan.plan_list')
                ->with('success', 'Subscription Plan Updated  successfully');
        } else {
            return redirect()
                ->route('subscription-plan.plan_list')
                ->with('danger', 'Something went wrong');
        }
    }
      
     //Plans Delete
     public function deletePlan(Request $request)
     {
         SubscriptionPlan::find($request->id)
             ->delete();
         return "success";
     }
   

}
