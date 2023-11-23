<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Diet;
use App\Models\Food;
use App\Models\HealthComplaint;
use App\Models\HealthStatus;
use App\Models\User;
use App\Models\Ticket;
use App\Models\UserAction;
use App\Models\UserDailyDiet;
use App\Models\UserDietAndTestLog;
use App\Models\WeightTracker;
use App\Models\Nutritionist;
use App\Models\PaymentTransaction;
use Auth;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    { 
       
        // ..........................
        // return
        //  $UserDailyDiet =  UserDailyDiet::with('userDiet.food','userDiet.mealType')->where('user_id','26')->get();
        //   dd($UserDailyDiet);
        //.............................  
        if (Auth::user()->can('user_management')) {
            //$userId = Role::where('role_type', 'users')->where('tag', 'user')->value('id');
            $userList = User::with('UserAction')->orderBy("id", 'DESC')->get();
            return view('users/index', ['userList' => $userList]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }

    }

    public function addUser(Request $request)
    {

        //Monthly User

        $month_array = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $month_val_data = array("January" => 0, "February" => 0, "March" => 0, "April" => 0, "May" => 0, "June" => 0, "July" => 0, "August" => 0, "September" => 0, "October" => 0, "November" => 0, "December" => 0);

        $now = \Carbon\Carbon::now();
        $today = $now->format('Y-m-d');

        $startOfMonth = $now->startOfMonth('Y-m-d')->format('Y-m-d');
        $endOfMonth = $now->endOfMonth()->format('Y-m-d');

        $monthlycond = User::select(
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name")
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->get()
            ->toArray();

        foreach ($month_val_data as $all_month_name => $all_month_value) {

            //for each real data......

            foreach ($monthlycond as $all_month_name_db => $all_month_value_db) {
                if ($all_month_name == $all_month_value_db['month_name']) {
                    $month_val_data[$all_month_name] = (int) $all_month_value_db['count'];
                }
            }

        }

        //      dd($month_val_data);

        // Monthly User End

        $status = DB::table('statuses')->where(['module_name' => 'Account', 'slug' => 'account_status'])->get();
        $genders = DB::table('md_dropdowns')->where('slug', 'gender')->get();
        return view('users/add', compact('status', 'genders', 'month_val_data'));

    }

    public function saveUser(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        //   $user->role_id = Role::where('role_type', 'users')->where('tag', 'user')->value('id');
        // $user->account_status = $request->status;
        $user->phone_number = $request->phone_number;
        $user->country_code = $request->country_code;
        $user->password = \Hash::make($request->password);
        $user->email_verified = 1;

        if ($user->save()) {
            if ($request->status == User::INACIVE_STATUS) {
                $UserAction = new UserAction();
                $UserAction->user_id = $user->id;
                $UserAction->user_guard = 'users';
                $UserAction->status_id = $request->status;
                $UserAction->action_by = Auth::user()->id;
                $UserAction->action_reason = 'Suspicious User';
                $UserAction->action_time = now();
                $UserAction->save();

            }
            return redirect()
                ->route("user_index")
                ->with("success", "User has been added successfully!");
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }

    }

    public function viewUser($id)
    {
        if (Auth::user()->can('view_user')) {
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            $genders = DB::table('md_dropdowns')->where('slug', 'gender')->get();
            $health_activities = DB::table('md_dropdowns')->where('slug', 'health_activity')->get();
            $health_goal = DB::table('md_dropdowns')->where('slug', 'goal')->get();
            $weekly_goals = DB::table('md_dropdowns')->where('slug', 'weekly_goals')->get();

            $User = User::with(
                ['Appointments.AppointmentMetaData', 'Appointments.Nutritionist.NutritionistSpecialization.Specialization', 'HealthStatus', 'UserMetadata',
                    'WaterTracker' => function ($data) {
                        $data->orderBy('created_at', 'DESC');
                    },
                    'PulseTracker' => function ($data) {
                        $data->orderBy('created_at', 'DESC');
                    },
                    'StepTracker' => function ($data) {
                        $data->orderBy('created_at', 'DESC');
                    }
                    , 'WeightTracker' => function ($data) {
                        $data->orderBy('created_at', 'DESC');
                    }, 'UserReport' => function ($data) {
                        $data->orderBy('created_at', 'DESC');
                    }, 'UserReport.TestType', 'MedicineTracker.MedicineType', 'MedicineTracker.MedicineServing', 'MedicineTracker.MedicineScheduler', 'MedicineTracker.MedicineReminder', 'ReviewComment.ReviewToNutritionst.ReviewNutritionstDetails', 'userPaymentTransaction.dietPlanSubscription','userPaymentTransaction.userDietPlanSubscription','userPaymentTransaction.paymentTransactionItem', 'userTestSubscription.UserTest.test','userDietAndTestLog'])->where('id', $id)->first();
           //dd($User); // userDietPlanSubscription
            // ...................

            $maritalstatus = DB::table('md_dropdowns')->where('slug', 'marital_status')->get();
            $bowel_movements = DB::table('md_dropdowns')->where('module', 'bowel_movements')->get();
            $sleep_quality = DB::table('md_dropdowns')->where('slug', 'sleep_quality')->get();
            $health_activity = DB::table('md_dropdowns')->where(['slug' => 'health_activity', 'module' => 'health_status'])->get();

            $eating_patterns = DB::table('md_dropdowns')->where(['slug' => 'eating_pattern', 'module' => 'eating_pattern'])->get();

            //Get All AllDiseases

            $AllDiseases = HealthComplaint::where(['types' => HealthComplaint::DISEASE, 'status' => HealthComplaint::ACTIVE_STATUS])->OrderBy('name', 'ASC')->get();

            //Get All Diets......
            $AllDiets = Diet::where(['status' => HealthComplaint::ACTIVE_STATUS])->OrderBy('title', 'ASC')->get();
            //Get All Foods....

            $AllFoods = Food::where('brand_name', '!=', '')->OrderBy('brand_name', 'ASC')->get();

            $AllAllergies = HealthComplaint::where(['types' => HealthComplaint::FOODALLERGY, 'status' => HealthComplaint::ACTIVE_STATUS])->OrderBy('name', 'ASC')->get(); 

            $userhealthcomplaintids = $User->UserHealthComplaints->pluck('health_complaint_id')->toArray();
            $eating_patterns = DB::table('md_dropdowns')->where(['slug' => 'eating_pattern', 'module' => 'eating_pattern'])->get();


            $AllFoodPerfrences = HealthComplaint::where(['types' => HealthComplaint::FOOD_PREFERENCES, 'status' =>HealthComplaint::ACTIVE_STATUS])->OrderBy('name', 'ASC')->get();
            $userfoodperfrencesids = $User->UserFoodPreference->pluck('food_preference_id')->toArray();
        

            //get Action Plan Gain,Maintain etc....
            $action_plans = DB::table('md_dropdowns')->where(['slug' => 'goal', 'module' => 'health_status'])->get();

            $healthStatusdata = [];
            $nutritionalGoals = [];
            $check_health_status_data = $User->healthStatus;
            if ($check_health_status_data != null) {
                $healthStatusdata = $User->healthStatus->UserClinicalGoal;
                $nutritionalGoals = $User->healthStatus->UserNutritionalGoal;
            }
            //  ...................

            // getTickets

            $allTickets =  Ticket::where(['ticket_owner_id'=>$id])->get();

            $allReportsTickets = Ticket::where(['ticket_owner_id'=>$id])->whereIn('ticket_type',[1,6])->get();
            $allSupportTickets = Ticket::where(['ticket_owner_id'=>$id])->where('ticket_type',2)->get();
            $allConsultationTickets = Ticket::where(['ticket_owner_id'=>$id])->where('ticket_type',4)->get();
            $allDnaTestSupportTickets = Ticket::where(['ticket_owner_id'=>$id])->where('ticket_type',7)->get();
            $allChronicDiseaseSupportTickets = Ticket::where(['ticket_owner_id'=>$id])->where('ticket_type',8)->get();
            $allWeightLossSupportTickets = Ticket::where(['ticket_owner_id'=>$id])->where('ticket_type',9)->get();
            $allDietPlanSupportTickets = Ticket::where(['ticket_owner_id'=>$id])->where('ticket_type',10)->get();
            $allTalkToGenahealthxTickets = Ticket::where(['ticket_owner_id'=>$id])->where('ticket_type',11)->get();
            $allOtherSupportTickets = Ticket::where(['ticket_owner_id'=>$id])->where('ticket_type',12)->get();
            $userWeightGraph = WeightTracker::select(DB::raw('DATE_FORMAT(created_at, "%d-%b") as date'), 'weight AS value')->where('user_id', $id)->whereDate('created_at', '>=', now()->subMonth())->orderBy('created_at', 'ASC')->get()->toArray();
            
            // endgetTickets

            // User Diets.......
              $UserDailyDiet =  UserDailyDiet::with('userDiet.food','userDiet.mealType')->where(['user_id'=>$id,'diet_plan_id'=>1])->get();
           // dd($UserDailyDiet);
            // End User Diets.......

            // return view('users/view', compact('status', 'genders', 'User', 'health_activities', 'health_goal', 'weekly_goals'));

            return view('users/view', compact('status', 'genders', 'User', 'health_activities', 'health_goal', 'weekly_goals', 'maritalstatus', 'bowel_movements', 'sleep_quality', 'health_activity', 'AllDiseases', 'AllDiets', 'AllFoods', 'AllAllergies', 'userhealthcomplaintids', 'eating_patterns', 'action_plans', 'healthStatusdata', 'nutritionalGoals','allTickets','allReportsTickets','allSupportTickets','allConsultationTickets','allDnaTestSupportTickets','allChronicDiseaseSupportTickets','allWeightLossSupportTickets','allDietPlanSupportTickets','allTalkToGenahealthxTickets','allOtherSupportTickets','userWeightGraph','UserDailyDiet','AllFoodPerfrences','userfoodperfrencesids'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }

    }


    public function getPlanDetails(Request $request){
          $planDetails =  PaymentTransaction::with(['dietPlanSubscription','userDietPlanSubscription','paymentTransactionItem','UserTest.test','UserTrait.trait'])->where('id',$request->transaction_id)->first();
          //dd($planDetails);

           $result_view = view('users.partials.user_plan_detail_partial',compact('planDetails'))->render();
        return json_encode(['html' => $result_view, 'status' => true]);
          
    }

    public function filterDietPlan(Request $request){
         $UserDailyDiet =  UserDailyDiet::with('userDiet.food','userDiet.mealType')->where(['user_id'=>$request->user_id,'diet_plan_id'=>$request->dietPlanId])->get();

        $result_view = view("users.partials.diet_plan_partial", [
            "UserDailyDiet" => $UserDailyDiet,
        ])->render(); 

        return json_encode(["html" => $result_view, "status" => true]);
    }


    public function viewUserTickets($id){
       
       $ticketDetails = Ticket::with('user')->orderByDesc('id')->where('id', $id)->first();
        $ticketInfo = Ticket::getTicketsMessage($id);

        $activeNutiritionist = Nutritionist::ACTIVE_NUTRITIONIST();    
        // $allTickets =  Ticket::where(['ticket_owner_id'=>$userId,'ticket_type'=>$id])->get();
        // $title = Ticket::getTicketTitle($id);
        // $ticketView = view('users.partials.ticket_partial', compact('allTickets'))->render(); 
        
         //return view('users.tickets',compact('allTickets','title','ticketView'));
      return view('users.tickets', ['ticket' => $ticketDetails, 'nutiritionists' => $activeNutiritionist,'ticketInfo'=>$ticketInfo]);
    }
  
     

    public function editUser($id)
    {
        if (Auth::user()->can('view_user')) {
            $status = DB::table('statuses')->where(['module_name' => 'Account', 'slug' => 'account_status'])->get();
            // $genders = DB::table('md_dropdowns')->where('slug', 'gender')->get();
            // $User = User::with('UserAction')->where('id', $id)->first();
            // return view('users/edit', compact('status', 'genders', 'User'));

            // $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            $genders = DB::table('md_dropdowns')->where('slug', 'gender')->get();
            $health_activities = DB::table('md_dropdowns')->where('slug', 'health_activity')->get();
            $health_goal = DB::table('md_dropdowns')->where('slug', 'goal')->get();
            $weekly_goals = DB::table('md_dropdowns')->where('slug', 'weekly_goals')->get();
            $User = User::with(
                ['Appointments.AppointmentMetaData', 'Appointments.Nutritionist.NutritionistSpecialization.Specialization', 'HealthStatus', 'UserMetadata',
                    'WaterTracker' => function ($data) {
                        $data->orderBy('created_at', 'DESC');
                    }
                    , 'WeightTracker' => function ($data) {
                        $data->orderBy('created_at', 'DESC');
                    }, 'UserReport' => function ($data) {
                        $data->orderBy('created_at', 'DESC');
                    }, 'UserReport.TestType', 'MedicineTracker.MedicineType', 'MedicineTracker.MedicineServing', 'MedicineTracker.MedicineScheduler', 'MedicineTracker.MedicineReminder', 'ReviewComment.ReviewToNutritionst.ReviewNutritionstDetails'])->where('id', $id)->first();
            return view('users/edit', compact('status', 'genders', 'User', 'health_activities', 'health_goal', 'weekly_goals'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function updateUser(Request $request)
    {
        // /dd($request->all());
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->country_code = $request->country_code;
        //$user->account_status = $request->status;
        if ($request->password) {
            $user->password = \Hash::make($request->password);
        }

        if ($user->save()) {

            $findUser = UserAction::where(['user_id' => $request->id, 'user_guard' => 'users'])->first();
            if ($request->status == User::ACTIVE_STATUS) {
                if ($findUser) {
                    $findUser->delete();
                }
            }

            if ($request->status == User::INACIVE_STATUS) {
                if (!$findUser) {
                    $UserAction = new UserAction();
                    $UserAction->user_id = $user->id;
                    $UserAction->user_guard = 'users';
                    $UserAction->status_id = $request->status;
                    $UserAction->action_by = Auth::user()->id;
                    $UserAction->action_reason = 'Suspicious User';
                    $UserAction->action_time = now();
                    $UserAction->save();
                }
            }

            //Update Health Status...
            $healthStatus = HealthStatus::where('user_id', $request->id)->first();

            if ($healthStatus) {
                //return "yes";
                $healthStatus->address = $request->address;
                $healthStatus->bio = $request->bio;
                if ($request->file("image")) {
                    $UserImage = $request->file("image");
                    $image = time() . "." . $UserImage->getClientOriginalExtension();
                    $UserImage->move("images/user", $image);
                    $healthStatus->image = env('IMAGE_BASE_URL') . '/images/user/' . $image;

                }
                $healthStatus->save();

            } else {
                //  return "no";
                $healthStatusNew = new HealthStatus();
                $healthStatusNew->user_id = $request->id;
                $healthStatusNew->address = $request->address;
                $healthStatusNew->bio = $request->bio;
                if ($request->file("image")) {
                    $UserImage = $request->file("image");
                    $image = time() . "." . $UserImage->getClientOriginalExtension();
                    $UserImage->move("images/user", $image);
                    $healthStatusNew->image = env('IMAGE_BASE_URL') . '/images/user/' . $image;

                }
                $healthStatusNew->save();
            }

            return redirect()
                ->route("user_index")
                ->with([
                    "success" =>
                    "User details has been updated successfully!",
                ]);
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }

    }

    public function deleteUser(Request $request)
    {
        $User = User::where('id', $request->id)->delete();
        if ($User) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

    public function checkUserEmail(Request $request)
    {
        $email = User::withTrashed()->where("email", $request->email)->get();

        if (count($email) > 0) {
            $res = 1;
            return response()->json(["msg" => $res]);
        } else {
            $res = 0;
            return response()->json(["msg" => $res]);
        }
    }

    public function deleteUserProfilePicture(Request $request)
    {

        // dd($request->all());

        $UserDetails = HealthStatus::where(
            'id',
            $request->manager_id
        )->first();

        if ($UserDetails) {
            $UserDetails->image = null;
            if ($UserDetails->save()) {
                return response()->json(['status' => 'true', 'success' => 1]);
            } else {
                return response()->json(['status' => 'true', 'success' => 0]);
            }
        } else {
            return response()->json(['status' => 'true', 'success' => 0]);
        }

    }


     public function graphData()
    {
        $graphData = [];

        switch (request()->log_type) {

            case "weight_log":

                $graphData =WeightTracker::select(DB::raw('DATE_FORMAT(created_at, "%d-%b") as date'), 'weight AS value')->where('user_id', request()->user_id)->whereDate('created_at', '>=', now()->subMonth())->orderBy('created_at', 'ASC')->get()->toArray();

                break;

            default:
                $graphData = UserDietAndTestLog::select(DB::raw('DATE_FORMAT(log_date, "%d-%b") as date'), request()->log_type .' AS value' )->where('user_id', request()->user_id)->whereDate('created_at', '>=', now()->subMonth())->orderBy('created_at', 'ASC')->get()->toArray();
                break;
        }

        return response()->json(['status' => 200, 'data' => $graphData, 'error' => false]);
        // return
    }

}
