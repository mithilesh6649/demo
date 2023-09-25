<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\GiftCardsType;
class GiftCard extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    // protected $appends=['giftamount'];
    
    // public function getGiftamountAttribute()
    // {
    //      $data=GiftCardsType::where('id',$this->gift_cards_type_id)->first();
    //     if($data)
    //     {
    //         return $data->name; 
    //     }else{
    //         return 0;
    //     }
    // }
}
