<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CheckoutOfferItem;
use App\Models\Branch;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckoutOffer extends Model
{
    use HasFactory, SoftDeletes;

    public function CheckoutOfferBranch()
    {
        return $this->hasMany(CheckoutOfferBranch::class);
    }

    public function CheckoutOfferItem()
    {
        return $this->hasMany(CheckoutOfferItem::class);
    }

    public static function checkedcategory($offer_id, $cat_id)
    {
        $count = CheckoutOfferItem::where(['checkout_offer_id' => $offer_id, 'menu_category_id' => $cat_id])->count();
        $cat_menucount = MenuItem::where('cat_id', $cat_id)->count();
        if ($count == $cat_menucount)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public static function checkedmenuitem($offer_id, $menuitem)
    {
        $count = CheckoutOfferItem::where(['checkout_offer_id' => $offer_id, 'menu_item_id' => $menuitem])->count();

        if ($count > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public static function checksinglebranch($branch_id, $offer_id)
    {
        $branch = CheckoutOfferBranch::where(['checkout_offer_id' => $offer_id, 'branch_id' => $branch_id])->count();
        if ($branch > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public static function checkallbranch($offer_id)
    {
        $check_branch = CheckoutOfferBranch::where('checkout_offer_id', $offer_id)->count();
        $data = Branch::count();
        if ($data == $check_branch)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

}

