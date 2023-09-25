<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

use Illuminate\Database\Eloquent\SoftDeletes;
class CurrentOfferBranch extends Model
{
    use HasFactory , SoftDeletes;

    public function currentoffer()
    {
        return $this->belongsTo(CurrentOffer::class);
    }

    public static function checkbranch($branch_id)
    {
        $branch=Branch::where('id',$branch_id)->first();
        return @$branch->title_en;

    }
}
