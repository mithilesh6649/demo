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
 
class Monthsales
{

	public $year;
    public $branch_id;

    public function __construct($year,$branch_id)
    {
     
       
     
        if(!$year)
        {
          $this->year=date('Y'); 
        }else{
          
          $this->year=$year; 
        }

        if(!$branch_id)
        {
        	$branch=Branch::where('status','1')->first();

          $this->branch_id=$branch->id;
        }else
        {
          $this->branch_id=$branch_id;
        }
    }


    public function result()
    {

        $spreadsheet = new Spreadsheet();

       
         $current_year=$this->year;
         $branch_id=$this->branch_id;
         $branch_name=Branch::select('short_name')->where('id',$branch_id)->first();

         $data_value=DailySaleReport::select(DB::raw('Month(report_date) as month'),
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
                                        // DB::raw('SUM(gross_sale) as gross_sale'),
                                        DB::raw('SUM(discount_return) as discount_return'),
                                        DB::raw('SUM(net_sale) as net_sale'),
                                        DB::raw('SUM(cash_in_hand) as cash_in_hand'),
                                        DB::raw('SUM(cards_sale) as cards_sale'),
                                        DB::raw('SUM(cheque_cash) as cheque_cash'),
                                        DB::raw('SUM(credit_sale) as credit_sale'),
                                        DB::raw('SUM(total_collection) as total_collection'),
                                        DB::raw('SUM(cash_in_hand_opening_balance) as cash_in_hand_opening_balance'),
                                        DB::raw('SUM(cash_sales) as cash_sales'),
                                        DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'),
                                        DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance'),
                                    )->whereYear('report_date',$current_year)->where('branch_id',$branch_id)->groupBy('month')->get();

                  
        $month_datavalue = array();
        foreach ($data_value as $month_value)
        {
           $month_datavalue[$month_value->month] =$month_value;
            
        }
     
            

        /**
         * create fourth Report Summary By Month
         */

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:V1')
            ->setCellValue('A1', "MUGHAL MAHAL : MONTHLY REPORT F/Y  (01-01-".$current_year." To 31-12-".$current_year.") ".$branch_name->short_name)
            ->getStyle("A1:V1")
            ->getFont()
            ->setSize(12);

        $spreadsheet->getActiveSheet()
            ->getRowDimension('2')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('16')
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

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A1:U1')
        //     ->getFont()
        //     ->setSize(12)
        //     ->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:V4')
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
->getStyle('A3:AH3')
->getFont()->setBold(true)->setName('Calibri') ; 

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:V2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('S2')
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $SummaryMonth = $spreadsheet->getActiveSheet()
            ->setTitle('SINGLE BRANCH MONTHLY GROSS SAL');

        // $SummaryMonth->mergeCells('A2:R2')
        //     ->setCellValue('A2', 'SERVICE/PRODUCT WISE SALES');
        // $SummaryMonth->mergeCells('S2:U2')
        //     ->setCellValue('S2', "PERIOD: ");

        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

      

        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:W4')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:W4')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:W4')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:W4')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:W4')
            ->getFont()
            ->setSize(7);
        $spreadsheet->getActiveSheet()
            ->getRowDimension('4')
            ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('3')
            ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('18')
            ->setRowHeight(20, 'pt');

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
            'Sl No.',
            'MONTH ',
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

      $rowarray2 = ['A4' => null, 'B4' => 'A/C', 'C4' => 'Cr', 'D4' => 'Cr', 'E4' => 'Cr', 'F4' => 'Cr', 'G4' => 'Cr', 'H4' => null, 'I4' => NULL, 'J4' => null, 'K4' =>'Cr', 'L4' => null, 'M4' => "Cr", 'N4' => null, 'O4' => null, 'P4' => null, 'Q4' => null, 'R4' => 'Cr', 'S4' => "Dr", 'T4' => null, 'U4' => null,'V4' => "Dr"];

        $i = 0;
        foreach (range('A', 'V') as $columnID)
        {

            $col = $columnID . "3";
            $cols = $columnID . "4";

            $spreadsheet->getActiveSheet()
                ->getStyle($col)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getColumnDimension($columnID)->setWidth(17);
            $SummaryMonth->setCellValue($col, $rowArray[$i]);
            $SummaryMonth->setCellValue($cols, $rowarray2[$cols]);
            $i++;
        }

    

        $col_q = array(
            '=C5+D5+E5+F5+G5+H5+I5+J5+K5+L5+M5+N5+O5+P5+Q5',
            '=C6+D6+E6+F6+G6+H6+I6+J6+K6+L6+M6+N6+O6+P6+Q6',
            '=C7+D7+E7+F7+G7+H7+I7+J7+K7+L7+M7+N7+O7+P7+Q7',
            '=C8+D8+E8+F8+G8+H8+I8+J8+K8+L8+M8+N8+O8+P8+Q8',
            '=C9+D9+E9+F9+G9+H9+I9+J9+K9+L9+M9+N9+O9+P9+Q9',
            '=C10+D10+E10+F10+G10+H10+I10+J10+K10+L10+M10+N10+O10+P10+Q10',
            '=C11+D11+E11+F11+G11+H11+I11+J11+K11+L11+M11+N11+O11+P11+Q11',
            '=C12+D12+E12+F12+G12+H12+I12+J12+K12+L12+M12+N12+O12+P12+Q12',
            '=C13+D13+E13+F13+G13+H13+I13+J13+K13+L13+M13+N13+O13+P13+Q13',
            '=C14+D14+E14+F14+G14+H14+I14+J14+K14+L14+M14+N14+O14+P14+Q14',
            '=C15+D15+E15+F15+G15+H15+I15+J15+K15+L15+M15+N15+O15+P15+Q15',
            '=C16+D16+E16+F16+G16+H16+I16+J16+K16+L16+M16+N16+O16+P16+Q16'
        );

        $col_w = array(
            '=+R5+S5+T5+U5',
            '=+R6+S6+T6+U6',
            '=+R7+S7+T7+U7',
            '=+R8+S8+T8+U8',
            '=+R9+S9+T9+U9',
            '=+R10+S10+T10+U10',
            '=+R11+S11+T11+U11',
            '=+R12+S12+T12+U12',
            '=+R13+S13+T13+U13',
            '=+R14+S14+T14+U14',
            '=+R15+S15+T15+U15',
            '=+R16+S16+T16+U16'
        );
        
         $sel_month = array_keys($month_datavalue);
        for ($i = 1;$i <= 12;$i++)
        {
          //if(in_array($i,$sel_month)){  
           //S I N O    
            $col_A_data = "A" . ($i + 4);
            //Months
            $col_B_data = "B" . ($i + 4);
            //Net Sale
            $col_q_data = "R" . ($i + 4);
            //Gross Sale
           $col_u_data = "V" . ($i + 4);

            $spreadsheet->getActiveSheet()
                ->getRowDimension(($i + 4))->setRowHeight(20, 'pt');

            $spreadsheet->getActiveSheet()
                ->getStyle($col_A_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $SummaryMonth->setCellValue($col_A_data, ($i));

            $spreadsheet->getActiveSheet()
                ->getStyle($col_B_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $SummaryMonth->setCellValue($col_B_data, date("M-Y", mktime(0, 0, 0, $i, 1,$current_year)));

            $spreadsheet->getActiveSheet()
                ->getStyle($col_q_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $SummaryMonth->setCellValue($col_q_data, $col_q[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_u_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $SummaryMonth->setCellValue($col_u_data, $col_w[$i - 1]);

              if(in_array((int)date("m", mktime(0, 0, 0, $i, 1, date("Y"))),array_keys($month_datavalue))) {
                

                $SummaryMonth->setCellValue('C'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['dine_in_restaurent']);
                $SummaryMonth->setCellValue('D'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['dine_in_cabin']);
                $SummaryMonth->setCellValue('E'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['take_away_self_pickup']);
                $SummaryMonth->setCellValue('F'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['home_delivery']);
                $SummaryMonth->setCellValue('G'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['buffet']);
                $SummaryMonth->setCellValue('H'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['talabat_TEM']);
                $SummaryMonth->setCellValue('I'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['talabat_TGO']);

                $SummaryMonth->setCellValue('J'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['MM_Express_TGO']);
                $SummaryMonth->setCellValue('K'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['deliveroo_TEM']);
                $SummaryMonth->setCellValue('L'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['deliveroo_TGO']);
                $SummaryMonth->setCellValue('M'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['v_thru']);
                $SummaryMonth->setCellValue('N'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['mm_online']);
                $SummaryMonth->setCellValue('O'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['osc']);
                $SummaryMonth->setCellValue('P'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['garden']);
                $SummaryMonth->setCellValue('Q'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['others_gross']);
                $SummaryMonth->setCellValue('S'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['discount']);
                $SummaryMonth->setCellValue('T'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['complimentary']);
                $SummaryMonth->setCellValue('U'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['sale_Return']);      
                 




                // $SummaryMonth->setCellValue('C'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['dine_in_restaurent']);
                // $SummaryMonth->setCellValue('D'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['dine_in_cabin']);
                // $SummaryMonth->setCellValue('E'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['take_away_self_pickup']);
                // $SummaryMonth->setCellValue('F'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['home_delivery']);
                // $SummaryMonth->setCellValue('G'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['buffet']);
                // $SummaryMonth->setCellValue('H'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['talabat_TEM']);
                // $SummaryMonth->setCellValue('I'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['talabat_TGO']);
                // $SummaryMonth->setCellValue('J'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['deliveroo_TEM']);
                // $SummaryMonth->setCellValue('K'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['deliveroo_TGO']);
                // $SummaryMonth->setCellValue('L'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['v_thru']);
                // $SummaryMonth->setCellValue('M'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['mm_online']);
                // $SummaryMonth->setCellValue('N'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['osc']);
                // $SummaryMonth->setCellValue('O'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['garden']);
                // $SummaryMonth->setCellValue('P'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['others_gross']);
                // $SummaryMonth->setCellValue('R'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['discount']);
                // $SummaryMonth->setCellValue('S'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['complimentary']);
                // $SummaryMonth->setCellValue('T'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, $current_year))]['sale_Return']);
                

            }
           

            //text alignment
                $spreadsheet->getActiveSheet()
                            ->getStyle('C'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('D'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('E'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('F'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('G'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('H'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('I'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('J'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('K'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('L'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('M'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('N'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('O'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('P'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $spreadsheet->getActiveSheet()
                            ->getStyle('R'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('S'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('T'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
          //} 
        }

        $SummaryMonth->mergeCells('A18:B18')
            ->setCellValue('A18', 'SUB TOTAL');

         $formulaarray = ['C' => '=SUM(C5:C17)', 'D' => '=SUM(D5:D17)', 'E' => '=SUM(E5:E17)', 'F' => '=SUM(F5:F17)', 'G' => '=SUM(G5:G17)', 'H' => '=SUM(H5:H17)', 'K' => '=SUM(K5:K17)','N' => '=SUM(N5:N17)', 'M' => '=SUM(M5:M17)', 'Q' => '=SUM(Q5:Q17)', 'R' => '=SUM(R5:R17)', 'V' => '=SUM(V5:V17)'];

        $spreadsheet->getActiveSheet()
            ->getStyle('A18:U18')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A18:U18')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A18:U18')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        foreach (range('A', 'V') as $columnID)
        {
            $key = $columnID . '18';
            $spreadsheet->getActiveSheet()
                ->getStyle($key)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle($key)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            if (in_array($columnID, array_keys($formulaarray)))
            {
                $SummaryMonth->setCellValue($key, $formulaarray[$columnID]);
            }

        }

      //  apply all column border
        foreach (range('A', 'V') as $colmn)
        {

            for ($i = 1;$i <= 16;$i++)
            {
                $spreadsheet->getActiveSheet()
                    ->getStyle($colmn . ($i + 3))->getBorders()
                    ->getOutline()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
        }

       
       


        $spreadsheet->getActiveSheet()
                    ->getStyle('R5:R16')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
                    ->getStyle('V5:V16')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
                    ->getStyle('C18:V18')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
                    ->getStyle('A5:B16')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
                ->getStyle('A18:V18')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('fcb8fb');

        $format = '0.000';
        $spreadsheet->getActiveSheet()->getStyle('C5:V19')->getNumberFormat()->setFormatCode($format);
      
       $spreadsheet->getActiveSheet()->removeRow(2);


        $spreadsheet->createSheet(); 


        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);

        $timestamp = "-".date('d-m-Y')."(".date('h-i-s-A',time()).")"; 

        $fileName = 'Sales_By_Months'.$timestamp.'.xlsx';

        //$fileName = 'Sales_By_Months.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

   
}

