<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardsType extends Model
{
    use HasFactory;
     public static function getgiftamount($id)
     {
        $data=GiftCardsType::where('id',$id)->first();
        if($data)
        {
            return $data->name;
        }else{
            return 0;
        }
     }
}
