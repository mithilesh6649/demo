<?php
namespace App\Http\Reports\salesreport;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Models\DailySaleReport;
use App\Models\MenuCategory;
use App\Models\Branch;
use Carbon\Carbon;
use DateTime,DatePeriod,DateInterval,DB;

class PaymentMethod 
{

    public $start;
    public $end;
    public $branch_id;

    public function __construct($start,$end,$branch_id)
    {
       // $curMonth = date('F');
       // $curYear  = date('Y');
       // $timestamp    = strtotime($curMonth.' '.$curYear);
       // $first_second = date('Y-m-01 00:00:00', $timestamp);
       // $last_second  = date('Y-m-t 12:59:59', $timestamp); 
        $this->start=date('Y-m-d',strtotime(str_replace('/','-',$start))); 

        $this->end=date('Y-m-d',strtotime(str_replace('/','-',$end)));

        $this->branch_id=$branch_id;

        // if(!$start)
        // {
        //   $this->start=$first_second; 
        // }else{

        //   $this->start=date('Y-m-d',strtotime(str_replace('/','-',$start))); 
        // }

        // if(!$end)
        // {
        //   $this->end=$last_second;
        // }else
        // {
        //   $this->end=date('Y-m-d',strtotime(str_replace('/','-',$end)));
        // }
    }


