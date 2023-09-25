<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Jobs\QueuedVerifyEmailJob;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail {
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
		'is_job_alert_enabled'
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
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * @overide
	 * Mark the given user's email as verified.
	 *
	 * @return bool
	*/
	public function markEmailAsVerified() {
		return $this->forceFill([
			'email_verified_at' => $this->freshTimestamp(),
			'is_email_verified' => 1,
		])->save();
	}


	
    public function branch_manager(){
        return $this->belongsTo(BranchManager::class, 'id','user_id');
    }

	/**
	 * Get the social logins for the user.
	// */
	// public function socialLogins() {
	// 	return $this->hasMany(UserSocialLogin::class);
	// }

	// public function sendPasswordResetNotification($token) {
	// 	// Your your own implementation.
	// 	$this->notify(new ResetPasswordNotification($token));
	// }

	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function jobAlert() {
	// 	return $this->hasOne(JobAlert::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function jobHistoryApplications() {
	// 	return $this->hasMany(JobHistoryApplication::class, 'applicant_id', 'id');
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function JobApplications() {
	// 	return $this->hasMany(JobApplication::class, 'applicant_id', 'id');
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function JobBookmarks() {
	// 	return $this->hasMany(BookmarkedJob::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function jobHistoryBookmarks() {
	// 	return $this->hasMany(JobHistoryBookmark::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function jobSearchHistory() {
	// 	return $this->hasMany(JobSearchHistory::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function feedbacks() {
	// 	return $this->hasMany(Feedback::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function jobHistoryViews() {
	// 	return $this->hasMany(JobHistoryView::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function jobViews() {
	// 	return $this->hasMany(JobViewHistory::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function jobReports() {
	// 	return $this->hasMany(JobReport::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function jobViewHistory() {
	// 	return $this->hasMany(JobViewHistory::class);
	// }
	
	// /**
	//  * Job seacrh history for a perticular user.
	// */
	// public function subscriptions() {
	// 	return $this->hasMany(Subscription::class);
	// }

	public function branchManager(){
		return $this->hasOne(BranchManager::class);
	}

   public function orders(){
        return $this->hasMany(Order::class);
    }

 
  
  public function BranchRole(){
        return $this->hasOne(BranchRole::class,'id','branch_role_id');
    }

}
