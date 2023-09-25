<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    public const ACTIVE = '1';

    public function branchManagers()
    {
        return $this->hasMany(BranchManager::class)->orderBy('status');
    }

    public function activebranchManagers()
    {
        return $this->branchManagers()->where('out_sesssion', null);
    }

    public function BranchImages()
    {
        return $this->hasMany(BranchImage::class);
    }

    public function branchMenuItems()
    {
        return $this->hasMany(BranchMenuItem::class);
    }

    public function localities()
    {
        return $this->hasMany(BranchLocality::class, 'branch_id');
    }

    public function CheckoutOfferBranch()
    {
        return $this->hasOne(CheckoutOfferBranch::class);
    }

    public function CouponCodeBranch()
    {
        return $this->hasOne(CheckoutOfferBranch::class);
    }

    public function DiscountBranch()
    {
        return $this->hasOne(DiscountBranch::class);
    }

    public function BranchBigImages()
    {
        return $this->belongsTo(BranchImage::class, 'id', 'branch_id')->where(['image_type'=>'big','deleted_at'=>NULL]);
    }

    public function BranchSmallImages()
    {
        return $this->belongsTo(BranchImage::class, 'id', 'branch_id')->where(['image_type'=>'small','deleted_at'=>NULL]);
    }
}
