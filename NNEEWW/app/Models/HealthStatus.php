<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthStatus extends Model
{
    use HasFactory;
    protected $appends = ['address_info', 'height_info', 'weight_info', 'weight_into_kg', 'height_into_cm'];

    public function getAddressInfoAttribute()
    {
        return $this->address . ' ' . $this->city;
    }

    public function getHeightInfoAttribute()
    {
        return $this->height . ' ' . $this->height_unit;
    }

    public function getWeightInfoAttribute()
    {
        return $this->weight . ' ' . $this->weight_unit;
    }

    public function getWeightIntoKgAttribute()
    {
        $weightUnit = $this->weight_unit;
        $weight = $this->weight;

        switch ($weightUnit) {

            case 'kg':
            $weightInKg = $weight;
            break;

            case 'lbs':
            $weightInKg = number_format($weight * 0.453, 2, '.', ',');
            break;

            case 'st':
            $weightInKg = number_format($weight * 6.35, 2, '.', ',');
            break;

            default:
            $weightInKg = $weight;
            break;
        }

        return $weightInKg;

    }

    public function getHeightIntoCmAttribute()
    {
        $height_unit = $this->height_unit;
        $height = $this->height;
        if ($height_unit == "ft/in") {

            $height = explode(".", $height);

            $heightInInch = ($height[0] * 12) + $height[1];
            return $heightInCm = number_format($heightInInch * 2.54, 2, '.', ',');

        } else {

            return $heightInCm = $height;
        }

    }


     public function UserClinicalGoal()
    {
        return $this->hasMany(UserClinicalGoal::class, 'health_statuses_id');
    }

    public function UserNutritionalGoal()
    {
        return $this->hasMany(UserNutritionalGoal::class, 'health_statuses_id');
    }

}
