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
 
class SalesServiceReport
{
    public $month;
    public $year;

    public function __construct($year,$month){
        
        if(!$year)
        {
            $this->year=Carbon::now('Y');
        }else{
            $this->year=$year;
        }
        if(!$month)
        {
            $this->month=Carbon::now('m');
        }else{
            $this->month=$month;
        }
    }

    public function result()
    {

        $spreadsheet = new Spreadsheet();

        $current_month=$this->month;
        $current_year=$this->year;
          
        $branch=Branch::get()->pluck('short_name','id');
     
        $data_value=DailySaleReport::select('branch_id',DB::raw('Month(report_date) as month'),
                                DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent'),
                                DB::raw('SUM(dine_in_cabin) as dine_in_cabin'),
                                DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup'),
                                DB::raw('SUM(home_delivery) as home_delivery'),
                                DB::raw('SUM(buffet) as buffet'),
                                DB::raw('SUM(talabat_TEM) as talabat_TEM'),
                                DB::raw('SUM(talabat_TGO) as talabat_TGO'), 
                                 DB::raw('SUM(MM_Express_TGO) as MM_Express_TGO'),
                                DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM'),
                                DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO'),
                                DB::raw('SUM(v_thru) as v_thru'),
                                DB::raw('SUM(mm_online) as mm_online'),
                                DB::raw('SUM(osc) as osc'),
                                DB::raw('SUM(garden) as garden'),
                                DB::raw('SUM(others_gross) as others_gross'),
                                DB::raw('SUM(discount) as discount'),
                                DB::raw('SUM(complimentary) as complimentary'),
                                DB::raw('SUM(sale_Return) as sale_Return'),
                                DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual'),
                                DB::raw('SUM(cash_shortage) as cash_shortage'),
                                DB::raw('SUM(cash_overage) as cash_overage'),
                                DB::raw('SUM(amex) as amex'),
                                DB::raw('SUM(visa) as visa'),
                                DB::raw('SUM(master) as master'),
                                DB::raw('SUM(dinner) as dinner'),
                                DB::raw('SUM(mm_online_link) as mm_online_link'),
                                DB::raw('SUM(knet) as knet'),
                                DB::raw('SUM(other_cards) as other_cards'),
                                DB::raw('SUM(cheque) as cheque'),
                                DB::raw('SUM(printed_gift_card) as printed_gift_card'),
                                DB::raw('SUM(e_gift_card) as e_gift_card'),
                                DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher'),
                                DB::raw('SUM(cash_equivalent) as cash_equivalent'),
                                // DB::raw('SUM(talabat_credit) as talabat_credit'),
                                // DB::raw('SUM(deliveroo_credit) as deliveroo_credit'),
                                // DB::raw('SUM(v_thru_credit) as v_thru_credit'),
                                // DB::raw('SUM(others_credit) as others_credit'),
                                DB::raw('SUM(gross_sale) as gross_sale'),
                                DB::raw('SUM(discount_return) as discount_return'),
                                DB::raw('SUM(net_sale) as net_sale'),
                                DB::raw('SUM(cash_in_hand) as cash_in_hand'),
                                DB::raw('SUM(cards_sale) as cards_sale'),
                                DB::raw('SUM(cheque_cash) as cheque_cash'),
                                DB::raw('SUM(credit_sale) as credit_sale'),
                                DB::raw('SUM(total_collection) as total_collection'),
                                DB::raw('SUM(cash_in_hand_opening_balance) as ash_in_hand_opening_balance'),
                                DB::raw('SUM(cash_sales) as cash_sales'),
                                DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'),
                                DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance'),
                                )->whereYear('report_date',$current_year)->whereMonth('report_date',$current_month)->groupBy('month','branch_id')->get();

                      
            $month_datavalue = array();
            foreach ($data_value as $month_value)
            {
               $month_datavalue[$month_value->branch_id] =$month_value;
                
            }

            $allmonth=date("M-Y", mktime(0, 0, 0, $current_month, 1,$current_year));
       
            $aDates = array();
            $oStart = new DateTime(date('Y-m-01', strtotime($this->year."-".$this->month."-01")));
            $oEnd = clone $oStart;
            $oEnd->add(new DateInterval("P1M"));

            while ($oStart->getTimestamp() < $oEnd->getTimestamp())
            {
                $aDates[] = $oStart->format('d-M-Y');
                $day[] = $oStart->format('D');
                $oStart->add(new DateInterval("P1D"));
            }

        /**
         * third report start  Summary By Branch dev_135 
         */

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:V1')
            ->setCellValue('A1', "MUGHAL MAHAL : MONTHLY SERVICE WISE REPORT F/M ".date("M-Y", mktime(0, 0, 0, $current_month, 1,$current_year))." (".date('d-m-Y',strtotime($aDates[count($aDates)-(count($aDates))]))." - ".date('d-m-Y',strtotime($aDates[count($aDates)-1])).")")
            ->getStyle("A1:V1")
            ->getFont()
            ->setSize(12);

        $spreadsheet->getActiveSheet()
            ->getRowDimension('2')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('18')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('1')
            ->setRowHeight(30, 'pt');

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:V1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:V2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:V1')
            ->getFont()
            ->setSize(12);
           // ->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:V3')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('fcda51');


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

        $Summary = $spreadsheet->getActiveSheet()
            ->setTitle('ALL BRANCH MONTHLY GROSS SALE');

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:W3')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:W3')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:W3')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:W2')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:W3')
            ->getFont()
            ->setSize(7);
        $spreadsheet->getActiveSheet()
            ->getRowDimension('3')
            ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('2')
            ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
            ->getStyle('A3')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('B3')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('C3')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $rowArray = array(
            'BRANCH',
            'MONTH',
            'Dine-In Restaurant',
            'Dine-In Cabin',
            'Take Away/Self Pickup',
            'Home Delivery',
            'Buffet',
            'Talabat (TMP)',
            'Talabat (TGO)',
            'MM Express(TGO)',
            'Deliveroo (TMP)',
            'Deliveroo (TGO)',
            'V-Thru',
            'MM Online',
            'OSC',
            'Garden',
            'Others',
            'Net SALE',
            'Discount',
            'Complimentary',
            'Sale Return',
            'Gross Sale'
        );

        $column_names = $rowArray;
        $column_count = count($rowArray);
        $column_count = $column_count - 2;

        $rowarray2 = ['A3' => null, 'B3' => 'A/C', 'C3' => 'Cr', 'D3' => 'Cr', 'E3' => 'Cr', 'F3' => 'Cr', 'G3' => 'Cr', 'H3' => null, 'I3' => NULL, 'J3' =>null, 'K3' => 'Cr', 'L3' => null, 'M3' => 'Cr', 'N3' => null, 'O3' => null, 'P3' => null, 'Q3' =>null, 'R3' => 'Cr', 'S3' =>'Dr', 'T3' => null, 'U3' => null,'V3'=>'Dr'];

        $i = 0;
        foreach (range('A', 'V') as $columnID)
        {

            $col = $columnID . "2";
            $cols = $columnID . "3";

            $spreadsheet->getActiveSheet()
                ->getStyle($col)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getColumnDimension($columnID)->setWidth(17);
            $Summary->setCellValue($col, $rowArray[$i]);
            $Summary->setCellValue($cols, $rowarray2[$cols]);
            $i++;
        }

        $aDates = array();
        // $oStart = new DateTime('2022-01-01');
        $oStart = new DateTime(date('Y-m-d'));
        $oEnd = clone $oStart;
        $oEnd->add(new DateInterval("P1M"));

        while ($oStart->getTimestamp() < $oEnd->getTimestamp())
        {
            $aDates[] = $oStart->format('M-Y');
            $day[] = $oStart->format('D');
            $oStart->add(new DateInterval("P1D"));
        }

        //apply all column border
        foreach (range('A', 'V') as $colmn)
        {
            for ($i = 1;$i <=(count($branch)+6);$i++)
            {
                $spreadsheet->getActiveSheet()
                    ->getStyle($colmn . ($i + 2))->getBorders()
                    ->getOutline()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
        }

       
  // $month_datavalue

          //  $allmonth

        $rowArray = $branch->toArray();
        $netsell=array();
        $grosssell=array();

        for($i=0;$i<count($rowArray);$i++){
          $netsell[]="=C".($i+4)."+D".($i+4)."+E".($i+4)."+F".($i+4)."+G".($i+4)."+H".($i+4)."+I".($i+4)."+J".($i+4)."+K".($i+4)."+L".($i+4)."+M".($i+4)."+N".($i+4)."+O".($i+4)."+P".($i+4)."+Q".($i+4);
           
           $grosssell[]= "=+R".($i+4)."+S".($i+4)."+T".($i+4)."+U".($i+4);

        }
       
         $i=1;
        
        foreach($rowArray as $bskey=>$bval)
        {
              if(in_array($bskey,array_keys($month_datavalue))){
                    $Summary->setCellValue('A'.($i+3), $bval);
                    $Summary->setCellValue('B'.($i+3), $allmonth);
                    $Summary->setCellValue('C'.($i+3), $month_datavalue[$bskey]['dine_in_restaurent']);
                    $Summary->setCellValue('D'.($i+3), $month_datavalue[$bskey]['dine_in_cabin']);
                    $Summary->setCellValue('E'.($i+3), $month_datavalue[$bskey]['take_away_self_pickup']);
                    $Summary->setCellValue('F'.($i+3), $month_datavalue[$bskey]['home_delivery']);
                    $Summary->setCellValue('G'.($i+3), $month_datavalue[$bskey]['buffet']);
                    $Summary->setCellValue('H'.($i+3), $month_datavalue[$bskey]['talabat_TEM']);
                    $Summary->setCellValue('I'.($i+3), $month_datavalue[$bskey]['talabat_TGO']);
                    
                    $Summary->setCellValue('J'.($i+3), $month_datavalue[$bskey]['MM_Express_TGO']); 
                    $Summary->setCellValue('K'.($i+3), $month_datavalue[$bskey]['deliveroo_TEM']);
                    $Summary->setCellValue('L'.($i+3), $month_datavalue[$bskey]['deliveroo_TGO']);

                    $Summary->setCellValue('M'.($i+3), $month_datavalue[$bskey]['v_thru']);
                    $Summary->setCellValue('N'.($i+3), $month_datavalue[$bskey]['mm_online']); 
                    $Summary->setCellValue('O'.($i+3), $month_datavalue[$bskey]['osc']);
                    $Summary->setCellValue('P'.($i+3), $month_datavalue[$bskey]['garden']);
                    $Summary->setCellValue('Q'.($i+3), $month_datavalue[$bskey]['others_gross']);
                    $Summary->setCellValue('R'.($i+3), $netsell[($i-1)]);
                    $Summary->setCellValue('S'.($i+3), $month_datavalue[$bskey]['discount']);
                    $Summary->setCellValue('T'.($i+3), $month_datavalue[$bskey]['complimentary']);
                    $Summary->setCellValue('U'.($i+3), $month_datavalue[$bskey]['sale_Return']);
                    $Summary->setCellValue('V'.($i+3), $grosssell[($i-1)]);
 

                    // $Summary->setCellValue('A'.($i+3), $bval);
                    // $Summary->setCellValue('B'.($i+3), $allmonth);
                    // $Summary->setCellValue('C'.($i+3), $month_datavalue[$bskey]['dine_in_restaurent']);
                    // $Summary->setCellValue('D'.($i+3), $month_datavalue[$bskey]['dine_in_cabin']);
                    // $Summary->setCellValue('E'.($i+3), $month_datavalue[$bskey]['take_away_self_pickup']);
                    // $Summary->setCellValue('F'.($i+3), $month_datavalue[$bskey]['home_delivery']);
                    // $Summary->setCellValue('G'.($i+3), $month_datavalue[$bskey]['buffet']);
                    // $Summary->setCellValue('H'.($i+3), $month_datavalue[$bskey]['talabat_TEM']);
                    // $Summary->setCellValue('I'.($i+3), $month_datavalue[$bskey]['talabat_TGO']);
                    // $Summary->setCellValue('J'.($i+3), $month_datavalue[$bskey]['deliveroo_TEM']);
                    // $Summary->setCellValue('K'.($i+3), $month_datavalue[$bskey]['deliveroo_TGO']);
                    // $Summary->setCellValue('L'.($i+3), $month_datavalue[$bskey]['v_thru']);
                    // $Summary->setCellValue('M'.($i+3), $month_datavalue[$bskey]['mm_online']);
                    // $Summary->setCellValue('N'.($i+3), $month_datavalue[$bskey]['osc']);
                    // $Summary->setCellValue('O'.($i+3), $month_datavalue[$bskey]['garden']);
                    // $Summary->setCellValue('P'.($i+3), $month_datavalue[$bskey]['others_gross']);
                    // $Summary->setCellValue('Q'.($i+3), $netsell[($i-1)]);
                    // $Summary->setCellValue('R'.($i+3), $month_datavalue[$bskey]['discount']);
                    // $Summary->setCellValue('S'.($i+3), $month_datavalue[$bskey]['complimentary']);
                    // $Summary->setCellValue('T'.($i+3), $month_datavalue[$bskey]['sale_Return']);
                    // $Summary->setCellValue('U'.($i+3), $grosssell[($i-1)]);


              }else{
                 
                    $Summary->setCellValue('A'.($i+3), $bval);
                    $Summary->setCellValue('B'.($i+3), $allmonth);
                    $Summary->setCellValue('R'.($i+3), $netsell[($i-1)]);
                    $Summary->setCellValue('V'.($i+3), $grosssell[($i-1)]);

              } 
          $i++;
        }

      $number = count($rowArray)+6;
        

        
        $Summary->mergeCells('A'.$number.':B'.$number.'')
            ->setCellValue('A'.$number, 'SUB TOTAL');

         $spreadsheet->getActiveSheet()
            ->getStyle('A'.$number.':V'.$number)
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('ffcccc');

        $spreadsheet->getActiveSheet()
            ->getStyle('C'.$number.':V'.$number)
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

         $spreadsheet->getActiveSheet()
            ->getStyle('V4:V'.($number-2))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        $spreadsheet->getActiveSheet()
            ->getStyle('R4:R'.($number-2))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

      $spreadsheet->getActiveSheet()
            ->getStyle('A4:B'.($number-2))
            ->getFont()
            ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
            ->getStyle('A'.$number.':V'.$number)
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A'.$number.':V'.$number)
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A'.$number.':V'.$number)
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $alpha = 'C';
        for ($i=1; $i <= $column_count; $i++) { 
            $spreadsheet->getActiveSheet()->setCellValue($alpha."".$number, "=SUM(".$alpha."4:".$alpha."".($number-2).")");
            $alpha++;
        }

    
 
        $spreadsheet->getActiveSheet()
            ->getStyle('A4:Z32')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
       $format = '0.000';
       $spreadsheet->getActiveSheet()
            ->getStyle('C4:V'.(count($rowArray)+7))->getNumberFormat()
            ->setFormatCode($format);

        $spreadsheet->createSheet();

        
        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0); 

        $timestamp = "-".date('d-m-Y')."(".date('h-i-s-A',time()).")"; 
        $fileName = 'Sales_By_Service'.$timestamp.'.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

    // get sales by branch
    public function getSalesByBranch($column_name,$branch_name){
        $column_name = $this->getColumnName()[$column_name];
        $branch = Branch::where('title_en',$branch_name)->first();
        $reports = DailySaleReport::where('branch_id',$branch->id)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();

        $sales = 0;
        foreach($reports as $report){
            $sales = $sales + $report[$column_name];
        }
        return $sales;
    }

    public function getColumnName(){
        return [
            'BRANCH' => 'branch',
            'MONTH' => 'month',
            'Dine-In Restaurant' => 'dine_in_restaurent',
            'Dine-In Cabin' => 'dine_in_cabin',
            'Take Away/Self Pickup' => 'take_away_self_pickup',
            'Home Delivery' => 'home_delivery',
            'Buffet' => 'buffet',
            'Talabat (TMP)' => 'talabat_TEM',
            'Talabat (TGO)' => 'talabat_TGO',
            'MM_Express_TGO'=>'MM Express(TGO)',
            'Deliveroo (TMP)' => 'deliveroo_TEM',
            'Deliveroo (TGO)' => 'deliveroo_TGO',
            'V-Thru' => 'v_thru',
            'MM Online' => 'mm_online',
            'OSC' => 'osc',
            'Garden' => 'garden',
            'Others' => 'others_gross',
            'Net SALE' => 'net_sale',
            'Discount' => 'discount',
            'Complimentary' => 'complimentary',
            'Sale Return' => 'sale_Return',
            'Gross Sale' => 'gross_sale'
        ];
    }
}

