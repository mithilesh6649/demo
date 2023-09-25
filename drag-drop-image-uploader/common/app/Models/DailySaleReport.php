<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CreditDebitCommission;
use App\Models\Branch;
class DailySaleReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected $table = 'daily_sales_reports';

    protected $appends = ['amex2', 'cheque2', 'printed_gift_card2', 'e_gift_card2', 'gift_coupon_voucher2', 'cash_equivalent2', 'talabat_credit_TMP2', 'deliveroo_credit_TGO_TMP2', 'v_thru_credit_tgo_tmp2', 'others_credit_tgo_tmp2', 'visa2', 'master2', 'dinner2', 'knet2', 'mm_online_link2', 'others', 'talabat_credit_total', 'deliveroo_total', 'v_thru_credit_total', 'e_gift_card_total', 'verified_by', 'approved_by','demo'];

    public const AMEX = 'amex2';
    public const CHEQUE = 'cheque2';
    public const PRINTED_GIFT_CARD = "printed_gift_card2";
    public const E_GIFT_CARD = "e_gift_card2";
    public const GIFT_COUPON_VOUCHER = 'gift_coupon_voucher2';
    public const CASH_EQUIVALENT = 'cash_equivalent2';
    public const TALABAT_CREDIT_TMP = 'talabat_credit_TMP2';
    public const DELIVEROO_CREDIT_TGO_TMP = 'deliveroo_credit_TGO_TMP2';
    public const V_THRU_CREDIT_TGO_TMP = 'v_thru_credit_tgo_tmp2';
    public const OTHERS_CREDIT_TGO_TMP = 'others_credit_tgo_tmp2';

    public const VISA = 'visa2';
    public const MASTER = 'master2';
    public const DINNER = 'dinner2';
    public const KNET = 'knet2';
    public const PAYMENT_GATEWAY = 'mm_online_link2';
    public const MONTH_TOTAL = 'month_total2';
    public const OTHERS = 'others';
    public const OTHER_CARD = 'other_cards2';


    public function getDemoAttribute(){
       // $value = str_replace(str_split('[]"'), ' ', $this->net_sale);
       // return array_sum(explode(',', $value));
        $value1 = str_replace(str_split('[]"'), ' ', $this->e_gift_card);
        $value2 = str_replace(str_split('[]"'), ' ', $this->printed_gift_card);
        return array_sum(explode(',', $value1)) + array_sum(explode(',', $value2));
    }

    public function getVerifiedByAttribute()
    {
        // $base_path = url('/').'/signatures/';
        $base_path = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
        $signature = Signature::where([
            'parent_id' => $this->id,
            'parent_type' => Signature::DAILY_SALE_REPORT,
            'signature_type' => Signature::VERIFIED_BY,
        ])->first();

        if ($signature) {
            return $base_path . '/' . $signature['signature'];
        } else {
            return null;
        }
    }

    public function getApprovedByAttribute()
    {
        // $base_path = url('/').'/signatures/';
        $base_path = env('PATH_TO_UPLOAD_DSR_SIGNATURES');
        $signature = Signature::where([
            'parent_id' => $this->id,
            'parent_type' => Signature::DAILY_SALE_REPORT,
            'signature_type' => Signature::APPROVED_BY,
        ])->first();

        if ($signature) {
            return $base_path . '/' . $signature['signature'];
        } else {
            return null;
        }
    }

    public function getAmex2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->amex);
        return array_sum(explode(',', $value));
    }

    public function getCheque2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->cheque);
        return array_sum(explode(',', $value));
    }

    public function getPrintedGiftCard2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->printed_gift_card);
        return array_sum(explode(',', $value));
    }

    public function getEGiftCard2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->e_gift_card);
        return array_sum(explode(',', $value));
    }

    public function getGiftCouponVoucher2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->gift_coupon_voucher);
        return array_sum(explode(',', $value));
    }

    public function getCashEquivalent2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->cash_equivalent);
        return array_sum(explode(',', $value));
    }

    public function getTalabatCreditTMP2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->talabat_credit_TMP);
        $value = array_sum(explode(',', $value));

        $value2 = str_replace(str_split('[]"'), ' ', $this->talabat_credit_TGO);
        $value2 = array_sum(explode(',', $value2));

        return $value + $value2;

    }

    public function getDeliverooCreditTGOTMP2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->deliveroo_credit_TMP);
        $value = array_sum(explode(',', $value));

        $value2 = str_replace(str_split('[]"'), ' ', $this->deliveroo_credit_TGO);
        $value2 = array_sum(explode(',', $value2));

        return $value + $value2;

    }

    public function getVThruCreditTgoTmp2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->v_thru_credit_TMP);
        $value = array_sum(explode(',', $value));

        $value2 = str_replace(str_split('[]"'), ' ', $this->v_thru_credit_TGO);
        $value2 = array_sum(explode(',', $value2));

        return $value + $value2;

    }

    public function getOthersCreditTgoTmp2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->others_credit_TMP);
        $value = array_sum(explode(',', $value));

        $value2 = str_replace(str_split('[]"'), ' ', $this->others_credit_TGO);
        $value2 = array_sum(explode(',', $value2));

        return $value + $value2;

    }

    public function getVisa2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->visa);
        return array_sum(explode(',', $value));
    }

    public function getMaster2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->master);
        return array_sum(explode(',', $value));
    }

    public function getDinner2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->dinner);
        return array_sum(explode(',', $value));
    }

    public function getKnet2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->knet);
        return array_sum(explode(',', $value));
    }

    public function getMmOnlineLink2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->mm_online_link);
        return array_sum(explode(',', $value));
    }

    public function getOthersAttribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->other_cards);
        return array_sum(explode(',', $value));
    }

    public function getOtherCards2Attribute()
    {
        $value = str_replace(str_split('[]"'), ' ', $this->other_cards);
        return array_sum(explode(',', $value));
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public static function getTotalAmexPay($branch_id, $date)
    {

        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();

        return $data->sum(Self::AMEX) == 0 ? '-' : number_format((float) $data->sum(Self::AMEX), 3, '.', '');
    }

    public static function getTotalchequePay($branch_id, $date)
    {

        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();

        return number_format((float) $data->sum(Self::CHEQUE), 3, '.', '');
    }

    public static function getTotalVisaaPay($branch_id, $date)
    {

        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return $data->sum(Self::VISA) == 0 ? '-' : number_format((float) $data->sum(Self::VISA), 3, '.', '');
    }

    public static function getTotalMastersPay($branch_id, $date)
    {

        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return $data->sum(Self::MASTER) == 0 ? '-' : number_format((float) $data->sum(Self::MASTER), 3, '.', '');
    }

    public static function getTotalDinnerPay($branch_id, $date)
    {

        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return $data->sum(Self::DINNER) == 0 ? '-' : number_format((float) $data->sum(Self::DINNER), 3, '.', '');
    }

    public static function getTotalPaymentGetwaysPay($branch_id, $date)
    {

        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return $data->sum(Self::PAYMENT_GATEWAY) == 0 ? '-' : number_format((float) $data->sum(Self::PAYMENT_GATEWAY), 3, '.', '');
    }

    public static function getTotalKnetsPay($branch_id, $date)
    {

        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return $data->sum(Self::KNET) == 0 ? '-' : number_format((float) $data->sum(Self::KNET), 3, '.', '');
    }

    public static function getOthercardsPay($branch_id, $date)
    {

        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return $data->sum(Self::OTHER_CARD) == 0 ? '-' : number_format((float) $data->sum(Self::OTHER_CARD), 3, '.', '');
    }

    public static function getTotalPrintedGiftCardPay($branch_id, $date)
    {
        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return number_format((float) $data->sum(Self::PRINTED_GIFT_CARD), 3, '.', '');
    }

    public static function getTotalEGoftCardPay($branch_id, $date)
    {
        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return number_format((float) $data->sum(Self::E_GIFT_CARD), 3, '.', '');
    }

    public static function getTotalGiftCouponVoucherPay($branch_id, $date)
    {
        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return number_format((float) $data->sum(Self::GIFT_COUPON_VOUCHER), 3, '.', '');
    }

    public static function getTotalCashEquivalentPay($branch_id, $date)
    {
        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return number_format((float) $data->sum(Self::CASH_EQUIVALENT), 3, '.', '');
    }

    public static function getTotalCashTalabatCreditTmpTgoPay($branch_id, $date)
    {
        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return number_format((float) $data->sum(Self::TALABAT_CREDIT_TMP), 3, '.', '');
    }

    public static function getTotalCashDeliverooCreditTmpTgoPay($branch_id, $date)
    {
        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return number_format((float) $data->sum(Self::DELIVEROO_CREDIT_TGO_TMP), 3, '.', '');
    }

    public static function getTotalCashVThruCreditTmpTgoPay($branch_id, $date)
    {
        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return number_format((float) $data->sum(Self::V_THRU_CREDIT_TGO_TMP), 3, '.', '');
    }

    public static function getTotalCashOthersThruCreditTmpTgoPay($branch_id, $date)
    {
        $data = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', date('Y-m-d', strtotime($date)))->get();
        return number_format((float) $data->sum(Self::OTHERS_CREDIT_TGO_TMP), 3, '.', '');
    }

    public function getTalabatCreditTotalAttribute($value)
    {
        $value1 = str_replace(str_split('[]"'), ' ', $this->talabat_credit_TMP);
        $value2 = str_replace(str_split('[]"'), ' ', $this->talabat_credit_TGO);
        return array_sum(explode(',', $value1)) + array_sum(explode(',', $value2));
    }

    public function getDeliverooTotalAttribute()
    {
        $value1 = str_replace(str_split('[]"'), ' ', $this->deliveroo_credit_TMP);
        $value2 = str_replace(str_split('[]"'), ' ', $this->deliveroo_credit_TGO);
        return array_sum(explode(',', $value1)) + array_sum(explode(',', $value2));
    }

    public function getVThruCreditTotalAttribute()
    {
        $value1 = str_replace(str_split('[]"'), ' ', $this->v_thru_credit_TMP);
        $value2 = str_replace(str_split('[]"'), ' ', $this->v_thru_credit_TGO);
        return array_sum(explode(',', $value1)) + array_sum(explode(',', $value2));
    }

    public function getEGiftCardTotalAttribute()
    {
        $value1 = str_replace(str_split('[]"'), ' ', $this->e_gift_card);
        $value2 = str_replace(str_split('[]"'), ' ', $this->printed_gift_card);
        return array_sum(explode(',', $value1)) + array_sum(explode(',', $value2));
    }

    public static function getAmexReport($branch_id, $date, $column)
    {

        $reports = DailySaleReport::where('branch_id', $branch_id)->whereDate('report_date', $date)->get();

        if ($column == Self::MONTH_TOTAL) {
        
            $amount_all = (double) $reports->sum(Self::AMEX) +(double) $reports->sum(Self::KNET) + (double) $reports->sum(Self::VISA) + (double) $reports->sum(Self::MASTER) + (double) $reports->sum(Self::DINNER) + (double) $reports->sum(Self::PAYMENT_GATEWAY);

            $commission_all = (((double) $reports->sum(Self::AMEX) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex))/100)+(((double) $reports->sum(Self::KNET) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net))/100)+(((double) $reports->sum(Self::VISA) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa))/100)+(((double) $reports->sum(Self::MASTER) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card))/100)+(((double) $reports->sum(Self::DINNER) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner))/100)+(((double) $reports->sum(Self::PAYMENT_GATEWAY) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway))/100);


            $amount = $amount_all;

            $commission = $commission_all;
            $after_amount = $amount - $commission;


        }else if ($column == Self::AMEX) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::KNET) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::VISA) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::MASTER) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::DINNER) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::PAYMENT_GATEWAY) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway))/100;
            $after_amount = $amount - $commission;
        }


        return '<td>' . ($amount == 0 ? '-' : number_format($amount, 3)) . '</td>
