<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BranchLocality;

class City extends Model
{
    use HasFactory,SoftDeletes;

  protected  $fillable = [
                'city' => 'city',
                'city_ar' => 'city_ar'
   ];
 


    public function catring(){
        return $this->hasOne(Catring::class);
    }

   public function cityBranch(){
        return $this->hasOne(BranchLocality::class);
    }

    public function CityBlock(){
        return $this->hasMany(CityBlock::class);
    }

    public static function selectcity($branch_id,$city_id)
    {
         $city=BranchLocality::where(['branch_id'=>$branch_id,'city_id'=>$city_id])->get()->count();
         
        if($city>0)
        {
            return 1;
        }else
        {
            return 0;
        }
    }


}
