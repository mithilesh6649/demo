<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Events\UserUpdated;
use QrCode, Auth;

use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Interfaces\Customer;

class User extends Authenticatable implements Wallet,Customer
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, HasWallet, CanPay;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'device_type',
        'device_token',
        'voip_token',
        'is_online',
        'notification_enabled',
        'phone_verified',
        'phone_verified_at',
        'gender',
        'terms_and_conditions',
        'device_type',
        'device_token',
        'phone_number',
        'country_code',
        'account_deleted_by',
        'account_deleted_at',
        'account_deleted',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'account_locked_at' => 'datetime',
        'account_deleted_at' => 'datetime',
        'email_verified' => 'boolean',
        'phone_verified' => 'boolean',
        'push_notification' => 'boolean',
        'email_notification' => 'boolean',
        'account_deleted' => 'boolean',
        'account_deleted_by' => 'array',
    ];

    // protected $appends = ['avg_rating','is_blocked','my_rating'];

    public function getAvgRatingAttribute(){
        return $this->ratings->avg('rating');
    }

    public function setPasswordAttribute($password)
    {
        if ( $password !== null & $password !== "" )
        {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function hasCheckedHealthStatus()
    {
        return (auth()->user()->healthStatus == null) ? false : true;
    }

    public function healthStatus()
    {
        return $this->hasOne(HealthStatus::class);
    }

    public function reVerification()
    {
        return $this->hasOne(Reverification::class);
    }

    public function reports()
    {
        return $this->hasMany(UserReport::class);
    }

    public function diet()
    {
        return $this->hasMany(UserDiet::class);
    }

    public function exercise()
    {
        return $this->hasMany(UserExercise::class);
    }

    public function nutrients()
    {
        return $this->hasOne(UserNutrient::class);
    }

    public function comments()
    {
        return $this->hasOne(ReviewComment::class, 'review_by_id', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }

    public function weightTracker()
    {
        return $this->hasMany(WeightTracker::class)->orderBy('created_at', 'ASC');
    }

    public function weightReminder()
    {
        return $this->hasOne(WeightReminder::class);
    }

    public function waterTracker()
    {
        return $this->hasMany(WaterTracker::class)->orderBy('created_at', 'ASC');
    }

    public function metadata()
    {
        return $this->hasOne(UserMetadata::class);
    }

    public function waterReminder()
    {
        return $this->hasOne(WaterReminder::class);
    }

    public function diseases()
    {
        return $this->hasMany(UserHealthComplaint::class)->where('type', 1);
    }

    public function testDietLogsBasedOnDate()
    {
        $date = request()->date ? request()->date : now();

        return $this->hasOne(UserDietTestLog::class)->whereDate('log_date', $date)->orderBy('id', 'DESC');
    }

    public function userProfile()
    {
        $user = auth()->user()->load(['healthStatus','metadata']);
        $userImage = null;

        if ($user->healthStatus) {

            $heightInCm = (int) round(convertHeightIntoCM($user->healthStatus->height_unit, $user->healthStatus->height));

            $gender = (auth()->user()->gender == "male" || "other") ? "male" : "female";
            $idleWeight = ($user->healthStatus) ? config("common.ideal_weight.$heightInCm.$gender") : null;

            $fat = ($user->healthStatus) ? $user->healthStatus->total_fats_per_day : null;
            $carbs = ($user->healthStatus) ? $user->healthStatus->total_carbs_per_day : null;
            $protein = ($user->healthStatus) ? $user->healthStatus->total_protein_per_day : null;

            $recommended_nutrients = [
                    'fat' => $fat,
                    'carbs' => $carbs,
                    'protein' => $protein,
            ];
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'country_code' => ($user->country_code != null) ? '+'.(string)$user->country_code : null,
            'phone_number' => $user->phone_number,
            'gender' => $user->gender,
            'push_notification' => $user->push_notification,
            'email_notification' => $user->email_notification,
            'profile_image' => ($user->healthStatus) ? $user->healthStatus->image : null,
            'height' => ($user->healthStatus) ? $user->healthStatus->height : null,
            'height_unit' => ($user->healthStatus) ? $user->healthStatus->height_unit : null,
            'weight' => ($user->healthStatus) ? $user->healthStatus->weight : null,
            'health_activity' => ($user->healthStatus) ? $user->healthStatus->getHealthActivity($user->healthStatus->health_activity) : null,
            'health_activity_label' => ($user->healthStatus) ? $user->healthStatus->getHealthActivityLabel($user->healthStatus->health_activity) : null,
            'weight_unit' => ($user->healthStatus) ? $user->healthStatus->weight_unit : null,
            'age' => ($user->healthStatus) ? $user->healthStatus->age : null,
            'bio' => ($user->healthStatus) ? $user->healthStatus->bio : null,
            'target_weight' => ($user->healthStatus) ? $user->healthStatus->target_weight : null,
            'target_weight_unit' => ($user->healthStatus) ? $user->healthStatus->target_weight_unit : null,
            'weekly_goals' => ($user->healthStatus) ? $user->healthStatus->getWeeklyGoal($user->healthStatus->weekly_goals) : null,
            'weekly_goals_label' => ($user->healthStatus) ? $user->healthStatus->getWeeklyGoalLabel($user->healthStatus->weekly_goals) : null,
            'address' => ($user->healthStatus) ? $user->healthStatus->address : null,
            'city' => ($user->healthStatus) ? $user->healthStatus->city : null,
            'bmi' => ($user->healthStatus) ? $user->healthStatus->bmi : null,
            'bmi_status' => ($user->healthStatus) ? $user->healthStatus->bmi_status : null,
            'daily_calorie_intake' => ($user->healthStatus) ? $user->healthStatus->daily_calories_intake : null,
            'weight_difference' => ($user->healthStatus) ? $user->healthStatus->weight_difference : null,
            'date_desired_weight_gain_and_loose' => ($user->healthStatus) ? now()->parse($user->healthStatus->target_weight_completion_date)->isoFormat('Do MMMM') : null,
            'idealWeight' => (isset($idleWeight)) ? $idleWeight : null,
            'goal' => ($user->healthStatus) ? ($user->healthStatus->weeklyGoal == null) ? null : $user->healthStatus->weeklyGoal->value : null,
            'glass_count_goal' =>($user->metadata) ? ($user->metadata->water_glass_goal == null) ? null : $user->metadata->water_glass_goal : null,
            'step_goal' => ($user->metadata) ? ($user->metadata->step_goal == null) ? null : $user->metadata->step_goal : null,
            'recommended_nutrients' => (isset($recommended_nutrients)) ? $recommended_nutrients : null,
        ];
    }

    public function medicineTracker()
    {
        return $this->hasMany(MedicineTracker::class);
    }

    public function pulseTracker()
    {
        return $this->hasMany(PulseTracker::class)->orderBy('created_at', 'ASC');
    }

    public function stepTracker()
    {
        return $this->hasMany(StepTracker::class);
    }

    public function stepReminder()
    {
        return $this->hasOne(StepReminder::class);
    }

    public function foodAllergies()
    {
        return $this->hasMany(UserHealthComplaint::class)->where('type', 4);
    }

    public function foodPreferences()
    {
        return $this->hasMany(UserFoodPreference::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notification_to', 'id')->where('notification_to_guard', 'users');
    }
        // public function getIsBlockedAttribute(){
        //     if(Auth::user()){
        //         return BlockedUser::where(['user_id'=>$this->id,'blocked_by'=>Auth::user()->id])->count();
        //     }else{
        //         return 0;
        //     }
        // }

    public function ifHealthDataExists()
    {
        $userHealthStatus = auth()->user()->healthStatus;

        return ($userHealthStatus == null) ? false : (($userHealthStatus->daily_calories_intake == null) ? false : true);
    }

    public static function boot()
    {
        parent::boot();

        User::observe(new \App\Observers\UserObserver);

        static::deleting(function($user) {
            if($user->healthStatus) {
                $user->healthStatus->delete();
            }
        });

        static::deleting(function($user) {
            if($user->reVerification) {
                $user->reVerification->delete();
            }
        });
    }

    public function getIsBlockedAttribute(){
        if(Auth::user()){
            return BlockedUser::where(['user_id'=>$this->id,'blocked_by'=>Auth::user()->id])->count();
        }else{
            return 0;
        }
    }

    public function ratings(){
        return $this->hasMany(UserRating::class,'user_id');
    }

    public function walletContact()
    {
        return $this->hasOne(Contact::class ,'contactUserId' ,'id')
        ->select(['contacts.contact_id','contacts.contactType'])
        ->where('contacts.contactType','moneywallet');
    }

    public function debitCards()
    {
        return $this->hasMany(DebitCards::class ,'userId' ,'id');
    }

    public function person()
    {
        return $this->hasOne(Person::class ,'loggedIn_user_id' ,'id');
    }

    public function diets()
    {
        return $this->hasMany(UserDailyDiet::class);
    }

    public function currentDayDiet($date, $dietPlanId, $dietId = null)
    {
        return $this->hasOne(UserDailyDiet::class)->where(['meal_date' => $date, 'diet_plan_id' => $dietPlanId, 'diet_id' => $dietId]);
    }

    public function favouriteExercises()
    {
        return $this->hasManyThrough(Exercise::class, UserFavouriteExercise::class, 'user_id', 'id', 'id', 'exercise_id');
    }

    public function favouriteFoods()
    {
        return $this->hasMany(UserFavouriteFood::class)->with('food');
    }

    public function getFavouriteFoods()
    {
        return \DB::table('foods')
        ->select('foods.*')
        ->join('user_favourite_foods', 'user_favourite_foods.food_id', '=', 'foods.id')
        ->where('user_favourite_foods.user_id', auth()->id())
        ->get();
    }

    public function exercises()
    {
        return $this->hasMany(UserDailyExercise::class);
    }

    public function currentDayExercise($date)
    {
        return $this->hasOne(UserDailyExercise::class)->where('exercise_date', $date);
    }
        // public function getIsBlockedAttribute(){
        //     if(Auth::user()){
        //         return BlockedUser::where(['user_id'=>$this->id,'blocked_by'=>Auth::user()->id])->count();
        //     }else{
        //         return 0;
        //     }
        // }

    public function recommendedFood($mealType, $search = null)
    {
        return $this->hasManyThrough(Food::class, UserMealRecommendation::class, 'user_id', 'id', 'id', 'food_id')->where('meal_type_id', MdDropdown::where('slug', $mealType)->value('id'));
    }

    public function dietPlan($dietId)
    {
        return $this->hasOne(UserDietPlanSubscription::class)->where('diet_plan_subscription_id', $dietId)->status();
    }

    public function purchasedDietPlan()
    {
        return $this->hasManyThrough(DietPlanSubscription::class, UserDietPlanSubscription::class, 'user_id', 'id', 'id', 'diet_plan_subscription_id')->where('user_diet_plan_subscriptions.status', 1)->orderBy('diet_plan_subscriptions.id', 'ASC')->distinct();
    }

    public function testReports()
    {
        return Test::select('tests.*', 'user_reports.document_url')
        ->join('user_tests', 'user_tests.test_id', 'tests.id')
        ->join('user_reports', 'user_reports.user_test_id', 'user_tests.id')
        ->where(['user_tests.user_id' => auth()->id(), 'user_tests.test_id' => request()->test_id])
        ->orderBy('id', 'DESC')
        ->pluck('document_url')
        ->first();
    }

    public function organReports()
    {
        return Test::select('user_reports.id AS report_id', 'tests.name', 'user_reports.document_url', 'user_reports.created_at AS document_uploaded_at')
        ->join('user_reports', 'user_reports.test_id', 'tests.id')
        ->join('tickets', 'tickets.user_report_id', 'user_reports.id')
        ->where(['user_reports.deleted_at' => null, 'tickets.ticket_owner_id' => auth()->id(), 'tickets.ticket_owner_guard' => config('common.guards.users'), 'tickets.ticket_type' => config('common.models.tickets.ticket_type.report')])
        ->get();
    }

    public function getRecommendedCalorieWithExercise($healthStatus)
    {
        $calorieBurnt = UserDailyExercise::where(['user_id' => auth()->id(), 'exercise_date' => request()->date])->value('total_calorie_burnt');

        if ($calorieBurnt) {

            return $healthStatus->daily_calories_intake + $calorieBurnt;
        }

        return $healthStatus->daily_calories_intake;
    }

    public function specializedDietPlan($allDiets)
    {
        if ($allDiets) {

            return Diet::select('diets.id AS diet_id', 'diets.title AS diet_title', 'diets.amount AS diet_amount', 'diets.description AS diet_description', 'diets.image AS diet_image', 'diet_categories.title AS diet_category_title')
            ->join('diet_categories', 'diet_categories.id', 'diets.diet_category_id')
            ->orderBy('diet_category_title')
            ->get();
        }

        return  UserDietPlanSubscription::select('user_diet_plan_subscriptions.id','diets.id AS diet_id', 'diets.title AS diet_title', 'diets.amount AS diet_amount', 'diets.description AS diet_description', 'diets.image AS diet_image', 'diet_categories.title AS diet_category_title')
        ->join('diets', 'diets.id', 'user_diet_plan_subscriptions.diet_id')
        ->join('diet_categories', 'diet_categories.id', 'diets.diet_category_id')
        ->where(['diet_plan_subscription_id' => config('common.models.diet_plan_subscriptions.specialized_plan_id'),'user_diet_plan_subscriptions.user_id'=>auth()->id(),'user_diet_plan_subscriptions.status'=>1])->orderBy('diet_category_title')->get();


    }

    public function getSpecializedDietId(){
        return UserDietPlanSubscription::where(['diet_plan_subscription_id' => config('common.models.diet_plan_subscriptions.specialized_plan_id'),'user_id'=>auth()->id(),'status'=>1])->pluck('diet_id')->toArray();
    }

    public function listRecommendedFoodByNutrition()
    {
        $search = request()->search;
        $dietId = request()->diet_id;

        return Food::select('foods.*')
        ->join('user_meal_recommendations', 'user_meal_recommendations.food_id', '=', 'foods.id')
        ->join('users', 'users.id', '=', 'user_meal_recommendations.user_id')
        ->join('md_dropdowns', 'md_dropdowns.id', 'user_meal_recommendations.meal_type_id')
        ->when($dietId, function ($qr) use ($dietId) {
            return $qr->where('diet_id', $dietId);
        })
        ->when($search, function ($qr) use ($search) {
            return $qr->where([
                'user_meal_recommendations.meal_type_id' => MdDropdown::where('slug', request()->meal_type)->value('id'),
                'user_meal_recommendations.user_id' => auth()->id(),
                        // 'diet_plan_id' => request()->diet_plan_id
            ])
            ->where('foods.brand_name', 'LIKE', "%$search%")
            ->orWhere('foods.brand_description', 'LIKE', "%$search%");
        })
        ->where([
            'user_meal_recommendations.meal_type_id' => MdDropdown::where('slug', request()->meal_type)->value('id'),
            'user_meal_recommendations.user_id' => auth()->id(),
                    // 'diet_plan_id' => request()->diet_plan_id
        ])
        ->get();
    }

    public function testPurchased()
    {
        return $this->hasManyThrough(Test::class, UserTest::class, 'user_id', 'id', 'id', 'test_id');
    }

    public function selectedFoodAllergiesAndFoodPreferences()
    {
        $ids = \DB::table('health_complaints')
        ->select('health_complaints.name', 'health_complaints.description')
        ->leftJoin('user_health_complaints', 'user_health_complaints.health_complaint_id', '=', 'health_complaints.id')
        ->leftJoin('user_food_preferences', 'user_food_preferences.food_preference_id', '=', 'health_complaints.id')
        ->where('health_complaints.description', '!=', null)
        ->where('user_health_complaints.type', 4)
        ->where('user_health_complaints.user_id', auth()->id())
        ->OrWhere('user_food_preferences.user_id', auth()->id())
        ->get();

        $preferencesKey = $ids->pluck('description')->toArray();
        $preferencesName = $ids->pluck('name')->toArray();

        return [
            'selected_preferences_keys' => (empty($preferencesKey)) ? [] : $preferencesKey,
            'selected_preferences_name' => (empty($preferencesName)) ? [] : $preferencesName
        ];
    }

    public function checkIfFoodIsAdded()
    {
        $foodId = request()->edmam_food_id;

        $foodExists = \DB::table('user_daily_diets')
        ->select('user_diets.*')
        ->join('user_diets', 'user_diets.user_daily_diet_id', '=', 'user_daily_diets.id')
        ->join('foods', 'foods.id', '=', 'user_diets.food_id')
        ->where(['user_daily_diets.user_id' => auth()->id(), 'diet_plan_id' => request()->diet_plan_id, 'diet_id' => request()->diet_id])
        ->whereDate('meal_date', request()->date)
        ->where('user_diets.meal_type_id', MdDropdown::where('slug', request()->meal_type)->value('id'))
        ->where('foods.edmam_food_id', request()->edmam_food_id)
        ->first();

        return $foodExists;
    }

    public function saveRazorPayCustomer($customerData)
    {
        $user = User::find(auth()->id());
        $user->razor_pay_customer_id = $customerData['id'];
        $user->razor_pay_created_at = $customerData['created_at'];
        $user->save();
    }

    public function isTestPurchased($testId)
    {
        return $this->hasOne(UserTest::class)->where('test_id', $testId)->exists();
    }

    public function isPremiumPlanPurchased()
    {
        return UserDietPlanSubscription::where(['user_id'=> auth()->id(), 'status' => 1])->where('diet_plan_subscription_id', '!=', DietPlanSubscription::where('is_free', 1)->value('id'))->exists();
    }

    public function tickets()
    {
        $paginateOffset = (request()->has('page')) ? (request()->page * 10) - 10 : 0;

        return Ticket::where(['ticket_owner_id' => auth()->id(), 'ticket_owner_guard' => config('common.guards.users')])
            ->where('status_id', '!=', \DB::table('statuses')->where('slug', config('common.models.statuses.ticket_closed'))->value('id'))
            ->whereIn('ticket_type', config('common.chat_static_message.ticket_ids'))
            ->orderBy('id', 'DESC')
            ->offset($paginateOffset)
            ->limit(10)
            ->get();
    }
}
