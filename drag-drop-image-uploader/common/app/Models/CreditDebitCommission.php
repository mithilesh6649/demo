<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditDebitCommission extends Model
{
    use HasFactory;
   
    public const bank='bank';
    public const amex='amex';
    public const payment_getway='payment_getway'; 
    public const diner='diner';
    public const k_net='k_net';
    public const visa='visa';
    public const master_card='master_card';
    public const gcc='gcc';
    public const orders='orders';
    public const mm_pay_link='mm_pay_link';

    public static function getcardamount($branch_id,$col)
    {
        $credit=CreditDebitCommission::where('branch_id',$branch_id)->value($col);

        return number_format($credit, 3, '.', '')." %";

    }

     public static function getcardamountcalculate($branch_id,$col)
    {
        $credit=CreditDebitCommission::where('branch_id',$branch_id)->value($col);

        return number_format($credit, 3, '.', '');

    }
    


 
}
