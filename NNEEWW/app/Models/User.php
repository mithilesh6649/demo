<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'ip_address',
        'is_email_verified',
        'login_with',
        'signup_via',
        'is_job_alert_enabled',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    const INACIVE_STATUS = 6;
    const ACTIVE_STATUS = 5; // Id From Statuses table

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'is_email_verified' => 1,
        ])->save();
    }

    public function UserAction()
    {
        return $this->hasOne(UserAction::class)->where(['user_guard' => 'users']);
    }

    public function UserHealthComplaints()
    {
        return $this->hasMany(UserHealthComplaint::class);
    }

    public function HealthStatus()
    {
        return $this->hasOne(HealthStatus::class);
    }

    public function Appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }

    public function UserMetadata()
    {
        return $this->hasOne(UserMetadata::class);
    }

    public function WaterTracker()
    {
        return $this->hasMany(WaterTracker::class);
    }

    public function PulseTracker()
    {
        return $this->hasMany(PulseTracker::class);
    }

    public function StepTracker()
    {
        return $this->hasMany(StepTracker::class);
    }

    public function WeightTracker()
    {
        return $this->hasMany(WeightTracker::class);
    }

    public function UserReport()
    {
        return $this->hasMany(UserReport::class);
    }

    public function MedicineTracker()
    {
        return $this->hasMany(MedicineTracker::class);
    }

    public function ReviewComment()
    {
        return $this->hasMany(ReviewComment::class, 'review_by_id')->where('review_by_guard', 'users');
    }

    public function userPaymentTransaction()
    {
        return $this->hasMany(PaymentTransaction::class)->where('payment_for', 'diet_plans')->whereIn('transaction_status', array('captured', 'success'));
    }

    public function userTestSubscription()
    {
        return $this->hasMany(PaymentTransaction::class)->where('payment_for', 'tests')->whereIn('transaction_status', array('captured', 'success'));
    }

    public function userDietAndTestLog()
    {
        return $this->hasMany(UserDietAndTestLog::class, 'user_id');
    }

       public function UserFoodPreference()
    {
        return $this->hasMany(UserFoodPreference::class);
    }

    //Get Day By Number
    public function GetDayNameByNuber($number)
    {

        switch ($number) {
            case 0:
                return "Sun";
                break;
            case 1:
                return "Mon";
                break;
            case 2:
                return "Tues";
                break;
            case 3:
                return "Wed";
                break;
            case 4:
                return "Thu";
                break;
            case 5:
                return "Fri";
                break;
            case 6:
                return "Sat";
                break;

        }
    }

    public function GetDocType($doc_num)
    {

        switch ($doc_num) {
            case 1:
                return "Health Checkup";
                break;
            case 2:
                return "Test Report";
                break;
            case 3:
                return "Organ Checkup";
                break;
            default:
                return '--';

        }
    }

    // public function schools() {
    //     return $this->hasOne(School::class);
    // }

    // public function courses() {
    //     return $this->hasMany(Course::class);
    // }

    // // added from web
    // public function questions()
    // {
    //     return $this->belongsToMany(Answer::class,'answer_user' ,'user_id','question_id')->withPivot('question_id','answer_text','is_correct','created_at');
    // }
    // // added from web

    // public function studentCourses(){
    //     return $this->hasMany(StudentCourse::class,'student_id');
    // }

    // public function person(){
    //     return $this->hasOne(Person::class,'loggedIn_user_id', 'id');
    // }

    // public function feedback(){
    //     return $this->hasMany(Feedback::class,'user_id');
    // }

    // public function debitCards()
    // {
    //     return $this->hasMany(DebitCards::class ,'userId' ,'id');
    // }

}
