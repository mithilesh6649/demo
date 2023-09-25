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
  
class DailySalesReportDSR
{
    
    public $start;
    public $end;
    public $branch_id;

    public function __construct($start,$end,$branch_id)
    {
       $curMonth = date('F');
       $curYear  = date('Y');
       $timestamp    = strtotime($curMonth.' '.$curYear);
       $first_second = date('Y-m-01 00:00:00', $timestamp);
       $last_second  = date('Y-m-t 12:59:59', $timestamp); 

        if(!$branch_id)
        {
            $selbranch=Branch::select('short_name','id')->get()->first();
            $this->branch_id=$selbranch->id;
        }else
        {
            $this->branch_id=$branch_id;
        }

        if(!$start)
        {
          $this->start=$first_second; 
        }else{
          
          $this->start=date('Y-m-d',strtotime(str_replace('/','-',$start))); 
        }

        if(!$end)
        {
          $this->end=$last_second;
        }else
        {
          $this->end=date('Y-m-d',strtotime(str_replace('/','-',$end)));
        }

    }


    public function result()
    {

        $spreadsheet = new Spreadsheet();


        $first_second =$this->start;
        $last_second  =$this->end;
        $branch_id=$this->branch_id; 
        $branch_name=Branch::select('short_name','id')->where('id',$branch_id)->get()->first();
      
       $data = DailySaleReport::whereDate("report_date",">=",date("Y-m-d", strtotime($first_second)))->whereDate("report_date","<=",date("Y-m-d", strtotime($last_second)))->where('branch_id',$branch_id)->get();

        $dates = DailySaleReport::select(DB::raw('DATE(report_date) as date'))->whereDate("report_date",">=",date("Y-m-d", strtotime($first_second)))->whereDate("report_date","<=",date("Y-m-d", strtotime($last_second)))->groupBy('date')
               ->get()
               ->pluck('date');
     

        $datevales=array();
        foreach($data as $d)
        {
            $datevales[date('d-M-Y',strtotime($d->report_date))]=$d;
        }


        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:G1')
            ->setCellValue('A1', 'Period :'.date('d-m-Y',strtotime($first_second))." To ".date('d-m-Y',strtotime($last_second)))
            ->getStyle("A1:G1")
            ->getFont()
            ->setSize(12);


        $aDates = array();
        $start = strtotime($first_second); 
        $end = strtotime($last_second); 
        $day = array();

        $date = strtotime("-1 day", $start);  
       $end = strtotime("-1 day", $end);  
        while($date < $end)  { 
           $date = strtotime("+1 day", $date);
           $aDates[] = date('d-M-Y', $date);
           $day[] = date('D', $date);
        } 
 
           

        if(count($dates)>0)
        {
            $aDates = array();
            $start = strtotime($first_second); 
            $end = strtotime($last_second); 
            $day = array();
            foreach($dates as $edate)
            {
              $aDates[] = date('d-M-Y',strtotime($edate));
              $day[] = date('D',strtotime($edate));
            }

        }
        

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('H1:AD1')
            ->setCellValue('H1', "MUGHAL MAHAL DAILY SALES REPORT F/M " . date('M-Y',strtotime($first_second)))
            ->getStyle("H1:AD1")
            ->getFont()
            ->setSize(12);

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('AE1:AG1')
            ->setCellValue('AE1', 'Branch - '.$branch_name->short_name)
            ->getStyle("AE1:AG1")
            ->getFont()
            ->setSize(12);
            //->setItalic(true);

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
            ->setSize(12);
            //->setItalic(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('A'.(count($aDates)+7).':AG'.(count($aDates)+8))
            ->getFont()
            ->setSize(6);
            //->setItalic(true);

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
            ->getStyle('A'.(count($aDates)+7).':AG'.(count($aDates)+8))
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
            ->getRowDimension((count($aDates)+7))
            ->setRowHeight(17, 'pt');
        $spreadsheet->getActiveSheet()
            ->getRowDimension((count($aDates)+8))
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
            ->getStyle('A1:AG'.(count($aDates)+14))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
            ->setColor(new Color('0563b0'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A41:D'.(count($aDates)+12))
            ->getFont()
            ->getColor()
            ->setARGB('4ba658');

        $salereport = $spreadsheet->getActiveSheet()
            ->setTitle('DAILY SALES REPORT');

        // $salereport->mergeCells('A2:B2')
        //     ->setCellValue('A2', 'PERIOD');
        // $salereport->mergeCells('C2:W2')
        //     ->setCellValue('C2', "SALE  - GROSS & NET (DINE IN / BUFFET / TAKE AWAY / HOME DELIVERY)");
        // $salereport->mergeCells('X2:AG2')
        //     ->setCellValue('X2', 'CASH FLOW ( CASH IN HAND  / CREDIT CARD / BANK DEPOSIT )');

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
           
           if($columnID!='C'){
            $spreadsheet->getActiveSheet()
                ->getColumnDimension($columnID)->setWidth(17);
            }
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
            ->getStyle('AC4:AC'.(count($aDates)+4))
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
            ->getStyle('AG4:AG'.(count($aDates)+4))
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('AG4:AG'.(count($aDates)+4))
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('AG4:AG'.(count($aDates)+4))
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        
       

        for ($i = 0;$i <count($aDates);$i++)
        {
            $salereport->setCellValue('AG' . ($i + 4) , $lastcolval[$i]);
        }

     
         $spreadsheet->getActiveSheet()
            ->getStyle('C4:C'.(count($aDates)+12))
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

         for ($i=0; $i <count($aDates) ; $i++) { 
              $salereport->setCellValue('C'.($i+4),($i+1));
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

                $salereport->setCellValue('X'.($i+4), $datevales[$aDates[$i]]['talabat_credit_total']);
                $salereport->setCellValue('Y'.($i+4), $datevales[$aDates[$i]]['deliveroo_total']);
                $salereport->setCellValue('Z'.($i+4), $datevales[$aDates[$i]]['v_thru_credit_total']);
                $salereport->setCellValue('AA'.($i+4), $datevales[$aDates[$i]]['credit_sale']);
                $salereport->setCellValue('AB'.($i+4), $datevales[$aDates[$i]]['e_gift_card_total']);
                $salereport->setCellValue('AD'.($i+4), $datevales[$aDates[$i]]['cash_in_hand_actual']);
                $salereport->setCellValue('AF'.($i+4), $datevales[$aDates[$i]]['cash_deposit_in_bank']);
              
                

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
                $spreadsheet->getActiveSheet()
                            ->getStyle('AF'.($i+4))->getAlignment()
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
            ->getStyle('A'.(count($aDates)+7))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A'.(count($aDates)+8))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A'.(count($aDates)+7).':B'.(count($aDates)+7))
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $salereport->mergeCells('A'.(count($aDates)+7).':B'.(count($aDates)+7))
            ->setCellValue('A'.(count($aDates)+7), 'SUB TOTAL');

        $spreadsheet->getActiveSheet()
            ->getStyle('A'.(count($aDates)+8).':B'.(count($aDates)+8))
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $salereport->mergeCells('A'.(count($aDates)+8).':B'.(count($aDates)+8))
            ->setCellValue('A'.(count($aDates)+8), '(%) TO NET SALE');

        $formulaarray = [null,'=SUM(D4:D'.(count($aDates)+5).')','=SUM(E4:E'.(count($aDates)+5).')','=SUM(F4:F'.(count($aDates)+5).')','=SUM(G4:G'.(count($aDates)+5).')','=SUM(H4:H'.(count($aDates)+5).')','=SUM(I4:I'.(count($aDates)+5).')','=SUM(J4:J'.(count($aDates)+5).')','=SUM(K4:K'.(count($aDates)+5).')','=SUM(L4:L'.(count($aDates)+5).')','=SUM(M4:M'.(count($aDates)+5).')','=SUM(N4:N'.(count($aDates)+5).')','=SUM(O4:O'.(count($aDates)+5).')',null,null,'=SUM(R4:R'.(count($aDates)+5).')','=SUM(S4:S'.(count($aDates)+5).')','=SUM(T4:T'.(count($aDates)+5).')','=SUM(U4:U'.(count($aDates)+5).')','=SUM(V4:V'.(count($aDates)+5).')','=SUM(W4:W'.(count($aDates)+5).')','=SUM(X4:X'.(count($aDates)+5).')','=SUM(Y4:Y'.(count($aDates)+5).')','=SUM(Z4:Z'.(count($aDates)+5).')','=SUM(AA4:AA'.(count($aDates)+5).')','=SUM(AB4:AB'.(count($aDates)+5).')','=SUM(AC4:AC'.(count($aDates)+5).')','=SUM(AD4:AD'.(count($aDates)+5).')','=SUM(AE4:AE'.(count($aDates)+5).')','=SUM(AF4:AF'.(count($aDates)+5).')','=SUM(AG4:AG'.(count($aDates)+5).')'];

        $secformulaarray = [null, '=D'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=E'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=F'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=G'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=H'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=I'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=J'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=K'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=L'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=M'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=N'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=O'.(count($aDates)+7).'/$R$'.(count($aDates)+7), null, null, '=R'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=S'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=T'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=U'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=V'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=W'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=X'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=Y'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=Z'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AA'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AB'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AC'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AD'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AE'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AF'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AG'.(count($aDates)+7).'/$R$'.(count($aDates)+7)];

        $spreadsheet->getActiveSheet()
                    ->getStyle('A'.(count($aDates)+7).':AG'.(count($aDates)+8))
                    ->getAlignment()
                    ->setWrapText(true);
        $spreadsheet->getActiveSheet()
                    ->getStyle('A'.(count($aDates)+7).':AG'.(count($aDates)+8))
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
                    ->getStyle('A'.(count($aDates)+7).':AG'.(count($aDates)+8))
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $j = 0;
        foreach (range('C', 'Z') as $columnID)
        {
            $spreadsheet->getActiveSheet()
                        ->getStyle($columnID . (count($aDates)+7))->getBorders()
                        ->getOutline()
                        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                        ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                        ->getStyle($columnID . (count($aDates)+7))->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $salereport->setCellValue($columnID . (count($aDates)+7), $formulaarray[$j]);

            $spreadsheet->getActiveSheet()
                        ->getStyle($columnID . (count($aDates)+8))->getBorders()
                        ->getOutline()
                        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                        ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                        ->getStyle($columnID . (count($aDates)+8))->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue($columnID . (count($aDates)+8), $secformulaarray[$j]);

            $j++;
        }


        $j = $j - 1;
        foreach (range('A', 'G') as $columnID)
        {
            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $columnID .(count($aDates)+7))->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $columnID .(count($aDates)+7))->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $salereport->setCellValue('A' . $columnID . (count($aDates)+7), $formulaarray[$j - 1]);

            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $columnID .(count($aDates)+8))->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $columnID . (count($aDates)+8))->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $salereport->setCellValue('A' . $columnID . (count($aDates)+8), $secformulaarray[$j - 1]);

