<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDietTestLog extends Model
{
    use HasFactory;

    protected $table = 'user_diet_and_test_logs';

    protected $fillable = ['user_id', 'log_date', 'body_fat_percentage', 'body_fat', 'bmi', 'fasting_blood_sugar', 'random_blood_sugar', 'hba1c', 'cholesterol', 'hdl', 'ldl', 'triglycerides', 'serum_creatinine', 'haemoglobin', 'albumin', 'calcium', 'phosphorous'];

    protected $casts = ['log_date' => 'date'];

    public function updateOrSave()
    {
        UserDietTestLog::whereDate('log_date', now()->parse(request()->log_date)->format('Y-m-d'))
            ->updateOrCreate([
            'user_id' => auth()->id()
            ],
        [
            'body_fat_percentage' => (request()->body_fat_percentage == '') ? null : request()->body_fat_percentage,
            'fasting_blood_sugar' => (request()->fasting_blood_sugar == '') ? null : request()->fasting_blood_sugar,
            'random_blood_sugar' => (request()->random_blood_sugar == '') ? null : request()->random_blood_sugar,
            'serum_creatinine' => (request()->serum_creatinine == '') ? null : request()->serum_creatinine,
            'triglycerides' => (request()->triglycerides == '') ? null : request()->triglycerides,
            'cholesterol' => (request()->cholesterol == '') ? null : request()->cholesterol,
            'haemoglobin' => (request()->haemoglobin == '') ? null : request()->haemoglobin,
            'phosphorous' => (request()->phosphorous == '') ? null : request()->phosphorous,
            'log_date' => (request()->log_date == '') ? null : request()->log_date,
            'body_fat' => (request()->body_fat == '') ? null : request()->body_fat,
            'albumin' => (request()->albumin == '') ? null : request()->albumin,
            'calcium' => (request()->calcium == '') ? null : request()->calcium,
            'hba1c' => (request()->hba1c == '') ? null : request()->hba1c,
            'bmi' => (request()->bmi == '') ? null : request()->bmi,
            'hdl' => (request()->hdl == '') ? null : request()->hdl,
            'ldl' => (request()->ldl == '') ? null : request()->ldl,
        ]);
    }

    public function getLogs()
    {
        return UserDietTestLog::select(config('common.models.user_diet_and_test_logs.column_with_type.'.request()->log_type). " AS value", 'log_date')
        ->whereUserId(auth()->id())
        ->orderBy('log_date', 'ASC')->get();
    }
}
