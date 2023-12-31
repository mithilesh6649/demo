<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
	protected $fillable = [ 'title', 'section', 'status', 'view', 'content','support_number','whats_app_number','address','email' ];

	   public function getBannerAttribute($value)
    {
        return 'CMS/banner/'.$value;
    }
}