            $j++;
        }

        $colval = array(
            'NET SALE',
            'NO. OF DAYS',
            'AVG SALE/DAY',
            'PROJECTED  SALE'
        );

        $colval39 = array(
            '=V'.(count($aDates)+7),
            '=COUNT(D4:D'.(count($aDates)+5).')',
            '=D'.(count($aDates)+10).'/D'.(count($aDates)+10),
            '=D'.(count($aDates)+11).'*D'.(count($aDates)+10)
        );
        $colvalR = array(
            'NET SALE',
            'EXPENSE ',
            'CR/CARD ',
            'CASH IN HAND'
        );
        $colvalV = array(
            '=V'.(count($aDates)+7),
            '=#REF!',
            '=X'.(count($aDates)+7).'+AA'.(count($aDates)+7),
            '=AC'.(count($aDates)+7)
        );

        $l = 0;

        $spreadsheet->getActiveSheet()
            ->getStyle('D'.(count($aDates)+9).':D'.(count($aDates)+12))
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('D'.(count($aDates)+9).':D'.(count($aDates)+12))
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('D'.(count($aDates)+9).':D'.(count($aDates)+12))
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('V'.(count($aDates)+9).':V'.(count($aDates)+12))
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('V'.(count($aDates)+9).':V'.(count($aDates)+12))
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('V'.(count($aDates)+9).':V'.(count($aDates)+12))
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $salereport->setCellValue('A'.(count($aDates)+6), 'ADJST');

        for ($i =(count($aDates)+9);$i <= (count($aDates)+12);$i++)
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

        $salereport->setCellValue('AA'.(count($aDates)+9), '=AA'.(count($aDates)+7).'+X'.(count($aDates)+7));
        $salereport->setCellValue('AC'.(count($aDates)+11), 'CASH DIFF');
        $salereport->setCellValue('AD'.(count($aDates)+11), '=AD'.(count($aDates)+7).'-AC'.(count($aDates)+7));



        $spreadsheet->createSheet();

       
       
        $format = '0.000';
        $spreadsheet->getActiveSheet()
            ->getStyle('D4:AG'.(count($aDates)+12))->getNumberFormat()
            ->setFormatCode($format);

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
        
        $timestamp = "-".date('d-m-Y')."(".date('h-i-s-A',time()).")"; 
        
        $fileName = 'Daily-Sales-Report-(DSR)'.$timestamp.'.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

    
}

