<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserReport extends Model
{
    use HasFactory, SoftDeletes;

    public function tests()
    {
        return $this->belongsTo(Test::class);
    }

    public function setUploadedByAttribute( $value ) {

        $this->attributes['uploaded_by'] = auth()->id();

    }

    public function setUploadedByGuardAttribute( $value ) {

        $this->attributes['uploaded_by_guard'] = 'users';

    }

    public function destroyReport()
    {
        UserReport::whereId(request()->report_id)->whereUserId(auth()->id())->first()->delete();
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($report) {
            $report->report_no = "#GHX-REP-$report->id";
            $report->uploaded_by = auth()->id();
            $report->uploaded_by_guard = 'users';
            $report->save();
        });

        UserReport::observe(new \App\Observers\UserReportObserver);
    }
}