    public function result()
    {

        $spreadsheet = new Spreadsheet();

        /**
         * first tab Report
         */

        $banch_id=$this->branch_id;
        $first_second=$this->start;
        $last_second=$this->end;

        $data = DailySaleReport::select(DB::raw('DATE(report_date) as date')
         , DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent') 
         , DB::raw('SUM(dine_in_cabin) as dine_in_cabin') 
         , DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup') 
         , DB::raw('SUM(home_delivery) as home_delivery') 
         , DB::raw('SUM(buffet) as buffet') 
         , DB::raw('SUM(talabat_TEM) as talabat_TEM') 
         , DB::raw('SUM(talabat_TGO) as talabat_TGO') 
         , DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM') 
         , DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO') 
         , DB::raw('SUM(v_thru) as v_thru') 
         , DB::raw('SUM(mm_online) as mm_online') 
         , DB::raw('SUM(osc) as osc') 
         , DB::raw('SUM(garden) as garden') 
         , DB::raw('SUM(others_gross) as others_gross') 
         , DB::raw('SUM(discount) as discount') 
         , DB::raw('SUM(net_sale) as net_sale') 
         , DB::raw('SUM(complimentary) as complimentary') 
         , DB::raw('SUM(sale_Return) as sale_Return') 
         , DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual') 
         , DB::raw('SUM(cash_shortage) as cash_shortage') 
         , DB::raw('SUM(cash_overage) as cash_overage') 
         , DB::raw('SUM(amex) as amex') 
         , DB::raw('SUM(visa) as visa') 
         , DB::raw('SUM(master) as master') 
         , DB::raw('SUM(dinner) as dinner') 
         , DB::raw('SUM(mm_online_link) as mm_online_link') 
         , DB::raw('SUM(knet) as knet') 
         , DB::raw('SUM(other_cards) as other_cards') 
         , DB::raw('SUM(cheque) as cheque') 
         , DB::raw('SUM(printed_gift_card) as printed_gift_card') 
         , DB::raw('SUM(e_gift_card) as e_gift_card') 
         , DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher') 
         , DB::raw('SUM(cash_equivalent) as cash_equivalent') 
                       // , DB::raw('SUM(talabat_credit) as talabat_credit') 
                       // , DB::raw('SUM(deliveroo_credit) as deliveroo_credit') 
                       // , DB::raw('SUM(v_thru_credit) as v_thru_credit')  
                       // , DB::raw('SUM(others_credit) as others_credit') 
         , DB::raw('SUM(gross_sale) as gross_sale') 
         , DB::raw('SUM(discount_return) as discount_return') 

         , DB::raw('SUM(cash_in_hand) as cash_in_hand') 
         , DB::raw('SUM(cards_sale) as cards_sale') 
         , DB::raw('SUM(cheque_cash) as cheque_cash')
         , DB::raw('SUM(credit_sale) as credit_sale') 
         , DB::raw('SUM(total_collection) as total_collection')
         , DB::raw('SUM(cash_in_hand_opening_balance) as cash_in_hand_opening_balance') 
         , DB::raw('SUM(cash_sales) as cash_sales') 
         , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank') 
         , DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance') 

     )->whereBetween('report_date',[$first_second,$last_second])->where('branch_id',$banch_id)->groupBy('date')->get();

        $dates = DailySaleReport::select(DB::raw('DATE(report_date) as date'))->whereBetween('report_date',[$first_second,$last_second])->groupBy('date')
        ->get()
        ->pluck('date');

        $b_names=Branch::where('id',$banch_id)->first();

        $paymentmethod=array();
        foreach($data as $daily)
        {

            $daily['shortage_&_overage']=$daily['cash_shortage']+$daily['cash_overage'];  
            $paymentmethod[date('d-M-Y',strtotime($daily->date))]=$daily;

        }

       //  $aDates = array();
       //  $start = strtotime($first_second); 
       //  $end = strtotime($last_second); 
       //  $day = array();

       //  $date = strtotime("-1 day", $start);  
       // // $end = strtotime("-1 day", $end);  
       //  while($date < $end)  { 
       //     $date = strtotime("+1 day", $date);
       //     $aDates[] = date('d-M-Y', $date);
       //     $day[] = date('D', $date);
       //  } 


        /**
         * second tab start
         */

        $spreadsheet->setActiveSheetIndex(0)
        ->mergeCells('A1:G1')
        ->setCellValue('A1', 'Period :'.date('d-m-Y',strtotime($first_second))." To ".date('d-m-Y',strtotime($last_second)))
        ->getStyle("A1:G1")
        ->getFont()
        ->setSize(12);

        $spreadsheet->setActiveSheetIndex(0)
        ->mergeCells('I1:U1')
        ->setCellValue('I1', "MUGHAL MAHAL DAILY SALES REPORT F/M ".date('M - Y',strtotime($last_second))." ".$b_names->short_name)
        ->getStyle("I1:U1")
        ->getFont()
        ->setSize(12);

        $spreadsheet->getActiveSheet()
        ->getStyle('I1:U1')
        ->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
        ->getStyle('A2:U2')
        ->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
        ->getStyle('A1:U1')
        ->getFont()
        ->setSize(12);
           // ->setItalic(true);

        $spreadsheet->getActiveSheet()
        ->getStyle('A1:U1')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFF00');

        $spreadsheet->getActiveSheet()
        ->getStyle('A2:U3')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('c6f5ef');

        $spreadsheet->getActiveSheet()
        ->getStyle('A'.(count($data)+8).':U'.(count($data)+9))
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('ed7b7b');

        $spreadsheet->getActiveSheet()
        ->getRowDimension('1')
        ->setRowHeight(20, 'pt');
        $spreadsheet->getActiveSheet()
        ->getRowDimension('2')
        ->setRowHeight(22, 'pt');

        $spreadsheet->getActiveSheet()
        ->getRowDimension('3')
        ->setRowHeight(22, 'pt');
        $spreadsheet->getActiveSheet()
        ->getRowDimension('4')
        ->setRowHeight(22, 'pt');
        $spreadsheet->getActiveSheet()
        ->getRowDimension((count($data)+7))
        ->setRowHeight(17, 'pt');
        $spreadsheet->getActiveSheet()
        ->getRowDimension((count($data)+8))
        ->setRowHeight(17, 'pt');

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'italic' => false,
                'color' => array(
                    'rgb' => '000000'
                ) ,
                'size' => 8,
                'name' => 'Simsun'
            ) ,

        );

        $spreadsheet->getDefaultStyle()
        ->applyFromArray($styleArray);
 


     $spreadsheet->getActiveSheet()
->getStyle('A2:AH2')
->getFont()->setBold(true)->setName('Calibri') ; 


     $spreadsheet->getActiveSheet()