<td>' . ($commission == 0 ? '-' : number_format($commission, 3)) . '</td>
<td>' . ($after_amount == 0 ? '-' : number_format($after_amount, 3)) . '</td>';

    }

    public static function getReportByBranch($branch_id, $month, $year, $column)
    {

        // $month++;
        $reports = DailySaleReport::where('branch_id', $branch_id)->whereMonth('report_date', $month)->whereYear('report_date', $year)->get();

        //dd($column);
        if ($column == Self::MONTH_TOTAL) {

            $amount_all = (double) $reports->sum(Self::AMEX) +(double) $reports->sum(Self::KNET) + (double) $reports->sum(Self::VISA) + (double) $reports->sum(Self::MASTER) + (double) $reports->sum(Self::DINNER) + (double) $reports->sum(Self::PAYMENT_GATEWAY);

            $commission_all = (((double) $reports->sum(Self::AMEX) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex))/100)+(((double) $reports->sum(Self::KNET) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net))/100)+(((double) $reports->sum(Self::VISA) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa))/100)+(((double) $reports->sum(Self::MASTER) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card))/100)+(((double) $reports->sum(Self::DINNER) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner))/100)+(((double) $reports->sum(Self::PAYMENT_GATEWAY) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway))/100);


            $amount = $amount_all;

            $commission = $commission_all;
            $after_amount = $amount - $commission;
            
        } else if ($column == Self::AMEX) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::KNET) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::VISA) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::MASTER) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::DINNER) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner))/100;
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::PAYMENT_GATEWAY) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway))/100;
            $after_amount = $amount - $commission;
        }

        return '<td>' . ($amount == 0 ? '-' : number_format($amount, 3)) . '</td>
        <td>' . ($commission == 0 ? '-' : number_format($commission, 3)) . '</td>
        <td>' . ($after_amount == 0 ? '-' : number_format($after_amount, 3)) . '</td>';
    }

    public static function getReportByMonth($branch_id, $month, $year, $column)
    {

        $reports = DailySaleReport::where('branch_id', $branch_id)->whereMonth('report_date', $month)->whereYear('report_date', $year)->get();

        if ($column == Self::MONTH_TOTAL) {

             $amount_all = (double) $reports->sum(Self::AMEX) +(double) $reports->sum(Self::KNET) + (double) $reports->sum(Self::VISA) + (double) $reports->sum(Self::MASTER) + (double) $reports->sum(Self::DINNER) + (double) $reports->sum(Self::PAYMENT_GATEWAY);

            $commission_all = (((double) $reports->sum(Self::AMEX) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex))/100)+(((double) $reports->sum(Self::KNET) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net))/100)+(((double) $reports->sum(Self::VISA) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa))/100)+(((double) $reports->sum(Self::MASTER) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card))/100)+(((double) $reports->sum(Self::DINNER) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner))/100)+(((double) $reports->sum(Self::PAYMENT_GATEWAY) * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway))/100);


            // $precentage=CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex)+CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa)+CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card)+CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner)+CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway)+CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net);


            $amount = $amount_all;

            $commission = $commission_all;
            $after_amount = $amount - $commission;
           

        } else if ($column == Self::AMEX) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex))/100;
            $precentage=CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex);
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::KNET) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net))/100;
            $precentage=CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net);
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::VISA) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa))/100;
            $precentage=CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa);
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::MASTER) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card))/100;
            $precentage=CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card);
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::DINNER) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner))/100;
            $precentage=CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner);
            $after_amount = $amount - $commission;
        }
        else if ($column == Self::PAYMENT_GATEWAY) {
            $amount = (double) $reports->sum($column);
            $commission = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway))/100;
            $precentage=CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway);
            $after_amount = $amount - $commission;
        }
     
        return '<td>' . ($amount == 0 ? '-' : number_format($amount, 3)) . '</td>
        <td>' . ($commission == 0 ? '-' : number_format($commission, 3)) . '</td>
        <td>' . ($after_amount == 0 ? '-' : number_format($after_amount, 3)) . '</td>'; //.'
        // <td> '.($precentage == 0 ? '-' : number_format($precentage, 3)).'</td>';
    }


    public function getBranchName($branch_id){
        return Branch::where('id',$branch_id)->value('title_en');
    }

}
