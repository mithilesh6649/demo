<?php
namespace App\Http\Reports;

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
 
class GenerateSalesReport
{

    public function result()
    {

        $spreadsheet = new Spreadsheet();

        /**
         * first tab Report
         */

        $current_month = Carbon::now('m');
        $year = Carbon::now('Y');


        $data = DailySaleReport::select(DB::raw('DATE(created_at) as date') , DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent') , DB::raw('SUM(dine_in_cabin) as dine_in_cabin') , DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup') , DB::raw('SUM(home_delivery) as home_delivery') , DB::raw('SUM(buffet) as buffet') , DB::raw('SUM(talabat_TEM) as talabat_TEM') , DB::raw('SUM(talabat_TGO) as talabat_TGO') , DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM') , DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO') , DB::raw('SUM(v_thru) as v_thru') , DB::raw('SUM(mm_online) as mm_online') , DB::raw('SUM(osc) as osc') , DB::raw('SUM(garden) as garden') , DB::raw('SUM(others_gross) as others_gross') , DB::raw('SUM(discount) as discount') , DB::raw('SUM(complimentary) as complimentary') , DB::raw('SUM(sale_Return) as sale_Return') , DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual') , DB::raw('SUM(cash_shortage) as cash_shortage') , DB::raw('SUM(cash_overage) as cash_overage') , DB::raw('SUM(amex) as amex') , DB::raw('SUM(visa) as visa') , DB::raw('SUM(master) as master') , DB::raw('SUM(dinner) as dinner') , DB::raw('SUM(mm_online_link) as mm_online_link') , DB::raw('SUM(knet) as knet') , DB::raw('SUM(other_cards) as other_cards') , DB::raw('SUM(cheque) as cheque') , DB::raw('SUM(printed_gift_card) as printed_gift_card') , DB::raw('SUM(e_gift_card) as e_gift_card') , DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher') , DB::raw('SUM(cash_equivalent) as cash_equivalent') , DB::raw('SUM(talabat_credit) as talabat_credit') , DB::raw('SUM(deliveroo_credit) as deliveroo_credit') , DB::raw('SUM(v_thru_credit) as v_thru_credit') , DB::raw('SUM(others_credit) as others_credit') , DB::raw('SUM(gross_sale) as gross_sale') , DB::raw('SUM(discount_return) as discount_return') , DB::raw('SUM(net_sale) as net_sale') , DB::raw('SUM(cash_in_hand) as cash_in_hand') , DB::raw('SUM(cards_sale) as cards_sale') , DB::raw('SUM(cheque_cash) as cheque_cash') , DB::raw('SUM(credit_sale) as credit_sale') , DB::raw('SUM(total_collection) as total_collection') , DB::raw('SUM(cash_in_hand_opening_balance) as cash_in_hand_opening_balance') , DB::raw('SUM(cash_sales) as cash_sales') , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank') , DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance') ,)->whereMonth('created_at', $current_month)->groupBy('date')
            ->whereYear('created_at',$year)->get();

        $date = DailySaleReport::select(DB::raw('DATE(created_at) as date'))->whereMonth('created_at', $current_month)->groupBy('date')->whereYear('created_at',$year)
            ->get()
            ->pluck('date');


         $datevales=array();
        foreach($data as $d)
        {
            $datevales[date('d-M-Y',strtotime($d->date))]=$d;
        }

        //third report data from database
         $current_year=Carbon::now('Y');
         $data_value=DailySaleReport::select(DB::raw('Month(created_at) as month'),
                                        DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent'),
                                        DB::raw('SUM(dine_in_cabin) as dine_in_cabin'),
                                        DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup'),
                                        DB::raw('SUM(home_delivery) as home_delivery'),
                                        DB::raw('SUM(buffet) as buffet'),
                                        DB::raw('SUM(talabat_TEM) as talabat_TEM'),
                                        DB::raw('SUM(talabat_TGO) as talabat_TGO'),
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
                                        DB::raw('SUM(talabat_credit) as talabat_credit'),
                                        DB::raw('SUM(deliveroo_credit) as deliveroo_credit'),
                                        DB::raw('SUM(v_thru_credit) as v_thru_credit'),
                                        DB::raw('SUM(others_credit) as others_credit'),
                                        DB::raw('SUM(gross_sale) as gross_sale'),
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
                                    )->whereYear('created_at',$current_year)->groupBy('month')->get();

                  
        $month_datavalue = array();
        foreach ($data_value as $month_value)
        {
           $month_datavalue[$month_value->month] =$month_value;
            
        }
     
       //end of thired report

        //five tab bank deposit
        $monthdeposit = DailySaleReport::select('branch_id',DB::raw('DATE(created_at) as date') 
                                       , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'))
                                        ->whereMonth('created_at', $current_month)
                                        ->whereYear('created_at',$year)
                                        ->groupBy('date','branch_id')
                                        ->get();

               

         $dailymonthdepositbank=array();
         foreach ($monthdeposit as $value_bank) {
            $dailymonthdepositbank[date('d-M-Y',strtotime($value_bank->date))][$value_bank->branch_id]=$value_bank;
         }

         $branchbankdeposit=Branch::where('status','1')->get()->pluck('title_en','id');
                  
        //data from database using in report six
         $monthgross= DailySaleReport::select('branch_id',DB::raw('DATE(created_at) as date') 
                           , DB::raw('SUM(gross_sale) as gross_sale'))
                            ->whereMonth('created_at', $current_month)
                            ->whereYear('created_at',$year)
                            ->groupBy('date','branch_id')
                            ->get();

         $dailyvalue_gross=array();
         foreach ($monthgross as $value_gross) {
            $dailyvalue_gross[date('d-M-Y',strtotime($value_gross->date))][$value_gross->branch_id]=$value_gross;
         }

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:G1')
            ->setCellValue('A1', 'Period :')
            ->getStyle("A1:G1")
            ->getFont()
            ->setSize(12);

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('H1:AD1')
            ->setCellValue('H1', "MUGHAL MAHAL DAILY SALES REPORT F/M " . date('M-Y'))
            ->getStyle("H1:AD1")
            ->getFont()
            ->setSize(12);

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('AE1:AG1')
            ->setCellValue('AE1', 'Branch')
            ->getStyle("AE1:AG1")
            ->getFont()
            ->setSize(12)
            ->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('H1:AG1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:AG2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:AG1')
            ->getFont()
            ->setSize(12)
            ->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('A37:AG38')
            ->getFont()
            ->setSize(6)
            ->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:AG2')
            ->getFont()
            ->setSize(10);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:AG1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFF00');

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:AG3')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('9bdef2');

        $spreadsheet->getActiveSheet()
            ->getStyle('A37:AG38')
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
            ->getRowDimension('2')
            ->setRowHeight(22, 'pt');
        $spreadsheet->getActiveSheet()
            ->getRowDimension('37')
            ->setRowHeight(17, 'pt');
        $spreadsheet->getActiveSheet()
            ->getRowDimension('38')
            ->setRowHeight(17, 'pt');

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'italic' => true,
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
            ->getStyle('A2:AG2')
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
            ->getStyle('C2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('X2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:AG44')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A41:D42')
            ->getFont()
            ->getColor()
            ->setARGB('4ba658');

        $salereport = $spreadsheet->getActiveSheet()
            ->setTitle('Sales Report');

        $salereport->mergeCells('A2:B2')
            ->setCellValue('A2', 'PERIOD');
        $salereport->mergeCells('C2:W2')
            ->setCellValue('C2', "SALE  - GROSS & NET (DINE IN / BUFFET / TAKE AWAY / HOME DELIVERY)");
        $salereport->mergeCells('X2:AG2')
            ->setCellValue('X2', 'CASH FLOW ( CASH IN HAND  / CREDIT CARD / BANK DEPOSIT )');

        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:AG3')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:AG3')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:AG3')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:AG3')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:AG3')
            ->getFont()
            ->setSize(7);
        $spreadsheet->getActiveSheet()
            ->getRowDimension('3')
            ->setRowHeight(25, 'pt');

        $rowArray = ['DAY', 'DATE', 'ST.NO', 'Dine-In Restaurant', 'Dine-In Cabin', 'Take Away/Self Pickup', 'Home Delivery', 'Buffet', 'Talabat (TMP)', 'Talabat (TGO)', 'Deliveroo (TMP)', 'Deliveroo (TGO)', 'V-Thru', 'MM Online', 'OSC', 'Garden', 'Others', 'Net SALE', 'Discount', 'Complimentary', 'Sale Return', 'GROSS SALE', 'TOTAL', 'Credit Talabat', 'Credit Deliveroo', 'Credit V-Thru', 'CR/CARD MMGTC', 'Gift Card', 'CASH SCH', 'CASH ACTUAL', 'DIFF', 'CAS DEP /OP', ''];

        $i = 0;
        foreach (range('A', 'Z') as $columnID)
        {
            $col = $columnID . "3";
            $spreadsheet->getActiveSheet()
                ->getStyle($col)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getColumnDimension($columnID)->setWidth(17);
            $salereport->setCellValue($col, $rowArray[$i]);
            $i++;
        }

        foreach (range('A', 'G') as $columnID)
        {
            $col = "A" . $columnID . "3";
            $col_with = "A" . $columnID;
            $spreadsheet->getActiveSheet()
                ->getStyle($col)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getColumnDimension($col_with)->setWidth(17);
            $salereport->setCellValue($col, $rowArray[$i]);
            $i++;
        }

        $spreadsheet->getActiveSheet()
            ->getStyle('AC4:AC34')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('D37:AG38')
        //     ->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $lastcolval = array(
            '=AG3+AD4-AF4',
            '=AG4+AD5-AF5',
            '=AG5+AD6-AF6',
            '=AG6+AD7-AF7',
            '=AG7+AD8-AF8',
            '=AG8+AD9-AF9',
            '=AG9+AD10-AF10',
            '=AG10+AD11-AF11',
            '=AG11+AD12-AF12',
            '=AG12+AD13-AF13',
            '=AG13+AD14-AF14',
            '=AG14+AD15-AF15',
            '=AG15+AD16-AF16',
            '=AG16+AD17-AF17',
            '=AG17+AD18-AF18',
            '=AG18+AD19-AF19',
            '=AG19+AD20-AF20',
            '=AG20+AD21-AF21',
            '=AG21+AD22-AF22',
            '=AG22+AD23-AF23',
            '=AG23+AD24-AF24',
            '=AG24+AD25-AF25',
            '=AG25+AD26-AF26',
            '=AG26+AD27-AF27',
            '=AG27+AD28-AF28',
            '=AG28+AD29-AF29',
            '=AG29+AD30-AF30',
            '=AG30+AD31-AF31',
            '=AG31+AD32-AF32',
            '=AG32+AD33-AF33',
            '=AG33+AD34-AF34',
            '=AG34+AD35-AF35'
        );

        $spreadsheet->getActiveSheet()
            ->getStyle('AG4:AG35')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('AG4:AG35')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('AG4:AG35')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        
        $aDates = array();
        $oStart = new DateTime(date('Y-m-01', strtotime(date('Y-m-d'))));
        $oEnd = clone $oStart;
        $oEnd->add(new DateInterval("P1M"));

        while ($oStart->getTimestamp() < $oEnd->getTimestamp())
        {
            $aDates[] = $oStart->format('d-M-Y');
            $day[] = $oStart->format('D');
            $oStart->add(new DateInterval("P1D"));
        }

        for ($i = 0;$i <count($aDates);$i++)
        {
            $salereport->setCellValue('AG' . ($i + 4) , $lastcolval[$i]);
        }


        for ($i=0; $i <count($aDates); $i++) {
            if(in_array($aDates[$i],array_keys($datevales)))
            {

                $salereport->setCellValue('D'.($i+4), $datevales[$aDates[$i]]['dine_in_restaurent']);
                $salereport->setCellValue('E'.($i+4), $datevales[$aDates[$i]]['dine_in_cabin']);
                $salereport->setCellValue('F'.($i+4), $datevales[$aDates[$i]]['take_away_self_pickup']);
                $salereport->setCellValue('G'.($i+4), $datevales[$aDates[$i]]['home_delivery']);
                $salereport->setCellValue('H'.($i+4), $datevales[$aDates[$i]]['buffet']);
                $salereport->setCellValue('I'.($i+4), $datevales[$aDates[$i]]['talabat_TEM']);
                $salereport->setCellValue('J'.($i+4), $datevales[$aDates[$i]]['talabat_TGO']);
                $salereport->setCellValue('K'.($i+4), $datevales[$aDates[$i]]['deliveroo_TEM']);
                $salereport->setCellValue('L'.($i+4), $datevales[$aDates[$i]]['deliveroo_TGO']);
                $salereport->setCellValue('M'.($i+4), $datevales[$aDates[$i]]['v_thru']);
                $salereport->setCellValue('N'.($i+4), $datevales[$aDates[$i]]['mm_online']);
                $salereport->setCellValue('O'.($i+4), $datevales[$aDates[$i]]['osc']);
                $salereport->setCellValue('P'.($i+4), $datevales[$aDates[$i]]['garden']);
                $salereport->setCellValue('Q'.($i+4), $datevales[$aDates[$i]]['others_gross']);


                $salereport->setCellValue('S'.($i+4), $datevales[$aDates[$i]]['discount']);
                $salereport->setCellValue('T'.($i+4), $datevales[$aDates[$i]]['complimentary']);
                $salereport->setCellValue('U'.($i+4), $datevales[$aDates[$i]]['sale_Return']);

                $salereport->setCellValue('X'.($i+4), $datevales[$aDates[$i]]['talabat_credit']);
                $salereport->setCellValue('Y'.($i+4), $datevales[$aDates[$i]]['deliveroo_credit']);
                $salereport->setCellValue('Z'.($i+4), $datevales[$aDates[$i]]['v_thru_credit']);
                $salereport->setCellValue('AA'.($i+4), '0');
                $salereport->setCellValue('AB'.($i+4), $datevales[$aDates[$i]]['e_gift_card']);
                $salereport->setCellValue('AD'.($i+4), $datevales[$aDates[$i]]['cash_in_hand_actual']);
              
                

            }

                //text alignment
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
                            ->getStyle('Q'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $spreadsheet->getActiveSheet()
                            ->getStyle('S'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('T'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('U'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                 $spreadsheet->getActiveSheet()
                            ->getStyle('X'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $spreadsheet->getActiveSheet()
                            ->getStyle('Y'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('Z'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('AA'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('AB'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('AD'.($i+4))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                       
        }

        $netsell=array('=SUM(D4:O4)','=SUM(D5:O5)','=SUM(D6:O6)','=SUM(D7:O7)','=SUM(D8:O8)','=SUM(D9:O9)','=SUM(D10:O10)','=SUM(D11:O11)','=SUM(D12:O12)','=SUM(D13:O13)','=SUM(D14:O14)','=SUM(D15:O15)','=SUM(D16:O16)','=SUM(D17:O17)','=SUM(D18:O18)','=SUM(D19:O19)','=SUM(D20:O20)','=SUM(D21:O21)','=SUM(D22:O22)','=SUM(D23:O23)','=SUM(D24:O24)','=SUM(D25:O25)','=SUM(D26:O26)','=SUM(D27:O27)','=SUM(D28:O28)','=SUM(D29:O29)','=SUM(D30:O30)','=SUM(D31:O31)','=SUM(D32:O32)','=SUM(D33:O33)','=SUM(D34:O34)');

        $grasssale=array('=+R4+S4+T4+U4','=+R5+S5+T5+U5','=+R6+S6+T6+U6','=+R7+S7+T7+U7','=+R8+S8+T8+U8','=+R9+S9+T9+U9','=+R10+S10+T10+U10','=+R11+S11+T11+U11','=+R12+S12+T12+U12','=+R13+S13+T13+U13','=+R14+S14+T14+U14','=+R15+S15+T15+U15','=+R16+S16+T16+U16','=+R17+S17+T17+U17','=+R18+S18+T18+U18','=+R19+S19+T19+U19','=+R20+S20+T20+U20','=+R21+S21+T21+U21','=+R22+S22+T22+U22','=+R23+S23+T23+U23','=+R24+S24+T24+U24','=+R25+S25+T25+U25','=+R26+S26+T26+U26','=+R27+S27+T27+U27','=+R28+S28+T28+U28','=+R29+S29+T29+U29','=+R30+S30+T30+U30','=+R31+S31+T31+U31','=+R32+S32+T32+U32','=+R33+S33+T33+U33','=+R34+S34+T34+U34');

         $total=array('=+D4+E4+F4+G4+H4+I4+K4+M4+N4','=+D5+E5+F5+G5+H5+I5+K5+M5+N5','=+D6+E6+F6+G6+H6+I6+K6+M6+N6','=+D7+E7+F7+G7+H7+I7+K7+M7+N7','=+D8+E8+F8+G8+H8+I8+K8+M8+N8','=+D9+E9+F9+G9+H9+I9+K9+M9+N9','=+D10+E10+F10+G10+H10+I10+K10+M10+N10','=+D11+E11+F11+G11+H11+I11+K11+M11+N11','=+D12+E12+F12+G12+H12+I12+K12+M12+N12','=+D13+E13+F13+G13+H13+I13+K13+M13+N13','=+D14+E14+F14+G14+H14+I14+K14+M14+N14','=+D15+E15+F15+G15+H15+I15+K15+M15+N15','=+D16+E16+F16+G16+H16+I16+K16+M16+N16','=+D17+E17+F17+G17+H17+I17+K17+M17+N17','=+D18+E18+F18+G18+H18+I18+K18+M18+N18','=+D19+E19+F19+G19+H19+I19+K19+M19+N19','=+D20+E20+F20+G20+H20+I20+K20+M20+N20','=+D21+E21+F21+G21+H21+I21+K21+M21+N21','=+D22+E22+F22+G22+H22+I22+K22+M22+N22','=+D23+E23+F23+G23+H23+I23+K23+M23+N23','=+D24+E24+F24+G24+H24+I24+K24+M24+N24','=+D25+E25+F25+G25+H25+I25+K25+M25+N25','=+D26+E26+F26+G26+H26+I26+K26+M26+N26','=+D27+E27+F27+G27+H27+I27+K27+M27+N27','=+D28+E28+F28+G28+H28+I28+K28+M28+N28','=+D29+E29+F29+G29+H29+I29+K29+M29+N29','=+D30+E30+F30+G30+H30+I30+K30+M30+N30','=+D31+E31+F31+G31+H31+I31+K31+M31+N31','=+D32+E32+F32+G32+H32+I32+K32+M32+N32','=+D33+E33+F33+G33+H33+I33+K33+M33+N33','=+D34+E34+F34+G34+H34+I34+K34+M34+N34');

         $CASHSCH=array('=R4-X4-Y4-AA4-AB4-Z4','=R5-X5-Y5-AA5-AB5-Z5','=R6-X6-Y6-AA6-AB6-Z6','=R7-X7-Y7-AA7-AB7-Z7','=R8-X8-Y8-AA8-AB8-Z8','=R9-X9-Y9-AA9-AB9-Z9','=R10-X10-Y10-AA10-AB10-Z10','=R11-X11-Y11-AA11-AB11-Z11','=R12-X12-Y12-AA12-AB12-Z12','=R13-X13-Y13-AA13-AB13-Z13','=R14-X14-Y14-AA14-AB14-Z14','=R15-X15-Y15-AA15-AB15-Z15','=R16-X16-Y16-AA16-AB16-Z16','=R17-X17-Y17-AA17-AB17-Z17','=R18-X18-Y18-AA18-AB18-Z18','=R19-X19-Y19-AA19-AB19-Z19','=R20-X20-Y20-AA20-AB20-Z20','=R21-X21-Y21-AA21-AB21-Z21','=R22-X22-Y22-AA22-AB22-Z22','=R23-X23-Y23-AA23-AB23-Z23','=R24-X24-Y24-AA24-AB24-Z24','=R25-X25-Y25-AA25-AB25-Z25','=R26-X26-Y26-AA26-AB26-Z26','=R27-X27-Y27-AA27-AB27-Z27','=R28-X28-Y28-AA28-AB28-Z28','=R29-X29-Y29-AA29-AB29-Z29','=R30-X30-Y30-AA30-AB30-Z30','=R31-X31-Y31-AA31-AB31-Z31','=R32-X32-Y32-AA32-AB32-Z32','=R33-X33-Y33-AA33-AB33-Z33','=R34-X34-Y34-AA34-AB34-Z34');

         $diff=array('=AD4-AC4','=AD5-AC5','=AD6-AC6','=AD7-AC7','=AD8-AC8','=AD9-AC9','=AD10-AC10','=AD11-AC11','=AD12-AC12','=AD13-AC13','=AD14-AC14','=AD15-AC15','=AD16-AC16','=AD17-AC17','=AD18-AC18','=AD19-AC19','=AD20-AC20','=AD21-AC21','=AD22-AC22','=AD23-AC23','=AD24-AC24','=AD25-AC25','=AD26-AC26','=AD27-AC27','=AD28-AC28','=AD29-AC29','=AD30-AC30','=AD31-AC31','=AD32-AC32','=AD33-AC33','=AD34-AC34');

        for ($i = 1;$i <= count($aDates);$i++)
        {

            $col_A_data = "A" . ($i + 3);
            $col_B_data = "B" . ($i + 3);
            $col_R_data = "R" . ($i + 3);
            $col_V_data = "V" . ($i + 3);
            $col_W_data = "W" . ($i + 3);
            $col_AC_data = "AC" . ($i + 3);
            $col_AE_data = "AE" . ($i + 3);

            $spreadsheet->getActiveSheet()
                ->getRowDimension(($i + 3))->setRowHeight(20, 'pt');

            $spreadsheet->getActiveSheet()
                ->getStyle($col_A_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($col_A_data, $day[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_B_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($col_B_data, $aDates[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_R_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($col_R_data,$netsell[$i-1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_V_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($col_V_data,$grasssale[$i-1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_W_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($col_W_data,$total[$i-1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_AC_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($col_AC_data,$CASHSCH[$i-1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_AE_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($col_AE_data, $diff[$i-1]);

        }

        $spreadsheet->getActiveSheet()
            ->getStyle('A37')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A38')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A37:B37')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $salereport->mergeCells('A37:B37')
            ->setCellValue('A37', 'SUB TOTAL');

        $spreadsheet->getActiveSheet()
            ->getStyle('A38:B38')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $salereport->mergeCells('A38:B38')
            ->setCellValue('A38', '(%) TO NET SALE');

        $formulaarray = [null,'=SUM(D4:D36)','=SUM(E4:E36)','=SUM(F4:F36)','=SUM(G4:G36)','=SUM(H4:H36)','=SUM(I4:I36)','=SUM(J4:J36)','=SUM(K4:K36)','=SUM(L4:L36)','=SUM(M4:M36)','=SUM(N4:N36)','=SUM(O4:O36)',null,null,'=SUM(R4:R36)','=SUM(S4:S36)','=SUM(T4:T36)','=SUM(U4:U36)','=SUM(V4:V36)','=SUM(W4:W36)','=SUM(X4:X36)','=SUM(Y4:Y36)','=SUM(Z4:Z36)','=SUM(AA4:AA36)','=SUM(AB4:AB36)','=SUM(AC4:AC36)','=SUM(AD4:AD36)','=SUM(AE4:AE36)','=SUM(AF4:AF36)','=SUM(AG4:AG36)'];

        $secformulaarray = [null, '=D37/$R$37', '=E37/$R$37', '=F37/$R$37', '=G37/$R$37', '=H37/$R$37', '=I37/$R$37', '=J37/$R$37', '=K37/$R$37', '=L37/$R$37', '=M37/$R$37', '=N37/$R$37', '=O37/$R$37', null, null, '=R37/$R$37', '=S37/$R$37', '=T37/$R$37', '=U37/$R$37', '=V37/$R$37', '=W37/$R$37', '=X37/$R$37', '=Y37/$R$37', '=Z37/$R$37', '=AA37/$R$37', '=AB37/$R$37', '=AC37/$R$37', '=AD37/$R$37', '=AE37/$R$37', '=AF37/$R$37', '=AG37/$R$37'];

        $spreadsheet->getActiveSheet()
                    ->getStyle('A37:AG38')
                    ->getAlignment()
                    ->setWrapText(true);
        $spreadsheet->getActiveSheet()
                    ->getStyle('A37:AG38')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
                    ->getStyle('A37:AG38')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $j = 0;
        foreach (range('C', 'Z') as $columnID)
        {
            $spreadsheet->getActiveSheet()
                        ->getStyle($columnID . '37')->getBorders()
                        ->getOutline()
                        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                        ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                        ->getStyle($columnID . '37')->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $salereport->setCellValue($columnID . '37', $formulaarray[$j]);

            $spreadsheet->getActiveSheet()
                        ->getStyle($columnID . '38')->getBorders()
                        ->getOutline()
                        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                        ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                        ->getStyle($columnID . '38')->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($columnID . '38', $secformulaarray[$j]);

            $j++;
        }


        $j = $j - 1;
        foreach (range('A', 'G') as $columnID)
        {
            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $columnID . '37')->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $columnID . '37')->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $salereport->setCellValue('A' . $columnID . '37', $formulaarray[$j - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $columnID . '38')->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $columnID . '38')->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue('A' . $columnID . '38', $secformulaarray[$j - 1]);

            $j++;
        }

        $colval = array(
            'NET SALE',
            'NO. OF DAYS',
            'AVG SALE/DAY',
            'PROJECTED  SALE'
        );

        $colval39 = array(
            '=V37',
            '=COUNT(D4:D35)',
            '=D39/D40',
            '=D41*D40'
        );
        $colvalR = array(
            'NET SALE',
            'EXPENSE ',
            'CR/CARD ',
            'CASH IN HAND'
        );
        $colvalV = array(
            '=V37',
            '=#REF!',
            '=X37+AA37',
            '=AC37'
        );

        $l = 0;

        $spreadsheet->getActiveSheet()
            ->getStyle('D39:D42')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('D39:D42')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('D39:D42')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('V39:V42')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('V39:V42')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('V39:V42')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $salereport->setCellValue('A36', 'ADJST');

        for ($i = 39;$i <= 42;$i++)
        {

            $salereport->mergeCells('A' . $i . ':B' . $i)->setCellValue('A' . $i, $colval[$l]);

            $spreadsheet->getActiveSheet()
                ->getStyle('D' . $i)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle('V' . $i)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $salereport->setCellValue('D' . $i, $colval39[$l]);

            $salereport->setCellValue('R' . $i, $colvalR[$l]);

            $salereport->setCellValue('V' . $i, $colvalV[$l]);

            $l++;
        }

        $salereport->setCellValue('AA39', '=AA37+X37');
        $salereport->setCellValue('AC41', 'CASH DIFF');
        $salereport->setCellValue('AD41', '=AD37-AC37');

        $spreadsheet->createSheet();

        /**
         * second tab start
         */

        $spreadsheet->setActiveSheetIndex(1)
            ->mergeCells('A1:G1')
            ->setCellValue('A1', 'Period :')
            ->getStyle("A1:G1")
            ->getFont()
            ->setSize(12);

        $spreadsheet->setActiveSheetIndex(1)
            ->mergeCells('I1:V1')
            ->setCellValue('I1', "MUGHAL MAHAL DAILY SALES REPORT F/M Jan'2022 ")
            ->getStyle("I1:V1")
            ->getFont()
            ->setSize(12);

        $spreadsheet->getActiveSheet()
            ->getStyle('I1:V1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:V2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:V1')
            ->getFont()
            ->setSize(12)
            ->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:V1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFF00');

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:V4')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('c6f5ef');

        $spreadsheet->getActiveSheet()
            ->getStyle('A38:V39')
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
            ->getRowDimension('37')
            ->setRowHeight(17, 'pt');
        $spreadsheet->getActiveSheet()
            ->getRowDimension('38')
            ->setRowHeight(17, 'pt');

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'italic' => true,
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
            ->getStyle('A2:V2')
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
            ->getStyle('E38:V38')
            ->getFont()
            ->getColor()
            ->setARGB('cf1b21');

        $payment = $spreadsheet->getActiveSheet()
            ->setTitle('Payment');

        $payment->mergeCells('A2:B2')
            ->setCellValue('A2', 'PERIOD');
        $payment->mergeCells('C2:V2')
            ->setCellValue('C2', "SALE  - GROSS & NET (DINE IN / BUFFET / TAKE AWAY / HOME DELIVERY)");

        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getFont()
            ->setSize(7);
        $spreadsheet->getActiveSheet()
            ->getRowDimension('4')
            ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('3')
            ->setRowHeight(25, 'pt');

        $payment->setCellValue('A3', 'Day');
        $payment->setCellValue('B3', 'Date');
        $payment->setCellValue('C3', 'St No');

        $payment->mergeCells('E3:K3')
            ->setCellValue('E3', "Mughal Mahal Credit");
        $payment->mergeCells('L3:P3')
            ->setCellValue('L3', "MM App");
        $payment->mergeCells('Q3:T3')
            ->setCellValue('Q3', "Credit");

        $spreadsheet->getActiveSheet()
            ->getStyle('E3:K3')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));
        $spreadsheet->getActiveSheet()
            ->getStyle('Q3:T3')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('V3')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

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
            '',
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
        foreach (range('A', 'V') as $columnID)
        {
            $col = $columnID . "4";

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

        $aDates = array();
        $oStart = new DateTime(date('Y-m-01', strtotime(date('Y-m-d'))));
        $oEnd = clone $oStart;
        $oEnd->add(new DateInterval("P1M"));

        while ($oStart->getTimestamp() < $oEnd->getTimestamp())
        {
            $aDates[] = $oStart->format('d-M-Y');
            $day[] = $oStart->format('D');
            $oStart->add(new DateInterval("P1D"));
        }


        for ($i=0; $i <count($aDates); $i++) {

            if(in_array($aDates[$i],array_keys($datevales)))
            {

                $payment->setCellValue('D'.($i+5), $datevales[$aDates[$i]]['cash_sales']);
                $payment->setCellValue('E'.($i+5), $datevales[$aDates[$i]]['amex']);
                $payment->setCellValue('F'.($i+5), $datevales[$aDates[$i]]['visa']);
                $payment->setCellValue('G'.($i+5), $datevales[$aDates[$i]]['master']);
                $payment->setCellValue('H'.($i+5), $datevales[$aDates[$i]]['dinner']);
                $payment->setCellValue('I'.($i+5), $datevales[$aDates[$i]]['mm_online_link']);
                $payment->setCellValue('J'.($i+5), $datevales[$aDates[$i]]['knet']);
                $payment->setCellValue('K'.($i+5), $datevales[$aDates[$i]]['other_cards']);
                $payment->setCellValue('L'.($i+5), $datevales[$aDates[$i]]['cheque']);
                $payment->setCellValue('M'.($i+5), $datevales[$aDates[$i]]['printed_gift_card']);
                $payment->setCellValue('N'.($i+5), $datevales[$aDates[$i]]['e_gift_card']);
                $payment->setCellValue('O'.($i+5), $datevales[$aDates[$i]]['gift_coupon_voucher']);
                $payment->setCellValue('P'.($i+5), $datevales[$aDates[$i]]['cash_equivalent']);
                $payment->setCellValue('Q'.($i+5), $datevales[$aDates[$i]]['talabat_credit']);
                $payment->setCellValue('R'.($i+5), $datevales[$aDates[$i]]['deliveroo_credit']);
                $payment->setCellValue('S'.($i+5), $datevales[$aDates[$i]]['v_thru_credit']);
                $payment->setCellValue('T'.($i+5), $datevales[$aDates[$i]]['others_credit']);
                $payment->setCellValue('U'.($i+5), $datevales[$aDates[$i]]['cash_overage']);

            }
            
                //text alignment
                $spreadsheet->getActiveSheet()
                            ->getStyle('D'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('E'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('F'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('G'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('H'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('I'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('J'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('K'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('L'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('M'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('N'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('O'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('P'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('Q'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $spreadsheet->getActiveSheet()
                            ->getStyle('R'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('S'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('T'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()
                            ->getStyle('U'.($i+5))->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             
        }


        $Sno = 47003;
         
         $total=array('=SUM(E5:U5)','=SUM(E6:U6)','=SUM(E7:U7)','=SUM(E8:U8)','=SUM(E9:U9)','=SUM(E10:U10)','=SUM(E11:U11)','=SUM(E12:U12)','=SUM(E13:U13)','=SUM(E14:U14)','=SUM(E15:U15)','=SUM(E16:U16)','=SUM(E17:U17)','=SUM(E18:U18)','=SUM(E19:U19)','=SUM(E20:U20)','=SUM(E21:U21)','=SUM(E22:U22)','=SUM(E23:U23)','=SUM(E24:U24)','=SUM(E25:U25)','=SUM(E26:U26)','=SUM(E27:U27)','=SUM(E28:U28)','=SUM(E29:U29)','=SUM(E30:U30)','=SUM(E31:U31)','=SUM(E32:U32)','=SUM(E33:U33)','=SUM(E34:U34)','=SUM(E35:U35)');

        for ($i = 1;$i <= count($aDates);$i++)
        {

            $col_A_data = "A" . ($i + 4);
            $col_B_data = "B" . ($i + 4);
            $col_c_data = "C" . ($i + 4);
            $col_V_data = "V" . ($i + 4);

            $spreadsheet->getActiveSheet()
                ->getRowDimension(($i + 4))->setRowHeight(20, 'pt');

            $spreadsheet->getActiveSheet()
                ->getStyle($col_A_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $payment->setCellValue($col_A_data, $day[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_B_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $payment->setCellValue($col_B_data, $aDates[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_c_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $payment->setCellValue($col_c_data, $Sno);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_V_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $payment->setCellValue($col_V_data,$total[$i-1]);

            $Sno++;

        }

        //apply all column border
        foreach (range('A', 'V') as $colmn)
        {
            for ($i = 1;$i <= 32;$i++)
            {
                $spreadsheet->getActiveSheet()
                    ->getStyle($colmn . ($i + 3))->getBorders()
                    ->getOutline()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
        }

        $spreadsheet->getActiveSheet()
            ->getStyle('A37')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A38')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $payment->mergeCells('A38:B38')
            ->setCellValue('A38', 'SUB TOTAL');

        $formulaarray = ['E38' => '=SUM(E5:E37)', 'F38' => '=SUM(F5:F37)', 'G38' => '=SUM(G5:G37)', 'H38' => '=SUM(H5:H37)', 'I38' => '=SUM(I5:I37)', 'J38' => '=SUM(J5:J37)', 'K38' => '=SUM(K5:K37)', 'L38' => '=SUM(L5:L37)', 'V38' => '=SUM(V5:V37)'];

        $spreadsheet->getActiveSheet()
            ->getStyle('A38:AG39')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A38:AG39')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A38:AG39')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        foreach (range('A', 'V') as $columnID)
        {

            $key = $columnID . '38';
            $keysec = $columnID . '39';

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
            ->getStyle('V38:V39')
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
            ->getStyle('V4')
            ->getBorders()
            ->getRight()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A3:A39')
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $payment->setCellValue('A37', 'ADJST');

        for ($i = 40;$i <= 43;$i++)
        {

            $spreadsheet->getActiveSheet()
                ->getStyle('E' . $i)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $payment->setCellValue('E' . $i . $i, '');

        }

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:V45')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->createSheet();

        /**
         * third report start  Summary By Branch dev_135 
         */

        $spreadsheet->setActiveSheetIndex(2)
            ->mergeCells('A1:U1')
            ->setCellValue('A1', "MUGHAL MAHAL : MONTHLY REPORT F/M Jan ".date('Y'))
            ->getStyle("A1:U1")
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
            ->getStyle('A1:U1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:U2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:U1')
            ->getFont()
            ->setSize(12)
            ->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:U4')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('fcda51');

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'italic' => true,
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
            ->getStyle('A2:U2')
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

        $Summary = $spreadsheet->getActiveSheet()
            ->setTitle('Summary By Branch');

        $Summary->mergeCells('A2:R2')
            ->setCellValue('A2', 'SERVICE/PRODUCT WISE SALES');
        $Summary->mergeCells('S2:U2')
            ->setCellValue('S2', "PERIOD: ");

        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:U32')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getFont()
            ->setSize(7);
        $spreadsheet->getActiveSheet()
            ->getRowDimension('4')
            ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('3')
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

        $rowarray2 = ['A4' => null, 'B4' => 'A/C', 'C4' => 'Cr', 'D4' => 'Cr', 'E4' => 'Cr', 'F4' => 'Cr', 'G4' => 'Cr', 'H4' => null, 'I4' => NULL, 'J4' => 'Cr', 'K4' => null, 'L4' => 'Cr', 'M4' => null, 'N4' => null, 'O4' => null, 'P4' => null, 'Q4' => 'Cr', 'R4' => 'Dr', 'S4' => null, 'T4' => null, 'U4' => 'Dr'];

        $i = 0;
        foreach (range('A', 'U') as $columnID)
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
        foreach (range('A', 'U') as $colmn)
        {
            for ($i = 1;$i <= 13;$i++)
            {
                $spreadsheet->getActiveSheet()
                    ->getStyle($colmn . ($i + 3))->getBorders()
                    ->getOutline()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
        }

        $branches = Branch::where('status',Branch::ACTIVE)->pluck('title_en');
        $branch = $branches;

        $dates = [];
        foreach($branches as $branch){
            $dates[] = date('M-Y');
        }

        $rowArray_ = $branches->toArray();
        $columnArray_ = array_chunk($rowArray_, 1);

        $spreadsheet->getActiveSheet()->fromArray(
            $columnArray_,
            null, 
            "A5" 
        );

        $columnArray_2 = array_chunk($dates, 1);

        $spreadsheet->getActiveSheet()->fromArray(
            $columnArray_2,
            null, 
            "B5" 
        );

        // adding code for dynamic data
        $number = 5;
        for ($i=1; $i <= count($branches); $i++) { 
			$sales = [];
			for ($j=1; $j <= $column_count; $j++) { 
				$sales [] = $this->getSalesByBranch($column_names[$j+1],$branches[$i-1]);
			}
			$rowArrayData = $sales;

			$spreadsheet->getActiveSheet()->fromArray(
				$rowArrayData,
				null, 
				"C".$number 
			);
			$number++;
		}
        // adding code for dynamic data
        
        $Summary->mergeCells('A'.$number.':B'.$number.'')
            ->setCellValue('A'.$number, 'SUB TOTAL');

        $spreadsheet->getActiveSheet()
            ->getStyle('A'.$number.':U'.$number)
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A'.$number.':U'.$number)
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A'.$number.':U'.$number)
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $alpha = 'C';
		for ($i=1; $i <= $column_count; $i++) { 
            $spreadsheet->getActiveSheet()->setCellValue($alpha."".$number, "=SUM(".$alpha."5:".$alpha."".$number.")");
            $alpha++;
        }

        $spreadsheet->getActiveSheet()
            ->getStyle('I1:I32')
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->getActiveSheet()
            ->getStyle('Q1:Q32')
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));
        $spreadsheet->getActiveSheet()
            ->getStyle('A1:A'.$number)
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));
        $spreadsheet->getActiveSheet()
            ->getStyle('U3:U'.$number)
            ->getBorders()
            ->getRight()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A5:Z32')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->createSheet();

        /**
         * create fourth Report Summary By Month
         */

        $spreadsheet->setActiveSheetIndex(3)
            ->mergeCells('A1:U1')
            ->setCellValue('A1', "MUGHAL MAHAL : MONTHLY REPORT F/Y  ".date('Y'))
            ->getStyle("A1:U1")
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
            ->getStyle('A1:U1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:U2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:U1')
            ->getFont()
            ->setSize(12)
            ->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:U4')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('fcda51');

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'italic' => true,
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
            ->getStyle('A2:U2')
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
            ->setTitle('Summary By Month');

        $SummaryMonth->mergeCells('A2:R2')
            ->setCellValue('A2', 'SERVICE/PRODUCT WISE SALES');
        $SummaryMonth->mergeCells('S2:U2')
            ->setCellValue('S2', "PERIOD: ");

        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:U34')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:V4')
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

        $rowarray2 = ['A4' => null, 'B4' => 'A/C', 'C4' => 'Cr', 'D4' => 'Cr', 'E4' => 'Cr', 'F4' => 'Cr', 'G4' => 'Cr', 'H4' => null, 'I4' => NULL, 'J4' => 'Cr', 'K4' => null, 'L4' => 'Cr', 'M4' => null, 'N4' => null, 'O4' => null, 'P4' => null, 'Q4' => 'Cr', 'R4' => 'Dr', 'S4' => null, 'T4' => null, 'U4' => 'Dr'];

        $i = 0;
        foreach (range('A', 'U') as $columnID)
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

        $aDates = array();
        $oStart = new DateTime('2022-01-01');
        $oEnd = clone $oStart;
        $oEnd->add(new DateInterval("P1M"));

        while ($oStart->getTimestamp() < $oEnd->getTimestamp())
        {
            $aDates[] = $oStart->format('M-Y');
            $day[] = $oStart->format('D');
            $oStart->add(new DateInterval("P1D"));
        }

        $col_q = array(
            '=C5+D5+E5+F5+G5+H5+I5+J5+K5+L5+M5+N5+O5+P5',
            '=C6+D6+E6+F6+G6+H6+I6+J6+K6+L6+M6+N6+O6+P6',
            '=C7+D7+E7+F7+G7+H7+I7+J7+K7+L7+M7+N7+O7+P7',
            '=C8+D8+E8+F8+G8+H8+I8+J8+K8+L8+M8+N8+O8+P8',
            '=C9+D9+E9+F9+G9+H9+I9+J9+K9+L9+M9+N9+O9+P9',
            '=C10+D10+E10+F10+G10+H10+I10+J10+K10+L10+M10+N10+O10+P10',
            '=C11+D11+E11+F11+G11+H11+I11+J11+K11+L11+M11+N11+O11+P11',
            '=C12+D12+E12+F12+G12+H12+I12+J12+K12+L12+M12+N12+O12+P12',
            '=C13+D13+E13+F13+G13+H13+I13+J13+K13+L13+M13+N13+O13+P13',
            '=C14+D14+E14+F14+G14+H14+I14+J14+K14+L14+M14+N14+O14+P14',
            '=C15+D15+E15+F15+G15+H15+I15+J15+K15+L15+M15+N15+O15+P15',
            '=C16+D16+E16+F16+G16+H16+I16+J16+K16+L16+M16+N16+O16+P16'
        );

        $col_w = array(
            '=+Q5+R5+S5+T5',
            '=+Q6+R6+S6+T6',
            '=+Q7+R7+S7+T7',
            '=+Q8+R8+S8+T8',
            '=+Q9+R9+S9+T9',
            '=+Q10+R10+S10+T10',
            '=+Q11+R11+S11+T11',
            '=+Q12+R12+S12+T12',
            '=+Q13+R13+S13+T13',
            '=+Q14+R14+S14+T14',
            '=+Q15+R15+S15+T15',
            '=+Q16+R16+S16+T16'
        );

        for ($i = 1;$i <= 12;$i++)
        {

            $col_A_data = "A" . ($i + 4);
            $col_B_data = "B" . ($i + 4);
            $col_q_data = "Q" . ($i + 4);
            $col_u_data = "U" . ($i + 4);

            $spreadsheet->getActiveSheet()
                ->getRowDimension(($i + 4))->setRowHeight(20, 'pt');

            $spreadsheet->getActiveSheet()
                ->getStyle($col_A_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $SummaryMonth->setCellValue($col_A_data, ($i));

            $spreadsheet->getActiveSheet()
                ->getStyle($col_B_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $SummaryMonth->setCellValue($col_B_data, date("M-y", mktime(0, 0, 0, $i, 1, date("Y"))));

            $spreadsheet->getActiveSheet()
                ->getStyle($col_q_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $SummaryMonth->setCellValue($col_q_data, $col_q[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_u_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $SummaryMonth->setCellValue($col_u_data, $col_w[$i - 1]);

              if(in_array((int)date("m", mktime(0, 0, 0, $i, 1, date("Y"))),array_keys($month_datavalue))) {
                     
                 
                $SummaryMonth->setCellValue('C'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['dine_in_restaurent']);
                $SummaryMonth->setCellValue('D'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['dine_in_cabin']);
                $SummaryMonth->setCellValue('E'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['take_away_self_pickup']);
                $SummaryMonth->setCellValue('F'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['home_delivery']);
                $SummaryMonth->setCellValue('G'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['buffet']);
                $SummaryMonth->setCellValue('H'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['talabat_TEM']);
                $SummaryMonth->setCellValue('I'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['talabat_TGO']);
                $SummaryMonth->setCellValue('J'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['deliveroo_TEM']);
                $SummaryMonth->setCellValue('K'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['deliveroo_TGO']);
                $SummaryMonth->setCellValue('L'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['v_thru']);
                $SummaryMonth->setCellValue('M'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['mm_online']);
                $SummaryMonth->setCellValue('N'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['osc']);
                $SummaryMonth->setCellValue('O'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['garden']);
                $SummaryMonth->setCellValue('P'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['others_gross']);
                $SummaryMonth->setCellValue('R'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['discount']);
                $SummaryMonth->setCellValue('S'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['complimentary']);
                $SummaryMonth->setCellValue('T'.($i+4), $month_datavalue[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))]['sale_Return']);
                

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

        }

        $SummaryMonth->mergeCells('A18:B18')
            ->setCellValue('A18', 'SUB TOTAL');

        $formulaarray = ['C' => '=SUM(C5:C17)', 'D' => '=SUM(D5:D17)', 'E' => '=SUM(E5:E17)', 'F' => '=SUM(F5:F17)', 'G' => '=SUM(G5:G17)', 'H' => '=SUM(H5:H17)', 'J' => '=SUM(J5:J17)', 'L' => '=SUM(L5:L17)', 'M' => '=SUM(M5:M17)', 'Q' => '=SUM(Q5:Q17)', 'R' => '=SUM(R5:R17)', 'U' => '=SUM(U5:U17)'];

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

        foreach (range('A', 'U') as $columnID)
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

        //apply all column border
        foreach (range('A', 'U') as $colmn)
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
            ->getStyle('A1:A18')
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));
        $spreadsheet->getActiveSheet()
            ->getStyle('U3:U19')
            ->getBorders()
            ->getRight()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

         $spreadsheet->getActiveSheet()
            ->getStyle('I1:I34')
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->getActiveSheet()
            ->getStyle('Q1:Q34')
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->getActiveSheet()
                    ->getStyle('Q5:Q16')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
                    ->getStyle('U5:U16')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
                    ->getStyle('C18:U18')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
                ->getStyle('A18:U18')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('fcb8fb');

        $spreadsheet->createSheet();

        /**
         * start five Report BANK DEP
         */

        $spreadsheet->setActiveSheetIndex(4)
            ->mergeCells('A1:H1')
            ->setCellValue('A1', "MUGHAL MAHAL-BRANCH WISE SALES CASH DEPOSIT")
            ->getStyle("A1:H1")
            ->getFont()
            ->setSize(12)
            ->setItalic(true);
        
        $rowname=array();
        foreach(range('A','Z') as $rowna){
             $rowname[]=$rowna;
        }
         foreach(range('A','Z') as $rowna){
             $rowname[]='A'.$rowna;
        }

        $firstar = array(
                    'Date',
                    'Day ', 
                    );

        $thirdaar=array('TOTAL','Notes');

        $branch_namepe=Branch::select('title_en')->where('status','1')->get()->pluck('title_en')->toArray();
        $rowArray=array_merge($firstar,$branch_namepe,$thirdaar);
         
         $branch_na=Branch::select('title_en','id')->where('status','1')->get()->pluck('title_en','id');

        $spreadsheet->setActiveSheetIndex(4)
            ->mergeCells('I1:'.$rowname[count($rowArray)-2].'1')
            ->setCellValue('I1', date('F Y',strtotime(date('d-m-Y'))))
            ->getStyle("I1:M1")
            ->getFont()
            ->setSize(12)
            ->setItalic(true);

        $spreadsheet->setActiveSheetIndex(4)
            ->setCellValue($rowname[count($rowArray)-1].'1', "Month & Year")
            ->getStyle($rowname[count($rowArray)-1]."1")
            ->getFont()
            ->setSize(8)
            ->setItalic(true);

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
            ->getStyle('A1:U1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getFont()
            ->setSize(10)
            ->setItalic(false);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:'.$rowname[count($rowArray)-1].'1')
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

       
        //dd($rowArray);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
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

        $BANKDEP = $spreadsheet->getActiveSheet()
            ->setTitle('BANK DEP');

        $BANKDEP->mergeCells('C2:'.$rowname[count($rowArray)-2].'2')
            ->setCellValue('C2', 'CASH IN HAND - ACTUAL');
        $BANKDEP->setCellValue($rowname[count($rowArray)-1].'2', "Observation ");

        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)-1].'3')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)-1].'3')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)-1].'3')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)-1].'3')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)-1].'3')
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


      

        //apply all column border
        foreach (range('A',$rowname[count($rowArray)-1]) as $colmn)
        {

            for ($i = 1;$i <= 34;$i++)
            {
                $spreadsheet->getActiveSheet()
                    ->getStyle($colmn . ($i + 3))->getBorders()
                    ->getOutline()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
        }

        $i = 0;
        foreach (range('A',$rowname[count($rowArray)-1]) as $columnID)
        {
            $col = $columnID . "3";

            $spreadsheet->getActiveSheet()
                ->getStyle($col)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getColumnDimension($columnID)->setWidth(17);
            $BANKDEP->setCellValue($col, $rowArray[$i]);
            $i++;
        }

        $aDates = array();
        $oStart = new DateTime(date('Y-m-01', strtotime(date('Y-m-d'))));
        $oEnd = clone $oStart;
        $oEnd->add(new DateInterval("P1M"));

        while ($oStart->getTimestamp() < $oEnd->getTimestamp())
        {
            $aDates[] = $oStart->format('d-M-Y');
            $day[] = $oStart->format('D');
            $oStart->add(new DateInterval("P1D"));
        }

        //fill data in all branch wise cash deposit
        for ($i = 1;$i <=count($aDates);$i++)
        {
            if(in_array($aDates[$i-1],array_keys($dailymonthdepositbank)))
            {
              $j=0;
              foreach($branch_na as $key=>$val)
              {
                if(in_array($key,array_keys($dailymonthdepositbank[ $aDates[$i-1] ]))){
                   
                     $BANKDEP->setCellValue($rowname[$j+2].($i+3),$dailymonthdepositbank[$aDates[$i-1]][$key]['cash_deposit_in_bank']); 
                 }
                $j++;
              }
            }
        }
        
       $spreadsheet->getActiveSheet()
                    ->getStyle('C4:'.$rowname[count($rowArray)-2].count($aDates))->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

         
         $col_total=array();

         for ($i = 1;$i <=count($aDates);$i++){

          $col_total[]='=SUM(C'.($i+3).':'.$rowname[count($rowArray)-3].($i+3).')';
        
         
        }

        

          
        for ($i = 1;$i <=count($aDates);$i++)
        {

            $col_A_data = "A" . ($i + 3);
            $col_B_data = "B" . ($i + 3);
            $cols_total = $rowname[count($rowArray)-2]. ($i + 3);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_A_data)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle($col_B_data)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle($cols_total)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getRowDimension(($i + 3))->setRowHeight(20, 'pt');

            $spreadsheet->getActiveSheet()
                ->getStyle($col_A_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $BANKDEP->setCellValue($col_A_data, $aDates[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_B_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $BANKDEP->setCellValue($col_B_data, $day[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($cols_total)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $BANKDEP->setCellValue($cols_total, $col_total[$i - 1]);
        }
           

        $BANKDEP->setCellValue('A36', "NO.DAYS SALE");

        $BANKDEP->setCellValue('A38', "CASH ACT-TTL");

    

        $spreadsheet->getActiveSheet()
            ->getStyle('B36:M38')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('B36:M38')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('B36:M38')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $colbtoma = array(
            'As on-day',
           
        );
        $colbtom2 = array(
            'Days/Month',
            '=COUNT(A4:A35)',
            '=C37',
            '=C37',
            '=C37',
            '=D37',
            '=E37',
            '=F37',
            '=G37',
            '=H37',
            '=I37',
            '=C37',
            '=C37',
            '=C37',
            '=C37',
            '=C37',
            '=C37',
            '=C37',
            '=C37',
            '=C37',
        );

        $colbtom3a = array(
            'As on Date',
        );
         
         $colbtom3b=array();
         $colbtomb=array();
       
        foreach(range('C', $rowname[count($rowArray)-2]) as $rowval){

          $colbtom3b[]='=SUM('.$rowval.'4:'.$rowval.'35)';
          $colbtomb[]='=COUNT('.$rowval.'4:'.$rowval.'35)';
         
        }
        $colbtom3=array_merge($colbtom3a,$colbtom3b);
        $colbtom=array_merge($colbtoma,$colbtomb);
        
       

        $i = 0;
        $spreadsheet->getActiveSheet()
            ->getRowDimension('36')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('37')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('38')
            ->setRowHeight(20, 'pt');
  


        foreach (range('B',$rowname[count($rowArray)-2]) as $columnID)
        {
            $key = $columnID . '36';
            $key2 = $columnID . '37';
            $key3 = $columnID . '38';

            $spreadsheet->getActiveSheet()
                ->getStyle($key)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle($key)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $spreadsheet->getActiveSheet()
                ->getStyle($key2)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle($key2)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $spreadsheet->getActiveSheet()
                ->getStyle($key3)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle($key3)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $BANKDEP->setCellValue($key, $colbtom[$i]);

            $BANKDEP->setCellValue($key2, count($aDates));

            $BANKDEP->setCellValue($key3, $colbtom3[$i]);

            $i++;

        }

        $spreadsheet->getActiveSheet()
            ->getStyle('A38:'.$rowname[count($rowArray)-1].'38')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE)
            ->setColor(new Color('000000'));
        $spreadsheet->getActiveSheet()
            ->getStyle($rowname[count($rowArray)-1].'1:'.$rowname[count($rowArray)-1].'40')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:'.$rowname[count($rowArray)-1].'40')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $BANKDEP->mergeCells('A39:'.$rowname[count($rowArray)-2].'39');
        $spreadsheet->getActiveSheet()
            ->getStyle('A39:'.$rowname[count($rowArray)-2].'39')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('707371');

        $spreadsheet->getActiveSheet()
            ->getStyle('A38:'.$rowname[count($rowArray)-2].'38')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
            ->getStyle('A36')
            ->getFont()
            ->getColor()
            ->setARGB('e3248a');

      
        $spreadsheet->createSheet();

        /**
         * start six tab Daily Sales Branch Wise
         */

        $spreadsheet->setActiveSheetIndex(5)
            ->mergeCells('A1:J1')
            ->setCellValue('A1', "MUGHAL MAHAL-BRANCH WISE GROSS SALES REPORT- ".date('M'))
            ->getStyle("A1:J1")
            ->getFont()
            ->setSize(12)
            ->setItalic(true);
        
        $rowname=array();
        foreach(range('A','Z') as $rowna){
             $rowname[]=$rowna;
        }
         foreach(range('A','Z') as $rowna){
             $rowname[]='A'.$rowna;
        }

        $firstar = array(
                    'Date',
                    'Day ', 
                    );

        $thirdaar=array('TOTAL');

        $branch_namepe=Branch::select('title_en')->where('status','1')->get()->pluck('title_en')->toArray();
        $rowArray=array_merge($firstar,$branch_namepe,$thirdaar);
              
        $aDates = array();
        $oStart = new DateTime(date('Y-m-01', strtotime(date('Y-m-d'))));
        $oEnd = clone $oStart;
        $oEnd->add(new DateInterval("P1M"));

        while ($oStart->getTimestamp() < $oEnd->getTimestamp())
        {
            $aDates[] = $oStart->format('d-M-Y');
            $day[] = $oStart->format('D');
            $oStart->add(new DateInterval("P1D"));
        }

        $spreadsheet->setActiveSheetIndex(5)
            ->mergeCells('k1:'.$rowname[count($rowArray)-2].'1')
            ->setCellValue('K1', date('F Y'))
            ->getStyle("K1:M1")
            ->getFont()
            ->setSize(12)
            ->setItalic(true);

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
            ->getStyle('A1:'.$rowname[count($rowArray)-1].'1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getFont()
            ->setSize(10)
            ->setItalic(false);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:'.$rowname[count($rowArray)-1].'2')
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

        $DailySales = $spreadsheet->getActiveSheet()
            ->setTitle('Daily Sales Branch Wise');

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)-1].'2')
            ->getFont()
            ->setSize(7);
        $spreadsheet->getActiveSheet()
            ->getRowDimension('4')
            ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('2')
            ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('18')
            ->setRowHeight(20, 'pt');

        //apply all column border
        foreach (range('A',$rowname[count($rowArray)-1]) as $colmn)
        {

            for ($i = 1;$i <= 34;$i++)
            {
                $spreadsheet->getActiveSheet()
                    ->getStyle($colmn . ($i + 2))->getBorders()
                    ->getOutline()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
        } 

        $i = 0;
        foreach (range('A',$rowname[count($rowArray)-1]) as $columnID)
        {
            $col = $columnID . "2";

            $spreadsheet->getActiveSheet()
                ->getStyle($col)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getColumnDimension($columnID)->setWidth(17);
            $DailySales->setCellValue($col, $rowArray[$i]);
            $i++;
        }


      $col_total=array();
        $m=3;

        for ($i = 1;$i <=count($aDates);$i++){

            $col_total[]='=SUM(C'.$m.':'.$rowname[count($rowArray)-2].$m.')'; 
            $m++;    
        }

    
        for ($i = 1;$i <=count($aDates);$i++)
        {

            $col_A_data = "A" . ($i + 2);
            $col_B_data = "B" . ($i + 2);
            $cols_total = $rowname[count($rowArray)-1]. ($i + 2);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_A_data)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle($col_B_data)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle($cols_total)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getRowDimension(($i + 3))->setRowHeight(20, 'pt');

            $spreadsheet->getActiveSheet()
                ->getStyle($col_A_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($col_A_data, $aDates[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($col_B_data)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($col_B_data, $day[$i - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle($cols_total)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($cols_total, $col_total[$i - 1]);
        }

        $DailySales->setCellValue('A36', "NO.DAYS SALE");

        $DailySales->setCellValue('A38', "CASH ACT-TTL");

        $spreadsheet->getActiveSheet()
            ->getStyle('B36:'.$rowname[count($rowArray)-2].'38')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('B36:'.$rowname[count($rowArray)-2].'38')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('B36:'.$rowname[count($rowArray)-2].'38')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    
       $branch_na=Branch::select('title_en','id')->where('status','1')->get()->pluck('title_en','id');
       //fill data in all branch wise Grass sales
        for ($i = 1;$i <=count($aDates);$i++)
        {
            if(in_array($aDates[$i-1],array_keys($dailyvalue_gross)))
            {

              $j=0;
              foreach($branch_na as $key=>$val)
              {
                if(in_array($key,array_keys($dailyvalue_gross[$aDates[$i-1] ]))){

                    $DailySales->setCellValue($rowname[$j+2].($i+2),$dailyvalue_gross[$aDates[$i-1]][$key]['gross_sale']); 
                 }
                $j++;
              }
            }
        }

        $COL11 = array(
                'NO.DAYS',
                'NO.DAYS',
            );

        $COL21 = array(
                'BR TTL',
                null,
            );
        $COL31 = array(
            'MAX SALE',
            'Daily',
          
        );

          $COL41 = array(
            'MIN SALE',
            'Daily',
          
        );

          $COL51 = array(
            'AVG SALE/DAY',
            'Daily',
           
        ); 

        $COL61 = array(
            'PROJ. SALE',
            'Monthly',
            );

        $actualtotalsale1 = array(
            'Actual Total Sale(%)',
           
        );


              $COL12=array();
              $COL22=array();
              $COL32=array();
              $COL42=array();
              $COL52=array();
              $COL62=array();
              $actualtotalsale2=array();
             
              foreach(range('C', $rowname[count($rowArray)-1]) as $rowval){

                  $COL12[]='=COUNT('.$rowval.'3:'.$rowval.'34)';
                  $COL22[]='=SUM('.$rowval.'3:'.$rowval.'34)';
                  $COL32[]='=MAX('.$rowval.'3:'.$rowval.'34)';
                  $COL42[]='=MIN('.$rowval.'3:'.$rowval.'34)';
                  $COL52[]='='.$rowval.'36/'.$rowval.'35';
                  $COL62[]='='.$rowval.'39*'.count($aDates);
                  $actualtotalsale2[]='='.$rowval.'36/'.$rowname[count($rowArray)-2].'36';
                
                }
         
          $COL1=array_merge($COL11,$COL12);
          $COL2=array_merge($COL21,$COL22);
          $COL3=array_merge($COL31,$COL32);
          $COL4=array_merge($COL41,$COL42);
          $COL5=array_merge($COL51,$COL52);
          $COL6=array_merge($COL61,$COL62);
          $actualtotalsale=array_merge($actualtotalsale1,$actualtotalsale2);
         

        $i = 0;

        $spreadsheet->getActiveSheet()
            ->getRowDimension('35')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('37')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('38')
            ->setRowHeight(20, 'pt');

        foreach (range('A',$rowname[count($rowArray)-1]) as $columnID)
        {
            $key1 = $columnID . '35';
            $key2 = $columnID . '36';
            $key3 = $columnID . '37';
            $key4 = $columnID . '38';
            $key5 = $columnID . '39';
            $key6 = $columnID . '40';

            $spreadsheet->getActiveSheet()
                ->getStyle($key1)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $spreadsheet->getActiveSheet()
                ->getStyle($key1)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($key1, $COL1[$i]);

            $spreadsheet->getActiveSheet()
                ->getStyle($key2)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $spreadsheet->getActiveSheet()
                ->getStyle($key2)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($key2, $COL2[$i]);

            $spreadsheet->getActiveSheet()
                ->getStyle($key3)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $spreadsheet->getActiveSheet()
                ->getStyle($key3)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($key3, $COL3[$i]);

            $spreadsheet->getActiveSheet()
                ->getStyle($key4)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $spreadsheet->getActiveSheet()
                ->getStyle($key4)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($key4, $COL4[$i]);

            $spreadsheet->getActiveSheet()
                ->getStyle($key5)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $spreadsheet->getActiveSheet()
                ->getStyle($key5)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($key5, $COL5[$i]);

            $spreadsheet->getActiveSheet()
                ->getStyle($key6)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $spreadsheet->getActiveSheet()
                ->getStyle($key6)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($key6, $COL6[$i]);

            $i++;

        }

        $DailySales->mergeCells('A41:B41')
            ->setCellValue('A41', 'Actual Total Sale(%)');

        $i = 2;

        foreach (range('C', $rowname[count($rowArray)-1]) as $colmn)
        {
            $key7 = $colmn . '41';

            $spreadsheet->getActiveSheet()
                ->getStyle($key7)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $spreadsheet->getActiveSheet()
                ->getStyle($key7)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($key7, $actualtotalsale[$i]);
        }

        $spreadsheet->getActiveSheet()
            ->getStyle('A41')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        foreach (range('A', $rowname[count($rowArray)-1]) as $colborder)
        {
            $colss = $colborder . "42";
            $colss43 = $colborder . "43";
            $colss44 = $colborder . "44";
            $spreadsheet->getActiveSheet()
                ->getStyle($colss)->getBorders()
                ->getRight()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('FFFFFF'));

            $spreadsheet->getActiveSheet()
                ->getStyle($colss43)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('FFFFFF'));

            $spreadsheet->getActiveSheet()
                ->getStyle($colss44)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('FFFFFF'));
        }

        $DailySales->setCellValue('A42', 'Net Sale');
        $DailySales->setCellValue($rowname[count($rowArray)-1].'42', '=SUM(C42:'.$rowname[count($rowArray)-1].'42)');
        $DailySales->setCellValue('A43', 'Discount');
        $DailySales->setCellValue($rowname[count($rowArray)-1].'43', '=SUM(C43:'.$rowname[count($rowArray)-1].'43)');
        $DailySales->setCellValue('A44', 'Diff.');

        
          foreach(range('C',$rowname[count($rowArray)-1]) as $rowval){

                $DailySales->setCellValue($rowval.'44','='.$rowval.'36-'.$rowval.'42-'.$rowval.'43');
                }


        $spreadsheet->getActiveSheet()
            ->getStyle('A1:'.$rowname[count($rowArray)-1].'44')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->getActiveSheet()
            ->getStyle('C36:'.$rowname[count($rowArray)-1].'38')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

      
        $spreadsheet->getActiveSheet()
            ->getStyle('A36:A38')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
            ->getStyle('A40')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
            ->getStyle($rowname[count($rowArray)-1].'36')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle($rowname[count($rowArray)-1].'36')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('f0ea3a');

        $spreadsheet->getActiveSheet()
            ->getStyle('A40:'.$rowname[count($rowArray)-1].'40')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);


         $spreadsheet->getActiveSheet()
            ->getStyle($rowname[count($rowArray)-1].'42')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
         $spreadsheet->getActiveSheet()
            ->getStyle($rowname[count($rowArray)-1].'43')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        


        $spreadsheet->createSheet();

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);

        $fileName = 'Sales_Report.xlsx';
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

