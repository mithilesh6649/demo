<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrait extends Model
{
    use HasFactory;

    protected $fillable = ['payment_transaction_id', 'trait_list_id'];

    public function setUserTrait($paymentId)
    {
        if (request()->trait_type == config('common.models.trait_counts.all')) {

            $traitListIds = TraitList::pluck('id')->toArray();

        } else {

            for ($i = 0; $i < count(request()->trait_ids); $i++) {

                $traitListIds[] = request()->trait_ids[$i];
            }
        }

        if (count($traitListIds) != 0) {

            for ($i = 0; $i < count($traitListIds); $i++) {

                $userTraitData[] = [
                    'payment_transaction_id' => $paymentId,
                    'trait_list_id' => $traitListIds[$i]
                ];
            }
        }

        \DB::table('user_traits')->insert($userTraitData);
    }
}