->getStyle('A3:AH3')
->getFont()->setBold(true)->setName('Calibri') ; 

        $spreadsheet->getActiveSheet()
        ->getStyle('A2:U2')
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
        ->getStyle('A2')
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
        ->getStyle('A41:D42')
        ->getFont()
        ->getColor()
        ->setARGB('4ba658');

        $spreadsheet->getActiveSheet()
        ->getStyle('E'.(count($data)+7).':U'.(count($data)+7))
        ->getFont()
        ->getColor()
        ->setARGB('cf1b21');

        $payment = $spreadsheet->getActiveSheet()
        ->setTitle('PAYMENT METHODS');



        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
        $spreadsheet->getActiveSheet()
        ->getStyle('A2:U3')
        ->getAlignment()
        ->setWrapText(true);
        $spreadsheet->getActiveSheet()
        ->getStyle('A2:U3')
        ->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
        ->getStyle('A2:U3')
        ->getAlignment()
        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
        ->getStyle('A2:U3')
        ->getAlignment()
        ->setWrapText(true);
        $spreadsheet->getActiveSheet()
        ->getStyle('A2:U3')
        ->getFont()
        ->setSize(7);
        $spreadsheet->getActiveSheet()
        ->getRowDimension('3')
        ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
        ->getRowDimension('2')
        ->setRowHeight(25, 'pt');

        $payment->setCellValue('A2', 'Day');
        $payment->setCellValue('B2', 'Date');
        //$payment->setCellValue('C2', 'St No');

        $payment->mergeCells('D2:J2')
        ->setCellValue('D2', "Mughal Mahal Credit");
        $payment->mergeCells('K2:O2')
        ->setCellValue('K2', "MM App");
        $payment->mergeCells('P2:S2')
        ->setCellValue('P2', "Credit");

        $spreadsheet->getActiveSheet()
        ->getStyle('D2:J2')
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));
        $spreadsheet->getActiveSheet()
        ->getStyle('P2:S2')
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
        ->getStyle('U2')
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
        ->getStyle('A2')
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
        ->getStyle('B2')
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        

        $rowArray = array(
            '',
            '',

            'Cash',
            'Amex',
            'Visa',
            'Master',
            'Dinner',
            'MM Online  Link',
            'Knet',
            'Other Cards',
            'Cheque',
            'Printed Gift Card',
            'E- Gift Card',
            'Gift Coupon/Voucher',
            'Cash Equivalent(Others)',
            'Talabat Credit',
            'Deliveroo Credit',
            'V Thru Credit',
            'Others',
            'Short & Overage',
            'Total'
        );

        $i = 0;
        foreach (range('A', 'U') as $columnID)
        {
            $col = $columnID . "3";

            $spreadsheet->getActiveSheet()
            ->getStyle($col)->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
            ->getColumnDimension($columnID)->setWidth(17);

            $payment->setCellValue($col, $rowArray[$i]);

            $i++;
        }


        
        $payment_i = 0;

        foreach ($data as $key => $p_data) {
            

            $payment->setCellValue('C'.($payment_i+4), $p_data['cash_sales']);
            $payment->setCellValue('D'.($payment_i+4), \App\Models\DailySaleReport::getTotalAmexPay($banch_id,$p_data['date']));
            $payment->setCellValue('E'.($payment_i+4), \App\Models\DailySaleReport::getTotalVisaaPay($banch_id,$p_data['date']) );
            $payment->setCellValue('F'.($payment_i+4), \App\Models\DailySaleReport::getTotalMastersPay($banch_id,$p_data['date']) );
            $payment->setCellValue('G'.($payment_i+4), \App\Models\DailySaleReport::getTotalDinnerPay($banch_id,$p_data['date']) );
            $payment->setCellValue('H'.($payment_i+4),\App\Models\DailySaleReport::getTotalPaymentGetwaysPay($banch_id,$p_data['date']) );
            $payment->setCellValue('I'.($payment_i+4), \App\Models\DailySaleReport::getTotalKnetsPay($banch_id,$p_data['date']) );
            $payment->setCellValue('J'.($payment_i+4), \App\Models\DailySaleReport::getOthercardsPay($banch_id,$p_data['date']) );
                // $payment->setCellValue('K'.($payment_i+4), $paymentmethod[$p_data['date']]['cheque']);
                // $payment->setCellValue('L'.($payment_i+4), $paymentmethod[$p_data['date']]['printed_gift_card']);
                // $payment->setCellValue('M'.($payment_i+4), $paymentmethod[$p_data['date']]['e_gift_card']);
                // $payment->setCellValue('N'.($payment_i+4), $paymentmethod[$p_data['date']]['gift_coupon_voucher']);
                // $payment->setCellValue('O'.($payment_i+4), $paymentmethod[$p_data['date']]['cash_equivalent']);
                // $payment->setCellValue('P'.($payment_i+4), $paymentmethod[$p_data['date']]['talabat_credit']);
                // $payment->setCellValue('Q'.($payment_i+4), $paymentmethod[$p_data['date']]['deliveroo_credit']);
                // $payment->setCellValue('R'.($payment_i+4), $paymentmethod[$p_data['date']]['v_thru_credit']);
                // $payment->setCellValue('S'.($payment_i+4), $paymentmethod[$p_data['date']]['others_credit']);

            $payment->setCellValue('K'.($payment_i+4),\App\Models\DailySaleReport::getTotalchequePay($banch_id,$p_data['date'])  );
            $payment->setCellValue('L'.($payment_i+4), \App\Models\DailySaleReport::getTotalPrintedGiftCardPay($banch_id,$p_data['date'])  );
            $payment->setCellValue('M'.($payment_i+4),\App\Models\DailySaleReport::getTotalEGoftCardPay($banch_id,$p_data['date'])   );
            $payment->setCellValue('N'.($payment_i+4), \App\Models\DailySaleReport::getTotalGiftCouponVoucherPay($banch_id,$p_data['date'])  );
            $payment->setCellValue('O'.($payment_i+4), \App\Models\DailySaleReport::getTotalCashEquivalentPay($banch_id,$p_data['date'])  );
            $payment->setCellValue('P'.($payment_i+4),  \App\Models\DailySaleReport::getTotalCashTalabatCreditTmpTgoPay($banch_id,$p_data['date']) );
            $payment->setCellValue('Q'.($payment_i+4), \App\Models\DailySaleReport::getTotalCashDeliverooCreditTmpTgoPay($banch_id,$p_data['date'])  );
            $payment->setCellValue('R'.($payment_i+4),\App\Models\DailySaleReport::getTotalCashVThruCreditTmpTgoPay($banch_id,$p_data['date'])   );
            $payment->setCellValue('S'.($payment_i+4), \App\Models\DailySaleReport::getTotalCashOthersThruCreditTmpTgoPay($banch_id,$p_data['date'])  );
            $payment->setCellValue('T'.($payment_i+4), $p_data['shortage_&_overage']);

            
                //text alignment
            $spreadsheet->getActiveSheet()
            ->getStyle('C'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('D'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('E'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('F'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('G'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('H'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('I'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('J'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('K'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('L'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('M'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('N'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('O'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('P'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $spreadsheet->getActiveSheet()
            ->getStyle('Q'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('R'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('S'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
            ->getStyle('T'.($payment_i+4))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $payment_i++;
        }


      //  $Sno = 47003;

        $total=array('=SUM(C4:T4)','=SUM(C5:T5)','=SUM(C6:T6)','=SUM(C7:T7)','=SUM(C8:T8)','=SUM(C9:T9)','=SUM(C10:T10)','=SUM(C11:T11)','=SUM(C12:T12)','=SUM(C13:T13)','=SUM(C14:T14)','=SUM(C15:T15)','=SUM(C16:T16)','=SUM(C17:T17)','=SUM(C18:T18)','=SUM(C19:T19)','=SUM(C20:T20)','=SUM(C21:T21)','=SUM(C22:T22)','=SUM(C23:T23)','=SUM(C24:T24)','=SUM(C25:T25)','=SUM(C26:T26)','=SUM(C27:T27)','=SUM(C28:T28)','=SUM(C29:T29)','=SUM(C30:T30)','=SUM(C31:T31)','=SUM(C32:T32)','=SUM(C33:T33)','=SUM(C34:T34)');


        $dates_i = 1;

        foreach ($data as $p_data)
        {

            $col_A_data = "A" . ($dates_i + 3);
            $col_B_data = "B" . ($dates_i + 3);
            $col_c_data = "C" . ($dates_i + 3);
            $col_V_data = "U" . ($dates_i + 3);

            $spreadsheet->getActiveSheet()
            ->getRowDimension(($dates_i + 3))->setRowHeight(20, 'pt');

            $spreadsheet->getActiveSheet()
            ->getStyle($col_A_data)->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $payment->setCellValue($col_A_data, date('D', strtotime($p_data['date'])));

            $spreadsheet->getActiveSheet()
            ->getStyle($col_B_data)->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $payment->setCellValue($col_B_data, date('d/m/Y', strtotime($p_data['date'])));

            // $spreadsheet->getActiveSheet()
            //     ->getStyle($col_c_data)->getAlignment()
            //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // $payment->setCellValue($col_c_data, $Sno);

            $spreadsheet->getActiveSheet()
            ->getStyle($col_V_data)->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $payment->setCellValue($col_V_data,$total[$dates_i-1]);

           // $Sno++;
            $dates_i++;

        }

        //apply all column border
        foreach (range('A', 'U') as $colmn)
        {
            for ($i = 1;$i <=(count($data)+3);$i++)
            {
                $spreadsheet->getActiveSheet()
                ->getStyle($colmn . ($i + 2))->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            }
        }

        $spreadsheet->getActiveSheet()
        ->getStyle('A'.(count($data)+7))
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
        ->getStyle('A'.(count($data)+7))
        ->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $payment->mergeCells('A'.(count($data)+8).':B'.(count($data)+8))
        ->setCellValue('A'.(count($data)+8), 'SUB TOTAL');

        $formulaarray =array();

        foreach(range('C','U') as $rowcol)
        {

         $formulaarray[$rowcol.(count($data)+8)]='=SUM('.$rowcol.'4:'.$rowcol.(count($data)+7).')';
     }


     foreach (range('A', 'U') as $columnID)
     {

        $key = $columnID .(count($data)+8);
        $keysec = $columnID . (count($data)+9);

        $spreadsheet->getActiveSheet()
        ->getStyle($keysec)->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
        ->getStyle($key)->getBorders()
        ->getOutline()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
        ->getStyle($key)->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        if (in_array($key, array_keys($formulaarray)))
        {
            $payment->setCellValue($key, $formulaarray[$key]);
        }

    }

    $spreadsheet->getActiveSheet()
    ->getStyle('U'.(count($data)+8).':U'.(count($data)+9))
    ->getBorders()
    ->getRight()
    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
    ->setColor(new Color('0563b0'));

    $spreadsheet->getActiveSheet()
    ->getStyle('A2')
    ->getBorders()
    ->getRight()
    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
    ->setColor(new Color('000000'));

    $spreadsheet->getActiveSheet()
    ->getStyle('U4')
    ->getBorders()
    ->getRight()
    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
    ->setColor(new Color('0563b0'));

    $spreadsheet->getActiveSheet()
    ->getStyle('A3:A'.(count($data)+9))
    ->getBorders()
    ->getLeft()
    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
    ->setColor(new Color('0563b0'));

    $payment->setCellValue('A'.(count($data)+7), 'ADJST');

        // for ($i = 40;$i <= 43;$i++)
        // {

        //     $spreadsheet->getActiveSheet()
        //         ->getStyle('E' . $i)->getBorders()
        //         ->getOutline()
        //         ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        //         ->setColor(new Color('000000'));

        //     $payment->setCellValue('E' . $i . $i, '');

        // }

    $spreadsheet->getActiveSheet()
    ->getStyle('A1:U'.(count($data)+12))
    ->getBorders()
    ->getOutline()
    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
    ->setColor(new Color('0563b0'));

    $format = '0.000';
    $spreadsheet->getActiveSheet()
    ->getStyle('A1:U'.(count($data)+12))->getNumberFormat()
    ->setFormatCode($format);


    $spreadsheet->createSheet();

    /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
    $spreadsheet->setActiveSheetIndex(0);

    $fileName = 'Sales_Report.xlsx';
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
    $writer->save('php://output');
}


}

