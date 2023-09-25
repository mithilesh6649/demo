<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MenuItem extends Model
{
    use HasFactory ,SoftDeletes;

    protected $guarded = [];

      public function  menuCategory(){
        return $this->belongsTo(MenuCategory::class,'cat_id')->latest();
    }

     public function  ChoiceGroups(){
        return $this->hasMany(ChoiceGroup::class)->latest();
    }

    public function addDefaultChoices($menuItem){

        $choicegroup = new ChoiceGroup;
        $choicegroup->menu_item_id = $menuItem->id;
        $choicegroup->name_en = 'Your Choice of Taste';
        $choicegroup->name_ar = 'اختيارك من الذوق';
        $choicegroup->mendatory_choice_count = 1;
        $choicegroup->total_choice_count = 1;

        if($choicegroup->save()){
            $name_en = ['Spicy','Non Spicy','Medium Spicy','Less Spicy'];
            $name_ar = ['حار','غير حار','حار وسط','أقل بهارات'];
            $price = ['0','0','0','0'];

            for($i=0;$i<4;$i++)
            {
                Choice::create([
                   'name_en' => $name_en[$i],
                   'name_ar' => $name_ar[$i],
                   'price' => $price[$i],
                   'choice_group_id' => $choicegroup->id,
                ]);
            }
        }
    }

    public function loyalty_item(){
        return $this->belongsTo(LoyaltyItem::class,'id','menu_item_id');
    }

  public function mostselling_item(){
        return $this->belongsTo(MostSellingItem::class,'id','menu_item_id');
    }
}
