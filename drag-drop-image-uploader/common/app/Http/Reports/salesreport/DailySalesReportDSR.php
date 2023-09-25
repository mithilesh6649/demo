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

       //$data return all data.......
    $data = DailySaleReport::whereDate("report_date",">=",date("Y-m-d", strtotime($first_second)))->whereDate("report_date","<=",date("Y-m-d", strtotime($last_second)))->where('branch_id',$branch_id)->get();

    //get Last date Opening balance.......

    $last_day = date("Y-m-d", strtotime($first_second));
    if($last_day =="2022-09-01"){
      $last_day_opening_bal = DailySaleReport::where("report_date",date("Y-m-d",strtotime($last_day)))->where('branch_id',$branch_id)->first();
   //   dd($last_day_opening_bal->cash_in_hand_opening_balance);
    }else{
    //$final_end_date  = date('Y-m-d',strtotime('-1 day',strtotime($last_day)));
    //$last_day_opening_bal = DailySaleReport::where("report_date",$final_end_date)->where('branch_id',$branch_id)->first();
     $last_day_opening_bal = DailySaleReport::where("report_date",$last_day)->where('branch_id',$branch_id)->first();
    }

      //get Last date Opening balance.......

    $dates = DailySaleReport::select(DB::raw('DATE(report_date) as date'))->whereDate("report_date",">=",date("Y-m-d", strtotime($first_second)))->whereDate("report_date","<=",date("Y-m-d", strtotime($last_second)))->groupBy('date')
    ->get()
    ->pluck('date');

    $datevales=array();
    foreach($data as $d)
    {
        $datevales[date('d-M-Y',strtotime($d->report_date))]=$d;
    }

   // dd($datevales);

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
->mergeCells('AE1:AH1')
->setCellValue('AE1', 'Branch - '.$branch_name->short_name)
->getStyle("AE1:AH1")
->getFont()
->setSize(12);
            //->setItalic(true);

$spreadsheet->getActiveSheet()
->getStyle('H1:AH1')
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()
->getStyle('A2:AH2')
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$spreadsheet->getActiveSheet()
->getStyle('A1:AH1')
->getFont()
->setSize(12);
            //->setItalic(true);
//dd('A'.(count($aDates)+7).':AH'.(count($aDates)+7));
$spreadsheet->getActiveSheet()
->getStyle('A'.(count($aDates)+7).':AH'.(count($aDates)+7))
->getFont()
->setSize(6);
            //->setItalic(true);

$spreadsheet->getActiveSheet()
->getStyle('A2:AH2')
->getFont()
->setSize(10);

$spreadsheet->getActiveSheet()
->getStyle('A1:AH1')
->getFill()
->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
->getStartColor()
->setARGB('FFFF00');

$spreadsheet->getActiveSheet()
->getStyle('A2:AH3')
->getFill()
->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
->getStartColor()
->setARGB('9bdef2');
//dd('A'.(count($aDates)+7).':AH'.(count($aDates)+7));
$spreadsheet->getActiveSheet()
->getStyle('A'.(count($aDates)+7).':AH'.(count($aDates)+7))
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
->getStyle('A3:AH3')
->getFont()->setBold(true)->setName('Calibri') ;



$spreadsheet->getActiveSheet()
->getStyle('A2:AH2')
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
->getStyle('A1:AH'.(count($aDates)+14))
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
        // $salereport->mergeCells('X2:AH2')
        //     ->setCellValue('X2', 'CASH FLOW ( CASH IN HAND  / CREDIT CARD / BANK DEPOSIT )');

        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
$spreadsheet->getActiveSheet()
->getStyle('A3:AH3')
->getAlignment()
->setWrapText(true);
$spreadsheet->getActiveSheet()
->getStyle('A3:AH3')
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()
->getStyle('A3:AH3')
->getAlignment()
->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$spreadsheet->getActiveSheet()
->getStyle('A3:AH3')
->getAlignment()
->setWrapText(true);
$spreadsheet->getActiveSheet()
->getStyle('A3:AH3')
->getFont()
->setSize(7);
$spreadsheet->getActiveSheet()
->getRowDimension('3')
->setRowHeight(25, 'pt');

$rowArray = ['DAY', 'DATE', 'ST.NO', 'Dine-In Restaurant', 'Dine-In Cabin', 'Take Away/Self Pickup', 'Home Delivery', 'Buffet', 'Talabat (TMP)', 'Talabat (TGO)','MM Express(TGO)', 'Deliveroo (TMP)', 'Deliveroo (TGO)', 'V-Thru', 'MM Online', 'OSC', 'Garden', 'Others', 'Net SALE', 'Discount', 'Complimentary', 'Sale Return', 'GROSS SALE', 'TOTAL', 'Credit Talabat', 'Credit Deliveroo', 'Credit V-Thru', 'CR/CARD MMGTC', 'Gift Card', 'CASH SCH', 'CASH ACTUAL', 'DIFF', 'CAS DEP /OP', ''];

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
->getStyle('AD4:AD'.(count($aDates)+4))
->getFont()
->getColor()
->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('D37:AH38')
        //     ->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);


$lastcolval = array(
   '=AH3+AE4-AG4',
   '=AH4+AE5-AG5',
   '=AH5+AE6-AG6',
   '=AH6+AE7-AG7',
   '=AH7+AE8-AG8',
   '=AH8+AE9-AG9',
   '=AH9+AE10-AG10',
   '=AH10+AE11-AG11',
   '=AH11+AE12-AG12',
   '=AH12+AE13-AG13',
   '=AH13+AE14-AG14',
   '=AH14+AE15-AG15',
   '=AH15+AE16-AG16',
   '=AH16+AE17-AG17',
   '=AH17+AE18-AG18',
   '=AH18+AE19-AG19',
   '=AH19+AE20-AG20',
   '=AH20+AE21-AG21',
   '=AH21+AE22-AG22',
   '=AH22+AE23-AG23',
   '=AH23+AE24-AG24',
   '=AH24+AE25-AG25',
   '=AH25+AE26-AG26',
   '=AH26+AE27-AG27',
   '=AH27+AE28-AG28',
   '=AH28+AE29-AG29',
   '=AH29+AE30-AG30',
   '=AH30+AE31-AG31',
   '=AH31+AE32-AG32',
   '=AH32+AE33-AG33',
   '=AH33+AE34-AG34',
   '=AH34+AE35-AG35'
);


        // $lastcolval = array(
        //     '=  3+AD4-AF4',
        //     '=AH4+AD5-AF5',
        //     '=AH5+AD6-AF6',
        //     '=AH6+AD7-AF7',
        //     '=AH7+AD8-AF8',
        //     '=AH8+AD9-AF9',
        //     '=AH9+AD10-AF10',
        //     '=AH10+AD11-AF11',
        //     '=AH11+AD12-AF12',
        //     '=AH12+AD13-AF13',
        //     '=AH13+AD14-AF14',
        //     '=AH14+AD15-AF15',
        //     '=AH15+AD16-AF16',
        //     '=AH16+AD17-AF17',
        //     '=AH17+AD18-AF18',
        //     '=AH18+AD19-AF19',
        //     '=AH19+AD20-AF20',
        //     '=AH20+AD21-AF21',
        //     '=AH21+AD22-AF22',
        //     '=AH22+AD23-AF23',
        //     '=AH23+AD24-AF24',
        //     '=AH24+AD25-AF25',
        //     '=AH25+AD26-AF26',
        //     '=AH26+AD27-AF27',
        //     '=AH27+AD28-AF28',
        //     '=AH28+AD29-AF29',
        //     '=AH29+AD30-AF30',
        //     '=AH30+AD31-AF31',
        //     '=AH31+AD32-AF32',
        //     '=AH32+AD33-AF33',
        //     '=AH33+AD34-AF34',
        //     '=AH34+AD35-AF35'
        // );

$spreadsheet->getActiveSheet()
->getStyle('AH4:AH'.(count($aDates)+4))
->getAlignment()
->setWrapText(true);
$spreadsheet->getActiveSheet()
->getStyle('AH4:AH'.(count($aDates)+4))
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()
->getStyle('AH4:AH'.(count($aDates)+4))
->getAlignment()
->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);




for ($i = 0;$i <count($aDates);$i++)
{
    $salereport->setCellValue('AH' . ($i + 4) , $lastcolval[$i]);
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
        $salereport->setCellValue('K'.($i+4), $datevales[$aDates[$i]]['MM_Express_TGO']);


        $salereport->setCellValue('L'.($i+4), $datevales[$aDates[$i]]['deliveroo_TEM']);
        $salereport->setCellValue('M'.($i+4), $datevales[$aDates[$i]]['deliveroo_TGO']);
        $salereport->setCellValue('N'.($i+4), $datevales[$aDates[$i]]['v_thru']);
        $salereport->setCellValue('O'.($i+4), $datevales[$aDates[$i]]['mm_online']);
        $salereport->setCellValue('P'.($i+4), $datevales[$aDates[$i]]['osc']);
        $salereport->setCellValue('Q'.($i+4), $datevales[$aDates[$i]]['garden']);
        $salereport->setCellValue('R'.($i+4), $datevales[$aDates[$i]]['others_gross']);

        $salereport->setCellValue('S'.($i+4), "NET SEL");


        $salereport->setCellValue('T'.($i+4), $datevales[$aDates[$i]]['discount']);
        $salereport->setCellValue('U'.($i+4), $datevales[$aDates[$i]]['complimentary']);
        $salereport->setCellValue('V'.($i+4), $datevales[$aDates[$i]]['sale_Return']);

        $salereport->setCellValue('W'.($i+4), "GROSS SALE");
        $salereport->setCellValue('X'.($i+4), "Total");

        $salereport->setCellValue('Y'.($i+4), $datevales[$aDates[$i]]['talabat_credit_total']);
        $salereport->setCellValue('Z'.($i+4), $datevales[$aDates[$i]]['deliveroo_total']);
        $salereport->setCellValue('AA'.($i+4), $datevales[$aDates[$i]]['v_thru_credit_total']);
        $salereport->setCellValue('AB'.($i+4), $datevales[$aDates[$i]]['cards_sale']);
        $salereport->setCellValue('AC'.($i+4), $datevales[$aDates[$i]]['e_gift_card_total']);
        $salereport->setCellValue('AD'.($i+4), "CASH SCH");

        $salereport->setCellValue('AE'.($i+4), $datevales[$aDates[$i]]['cash_in_hand_actual']);
        $salereport->setCellValue('AG'.($i+4), $datevales[$aDates[$i]]['cash_deposit_in_bank']);



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
    ->getStyle('R'.($i+4))->getAlignment()
    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


                // $spreadsheet->getActiveSheet()
                //             ->getStyle('S'.($i+4))->getAlignment()
                //             ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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

$netsell=array('=SUM(D4:R4)','=SUM(D5:R5)','=SUM(D6:R6)','=SUM(D7:R7)','=SUM(D8:R8)','=SUM(D9:R9)','=SUM(D10:R10)','=SUM(D11:R11)','=SUM(D12:R12)','=SUM(D13:R13)','=SUM(D14:R14)','=SUM(D15:R15)','=SUM(D16:R16)','=SUM(D17:R17)','=SUM(D18:R18)','=SUM(D19:R19)','=SUM(D20:R20)','=SUM(D21:R21)','=SUM(D22:R22)','=SUM(D23:R23)','=SUM(D24:R24)','=SUM(D25:R25)','=SUM(D26:R26)','=SUM(D27:R27)','=SUM(D28:R28)','=SUM(D29:R29)','=SUM(D30:R30)','=SUM(D31:R31)','=SUM(D32:R32)','=SUM(D33:R33)','=SUM(D34:R34)','=SUM(D35:R35)');

$grasssale=array('=+S4+T4+U4+V4','=+S5+T5+U5+V5','=+S6+T6+U6+V6','=+S7+T7+U7+V7','=+S8+T8+U8+V8','=+S9+T9+U9+V9','=+S10+T10+U10+V10','=+S11+T11+U11+V11','=+S12+T12+U12+V12','=+S13+T13+U13+V13','=+S14+T14+U14+V14','=+S15+T15+U15+V15','=+S16+T16+U16+V16','=+S17+T17+U17+V17','=+S18+T18+U18+V18','=+S19+T19+U19+V19','=+S20+T20+U20+V20','=+S21+T21+U21+V21','=+S22+T22+U22+V22','=+S23+T23+U23+V23','=+S24+T24+U24+V24','=+S25+T25+U25+V25','=+S26+T26+U26+V26','=+S27+T27+U27+V27','=+S28+T28+U28+V28','=+S29+T29+U29+V29','=+S30+T30+U30+V30','=+S31+T31+U31+V31','=+S32+T32+U32+V32','=+S33+T33+U33+V33','=+S34+T34+U34+V34','=+S35+T35+U35+V35');



        // $grasssale=array('=+R4+S4+T4+U4','=+R5+S5+T5+U5','=+R6+S6+T6+U6','=+R7+S7+T7+U7','=+R8+S8+T8+U8','=+R9+S9+T9+U9','=+R10+S10+T10+U10','=+R11+S11+T11+U11','=+R12+S12+T12+U12','=+R13+S13+T13+U13','=+R14+S14+T14+U14','=+R15+S15+T15+U15','=+R16+S16+T16+U16','=+R17+S17+T17+U17','=+R18+S18+T18+U18','=+R19+S19+T19+U19','=+R20+S20+T20+U20','=+R21+S21+T21+U21','=+R22+S22+T22+U22','=+R23+S23+T23+U23','=+R24+S24+T24+U24','=+R25+S25+T25+U25','=+R26+S26+T26+U26','=+R27+S27+T27+U27','=+R28+S28+T28+U28','=+R29+S29+T29+U29','=+R30+S30+T30+U30','=+R31+S31+T31+U31','=+R32+S32+T32+U32','=+R33+S33+T33+U33','=+R34+S34+T34+U34');

        // MKS $total=array('=+D4+E4+F4+G4+H4+I4+K4+M4+N4+O4','=+D5+E5+F5+G5+H5+I5+K5+M5+N5+O5','=+D6+E6+F6+G6+H6+I6+K6+M6+N6+O6','=+D7+E7+F7+G7+H7+I7+K7+M7+N7+O7','=+D8+E8+F8+G8+H8+I8+K8+M8+N8+O8','=+D9+E9+F9+G9+H9+I9+K9+M9+N9+O9','=+D10+E10+F10+G10+H10+I10+K10+M10+N10+O10','=+D11+E11+F11+G11+H11+I11+K11+M11+N11+O11','=+D12+E12+F12+G12+H12+I12+K12+M12+N12+O12','=+D13+E13+F13+G13+H13+I13+K13+M13+N13+O13','=+D14+E14+F14+G14+H14+I14+K14+M14+N14+O14','=+D15+E15+F15+G15+H15+I15+K15+M15+N15+O15','=+D16+E16+F16+G16+H16+I16+K16+M16+N16+O16','=+D17+E17+F17+G17+H17+I17+K17+M17+N17+O17','=+D18+E18+F18+G18+H18+I18+K18+M18+N18+O18','=+D19+E19+F19+G19+H19+I19+K19+M19+N19+O19','=+D20+E20+F20+G20+H20+I20+K20+M20+N20+O20','=+D21+E21+F21+G21+H21+I21+K21+M21+N21+O21','=+D22+E22+F22+G22+H22+I22+K22+M22+N22+O22','=+D23+E23+F23+G23+H23+I23+K23+M23+N23+O23','=+D24+E24+F24+G24+H24+I24+K24+M24+N24+O24','=+D25+E25+F25+G25+H25+I25+K25+M25+N25+O25','=+D26+E26+F26+G26+H26+I26+K26+M26+N26+O26','=+D27+E27+F27+G27+H27+I27+K27+M27+N27+O27','=+D28+E28+F28+G28+H28+I28+K28+M28+N28+O28','=+D29+E29+F29+G29+H29+I29+K29+M29+N29+O29','=+D30+E30+F30+G30+H30+I30+K30+M30+N30+O30','=+D31+E31+F31+G31+H31+I31+K31+M31+N31+O31','=+D32+E32+F32+G32+H32+I32+K32+M32+N32+O32','=+D33+E33+F33+G33+H33+I33+K33+M33+N33+O33','=+D34+E34+F34+G34+H34+I34+K34+M34+N34+O34');

        // ???????? Confusion
         // $total=array('=+D4+E4+F4+G4+H4+I4+K4+M4+N4','=+D5+E5+F5+G5+H5+I5+K5+M5+N5','=+D6+E6+F6+G6+H6+I6+K6+M6+N6','=+D7+E7+F7+G7+H7+I7+K7+M7+N7','=+D8+E8+F8+G8+H8+I8+K8+M8+N8','=+D9+E9+F9+G9+H9+I9+K9+M9+N9','=+D10+E10+F10+G10+H10+I10+K10+M10+N10','=+D11+E11+F11+G11+H11+I11+K11+M11+N11','=+D12+E12+F12+G12+H12+I12+K12+M12+N12','=+D13+E13+F13+G13+H13+I13+K13+M13+N13','=+D14+E14+F14+G14+H14+I14+K14+M14+N14','=+D15+E15+F15+G15+H15+I15+K15+M15+N15','=+D16+E16+F16+G16+H16+I16+K16+M16+N16','=+D17+E17+F17+G17+H17+I17+K17+M17+N17','=+D18+E18+F18+G18+H18+I18+K18+M18+N18','=+D19+E19+F19+G19+H19+I19+K19+M19+N19','=+D20+E20+F20+G20+H20+I20+K20+M20+N20','=+D21+E21+F21+G21+H21+I21+K21+M21+N21','=+D22+E22+F22+G22+H22+I22+K22+M22+N22','=+D23+E23+F23+G23+H23+I23+K23+M23+N23','=+D24+E24+F24+G24+H24+I24+K24+M24+N24','=+D25+E25+F25+G25+H25+I25+K25+M25+N25','=+D26+E26+F26+G26+H26+I26+K26+M26+N26','=+D27+E27+F27+G27+H27+I27+K27+M27+N27','=+D28+E28+F28+G28+H28+I28+K28+M28+N28','=+D29+E29+F29+G29+H29+I29+K29+M29+N29','=+D30+E30+F30+G30+H30+I30+K30+M30+N30','=+D31+E31+F31+G31+H31+I31+K31+M31+N31','=+D32+E32+F32+G32+H32+I32+K32+M32+N32','=+D33+E33+F33+G33+H33+I33+K33+M33+N33','=+D34+E34+F34+G34+H34+I34+K34+M34+N34');


$total=array('=+D4+E4+F4+G4+H4+I4+L4+N4+O4','=+D5+E5+F5+G5+H5+I5+L5+N5+O5','=+D6+E6+F6+G6+H6+I6+L6+N6+O6','=+D7+E7+F7+G7+H7+I7+L7+N7+O7','=+D8+E8+F8+G8+H8+I8+L8+N8+O8','=+D9+E9+F9+G9+H9+I9+L9+N9+O9','=+D10+E10+F10+G10+H10+I10+L10+N10+O10','=+D11+E11+F11+G11+H11+I11+L11+N11+O11','=+D12+E12+F12+G12+H12+I12+L12+N12+O12','=+D13+E13+F13+G13+H13+I13+L13+N13+O13','=+D14+E14+F14+G14+H14+I14+L14+N14+O14','=+D15+E15+F15+G15+H15+I15+L15+N15+O15','=+D16+E16+F16+G16+H16+I16+L16+N16+O16','=+D17+E17+F17+G17+H17+I17+L17+N17+O17','=+D18+E18+F18+G18+H18+I18+L18+N18+O18','=+D19+E19+F19+G19+H19+I19+L19+N19+O19','=+D20+E20+F20+G20+H20+I20+L20+N20+O20','=+D21+E21+F21+G21+H21+I21+L21+N21+O21','=+D22+E22+F22+G22+H22+I22+L22+N22+O22','=+D23+E23+F23+G23+H23+I23+L23+N23+O23','=+D24+E24+F24+G24+H24+I24+L24+N24+O24','=+D25+E25+F25+G25+H25+I25+L25+N25+O25','=+D26+E26+F26+G26+H26+I26+L26+N26+O26','=+D27+E27+F27+G27+H27+I27+L27+N27+O27','=+D28+E28+F28+G28+H28+I28+L28+N28+O28','=+D29+E29+F29+G29+H29+I29+L29+N29+O29','=+D30+E30+F30+G30+H30+I30+L30+N30+O30','=+D31+E31+F31+G31+H31+I31+L31+N31+O31','=+D32+E32+F32+G32+H32+I32+L32+N32+O32','=+D33+E33+F33+G33+H33+I33+L33+N33+O33','=+D34+E34+F34+G34+H34+I34+L34+N34+O34','=+D35+E35+F35+G35+H35+I35+L35+N35+O35');





        //  $total=array('=+D4+E4+F4+G4+H4+I4+K4+M4+N4','=+D5+E5+F5+G5+H5+I5+K5+M5+N5','=+D6+E6+F6+G6+H6+I6+K6+M6+N6','=+D7+E7+F7+G7+H7+I7+K7+M7+N7','=+D8+E8+F8+G8+H8+I8+K8+M8+N8','=+D9+E9+F9+G9+H9+I9+K9+M9+N9','=+D10+E10+F10+G10+H10+I10+K10+M10+N10','=+D11+E11+F11+G11+H11+I11+K11+M11+N11','=+D12+E12+F12+G12+H12+I12+K12+M12+N12','=+D13+E13+F13+G13+H13+I13+K13+M13+N13','=+D14+E14+F14+G14+H14+I14+K14+M14+N14','=+D15+E15+F15+G15+H15+I15+K15+M15+N15','=+D16+E16+F16+G16+H16+I16+K16+M16+N16','=+D17+E17+F17+G17+H17+I17+K17+M17+N17','=+D18+E18+F18+G18+H18+I18+K18+M18+N18','=+D19+E19+F19+G19+H19+I19+K19+M19+N19','=+D20+E20+F20+G20+H20+I20+K20+M20+N20','=+D21+E21+F21+G21+H21+I21+K21+M21+N21','=+D22+E22+F22+G22+H22+I22+K22+M22+N22','=+D23+E23+F23+G23+H23+I23+K23+M23+N23','=+D24+E24+F24+G24+H24+I24+K24+M24+N24','=+D25+E25+F25+G25+H25+I25+K25+M25+N25','=+D26+E26+F26+G26+H26+I26+K26+M26+N26','=+D27+E27+F27+G27+H27+I27+K27+M27+N27','=+D28+E28+F28+G28+H28+I28+K28+M28+N28','=+D29+E29+F29+G29+H29+I29+K29+M29+N29','=+D30+E30+F30+G30+H30+I30+K30+M30+N30','=+D31+E31+F31+G31+H31+I31+K31+M31+N31','=+D32+E32+F32+G32+H32+I32+K32+M32+N32','=+D33+E33+F33+G33+H33+I33+K33+M33+N33','=+D34+E34+F34+G34+H34+I34+K34+M34+N34');

$CASHSCH=array('=S4-Y4-Z4-AB4-AC4-AA4','=S5-Y5-Z5-AB5-AC5-AA5','=S6-Y6-Z6-AB6-AC6-AA6','=S7-Y7-Z7-AB7-AC7-AA7','=S8-Y8-Z8-AB8-AC8-AA8','=S9-Y9-Z9-AB9-AC9-AA9','=S10-Y10-Z10-AB10-AC10-AA10','=S11-Y11-Z11-AB11-AC11-AA11','=S12-Y12-Z12-AB12-AC12-AA12','=S13-Y13-Z13-AB13-AC13-AA13','=S14-Y14-Z14-AB14-AC14-AA14','=S15-Y15-Z15-AB15-AC15-AA15','=S16-Y16-Z16-AB16-AC16-AA16','=S17-Y17-Z17-AB17-AC17-AA17','=S18-Y18-Z18-AB18-AC18-AA18','=S19-Y19-Z19-AB19-AC19-AA19','=S20-Y20-Z20-AB20-AC20-AA20','=S21-Y21-Z21-AB21-AC21-AA21','=S22-Y22-Z22-AB22-AC22-AA22','=S23-Y23-Z23-AB23-AC23-AA23','=S24-Y24-Z24-AB24-AC24-AA24','=S25-Y25-Z25-AB25-AC25-AA25','=S26-Y26-Z26-AB26-AC26-AA26','=S27-Y27-Z27-AB27-AC27-AA27','=S28-Y28-Z28-AB28-AC28-AA28','=S29-Y29-Z29-AB29-AC29-AA29','=S30-Y30-Z30-AB30-AC30-AA30','=S31-Y31-Z31-AB31-AC31-AA31','=S32-Y32-Z32-AB32-AC32-AA32','=S33-Y33-Z33-AB33-AC33-AA33','=S34-Y34-Z34-AB34-AC34-AA34','=S35-Y35-Z35-AB35-AC35-AA35');



        // $CASHSCH=array('=R4-X4-Y4-AA4-AB4-Z4','=R5-X5-Y5-AA5-AB5-Z5','=R6-X6-Y6-AA6-AB6-Z6','=R7-X7-Y7-AA7-AB7-Z7','=R8-X8-Y8-AA8-AB8-Z8','=R9-X9-Y9-AA9-AB9-Z9','=R10-X10-Y10-AA10-AB10-Z10','=R11-X11-Y11-AA11-AB11-Z11','=R12-X12-Y12-AA12-AB12-Z12','=R13-X13-Y13-AA13-AB13-Z13','=R14-X14-Y14-AA14-AB14-Z14','=R15-X15-Y15-AA15-AB15-Z15','=R16-X16-Y16-AA16-AB16-Z16','=R17-X17-Y17-AA17-AB17-Z17','=R18-X18-Y18-AA18-AB18-Z18','=R19-X19-Y19-AA19-AB19-Z19','=R20-X20-Y20-AA20-AB20-Z20','=R21-X21-Y21-AA21-AB21-Z21','=R22-X22-Y22-AA22-AB22-Z22','=R23-X23-Y23-AA23-AB23-Z23','=R24-X24-Y24-AA24-AB24-Z24','=R25-X25-Y25-AA25-AB25-Z25','=R26-X26-Y26-AA26-AB26-Z26','=R27-X27-Y27-AA27-AB27-Z27','=R28-X28-Y28-AA28-AB28-Z28','=R29-X29-Y29-AA29-AB29-Z29','=R30-X30-Y30-AA30-AB30-Z30','=R31-X31-Y31-AA31-AB31-Z31','=R32-X32-Y32-AA32-AB32-Z32','=R33-X33-Y33-AA33-AB33-Z33','=R34-X34-Y34-AA34-AB34-Z34');

$diff=array('=AE4-AD4','=AE5-AD5','=AE6-AD6','=AE7-AD7','=AE8-AD8','=AE9-AD9','=AE10-AD10','=AE11-AD11','=AE12-AD12','=AE13-AD13','=AE14-AD14','=AE15-AD15','=AE16-AD16','=AE17-AD17','=AE18-AD18','=AE19-AD19','=AE20-AD20','=AE21-AD21','=AE22-AD22','=AE23-AD23','=AE24-AD24','=AE25-AD25','=AE26-AD26','=AE27-AD27','=AE28-AD28','=AE29-AD29','=AE30-AD30','=AE31-AD31','=AE32-AD32','=AE33-AD33','=AE34-AD34','=AE35-AD35');


        //  $diff=array('=AD4-AC4','=AD5-AC5','=AD6-AC6','=AD7-AC7','=AD8-AC8','=AD9-AC9','=AD10-AC10','=AD11-AC11','=AD12-AC12','=AD13-AC13','=AD14-AC14','=AD15-AC15','=AD16-AC16','=AD17-AC17','=AD18-AC18','=AD19-AC19','=AD20-AC20','=AD21-AC21','=AD22-AC22','=AD23-AC23','=AD24-AC24','=AD25-AC25','=AD26-AC26','=AD27-AC27','=AD28-AC28','=AD29-AC29','=AD30-AC30','=AD31-AC31','=AD32-AC32','=AD33-AC33','=AD34-AC34');

for ($i = 1;$i <= count($aDates);$i++)
{

    $col_A_data = "A" . ($i + 3);
    $col_B_data = "B" . ($i + 3);
    $col_R_data = "S" . ($i + 3);
    $col_V_data = "W" . ($i + 3);
    $col_W_data = "X" . ($i + 3);
    $col_AC_data = "AD" . ($i + 3);
    $col_AE_data = "AF" . ($i + 3);

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

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A'.(count($aDates)+8))
        //     ->getBorders()
        //     ->getOutline()
        //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        //     ->setColor(new Color('000000'));

$spreadsheet->getActiveSheet()
->getStyle('A'.(count($aDates)+7).':B'.(count($aDates)+7))
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

$salereport->mergeCells('A'.(count($aDates)+7).':B'.(count($aDates)+7))
->setCellValue('A'.(count($aDates)+7), 'SUB TOTAL');

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A'.(count($aDates)+8).':B'.(count($aDates)+8))
        //     ->getAlignment()
        //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        // $salereport->mergeCells('A'.(count($aDates)+8).':B'.(count($aDates)+8))
        //     ->setCellValue('A'.(count($aDates)+8), '(%) TO NET SALE');
          //Done..........



$formulaarray = [null,'=SUM(D4:D'.(count($aDates)+5).')','=SUM(E4:E'.(count($aDates)+5).')','=SUM(F4:F'.(count($aDates)+5).')','=SUM(G4:G'.(count($aDates)+5).')','=SUM(H4:H'.(count($aDates)+5).')','=SUM(I4:I'.(count($aDates)+5).')','=SUM(J4:J'.(count($aDates)+5).')','=SUM(K4:K'.(count($aDates)+5).')','=SUM(L4:L'.(count($aDates)+5).')','=SUM(M4:M'.(count($aDates)+5).')','=SUM(N4:N'.(count($aDates)+5).')','=SUM(O4:O'.(count($aDates)+5).')',null,null,null,'=SUM(S4:S'.(count($aDates)+5).')','=SUM(T4:T'.(count($aDates)+5).')','=SUM(U4:U'.(count($aDates)+5).')','=SUM(V4:V'.(count($aDates)+5).')','=SUM(W4:W'.(count($aDates)+5).')','=SUM(X4:X'.(count($aDates)+5).')','=SUM(Y4:Y'.(count($aDates)+5).')','=SUM(Z4:Z'.(count($aDates)+5).')','=SUM(AA4:AA'.(count($aDates)+5).')','=SUM(AB4:AB'.(count($aDates)+5).')','=SUM(AC4:AC'.(count($aDates)+5).')','=SUM(AD4:AD'.(count($aDates)+5).')','=SUM(AE4:AE'.(count($aDates)+5).')','=SUM(AF4:AF'.(count($aDates)+5).')','=SUM(AG4:AG'.(count($aDates)+5).')','=SUM(AH4:AH'.(count($aDates)+5).')'];
 // dump($formulaarray);


        // $formulaarray = [null,'=SUM(D4:D'.(count($aDates)+5).')','=SUM(E4:E'.(count($aDates)+5).')','=SUM(F4:F'.(count($aDates)+5).')','=SUM(G4:G'.(count($aDates)+5).')','=SUM(H4:H'.(count($aDates)+5).')','=SUM(I4:I'.(count($aDates)+5).')','=SUM(J4:J'.(count($aDates)+5).')','=SUM(K4:K'.(count($aDates)+5).')','=SUM(L4:L'.(count($aDates)+5).')','=SUM(M4:M'.(count($aDates)+5).')','=SUM(N4:N'.(count($aDates)+5).')','=SUM(O4:O'.(count($aDates)+5).')',null,null,'=SUM(R4:R'.(count($aDates)+5).')','=SUM(S4:S'.(count($aDates)+5).')','=SUM(T4:T'.(count($aDates)+5).')','=SUM(U4:U'.(count($aDates)+5).')','=SUM(V4:V'.(count($aDates)+5).')','=SUM(W4:W'.(count($aDates)+5).')','=SUM(X4:X'.(count($aDates)+5).')','=SUM(Y4:Y'.(count($aDates)+5).')','=SUM(Z4:Z'.(count($aDates)+5).')','=SUM(AA4:AA'.(count($aDates)+5).')','=SUM(AB4:AB'.(count($aDates)+5).')','=SUM(AC4:AC'.(count($aDates)+5).')','=SUM(AD4:AD'.(count($aDates)+5).')','=SUM(AE4:AE'.(count($aDates)+5).')','=SUM(AF4:AF'.(count($aDates)+5).')','=SUM(AH4:AH'.(count($aDates)+5).')'];

        // $secformulaarray = [null, '=D'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=E'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=F'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=G'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=H'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=I'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=J'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=K'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=L'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=M'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=N'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=O'.(count($aDates)+7).'/$R$'.(count($aDates)+7), null, null, '=R'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=S'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=T'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=U'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=V'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=W'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=X'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=Y'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=Z'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AA'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AB'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AC'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AD'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AE'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AF'.(count($aDates)+7).'/$R$'.(count($aDates)+7), '=AH'.(count($aDates)+7).'/$R$'.(count($aDates)+7)];

$spreadsheet->getActiveSheet()
->getStyle('A'.(count($aDates)+7).':AH'.(count($aDates)+8))
->getAlignment()
->setWrapText(true);
$spreadsheet->getActiveSheet()
->getStyle('A'.(count($aDates)+7).':AH'.(count($aDates)+8))
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()
->getStyle('A'.(count($aDates)+7).':AH'.(count($aDates)+8))
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

            // $spreadsheet->getActiveSheet()
            //             ->getStyle($columnID . (count($aDates)+8))->getBorders()
            //             ->getOutline()
            //             ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            //             ->setColor(new Color('000000'));

            // $spreadsheet->getActiveSheet()
            //             ->getStyle($columnID . (count($aDates)+8))->getAlignment()
            //             ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // $salereport->setCellValue($columnID . (count($aDates)+8), $secformulaarray[$j]);

    $j++;
}


        // $j = $j - 1;
$j = $j ;
foreach (range('A', 'H') as $columnID)
{
    $spreadsheet->getActiveSheet()
    ->getStyle('A' . $columnID .(count($aDates)+7))->getBorders()
    ->getOutline()
    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
    ->setColor(new Color('000000'));

    $spreadsheet->getActiveSheet()
    ->getStyle('A' . $columnID .(count($aDates)+7))->getAlignment()
    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // dump($j);
            // dd($formulaarray[$j]);

           //$salereport->setCellValue('A' . $columnID . (count($aDates)+7), $formulaarray[$j - 1]);
    $salereport->setCellValue('A' . $columnID . (count($aDates)+7), $formulaarray[$j]);


            // $spreadsheet->getActiveSheet()
            //     ->getStyle('A' . $columnID .(count($aDates)+8))->getBorders()
            //     ->getOutline()
            //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            //     ->setColor(new Color('000000'));

            // $spreadsheet->getActiveSheet()
            //     ->getStyle('A' . $columnID . (count($aDates)+8))->getAlignment()
            //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // $salereport->setCellValue('A' . $columnID . (count($aDates)+8), $secformulaarray[$j - 1]);

    $j++;
}
//------------------------------------
$colval = array(
    'NET SALE',
    'NO. OF DAYS',
    'AVG SALE/DAY',
    'PROJECTED  SALE'
);

$colval39 = array(
    '=S'.(count($aDates)+7),
    '=COUNT(D4:D'.(count($aDates)+5).')',
    '=D'.(count($aDates)+8).'/D'.(count($aDates)+9),
    '=D'.(count($aDates)+10).'*D'.(count($aDates)+9)
);
        //  dd($colval39);

$colvalR = array(
    'NET SALE',
    'Gift Card',
    'CR/CARD ',
    'CASH IN HAND'
);
$colvalV = array(
    '=S'.(count($aDates)+7),
    '=AC'.(count($aDates)+7),
            // '=X'.(count($aDates)+7).'+AA'.(count($aDates)+7),
            //  '=AB'.(count($aDates)+7),
    '=AB'.(count($aDates)+7).'+Y'.(count($aDates)+7).'+Z'.(count($aDates)+7),
    '=AD'.(count($aDates)+7)
);



      //  dd($colvalV);

$l = 0;
//dd('D'.(count($aDates)+8).':D'.(count($aDates)+11));
$spreadsheet->getActiveSheet()
->getStyle('D'.(count($aDates)+8).':D'.(count($aDates)+11))
->getAlignment()
->setWrapText(true);
$spreadsheet->getActiveSheet()
->getStyle('D'.(count($aDates)+8).':D'.(count($aDates)+11))
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()
->getStyle('D'.(count($aDates)+8).':D'.(count($aDates)+11))
->getAlignment()
->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$spreadsheet->getActiveSheet()
->getStyle('V'.(count($aDates)+8).':V'.(count($aDates)+11))
->getAlignment()
->setWrapText(true);
$spreadsheet->getActiveSheet()
->getStyle('V'.(count($aDates)+8).':V'.(count($aDates)+11))
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()
->getStyle('V'.(count($aDates)+8).':V'.(count($aDates)+11))
->getAlignment()
->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$salereport->setCellValue('A'.(count($aDates)+6), 'ADJST');

for ($i =(count($aDates)+8);$i <= (count($aDates)+11);$i++)
{

    $salereport->mergeCells('A' . $i . ':B' . $i)->setCellValue('A' . $i, $colval[$l]);

    $spreadsheet->getActiveSheet()
    ->getStyle('D' . $i)->getBorders()
    ->getOutline()
    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
    ->setColor(new Color('000000'));

    $spreadsheet->getActiveSheet()
    ->getStyle('W' . $i)->getBorders()
    ->getOutline()
    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
    ->setColor(new Color('000000'));

    $salereport->setCellValue('D' . $i, $colval39[$l]);

    $salereport->setCellValue('S' . $i, $colvalR[$l]);

    $salereport->setCellValue('W' . $i, $colvalV[$l]);

    $l++;
}

$salereport->setCellValue('AB'.(count($aDates)+8), '=AB'.(count($aDates)+7).'+Y'.(count($aDates)+7));
$salereport->setCellValue('AH3',$last_day_opening_bal->cash_in_hand_opening_balance ?? '');
        //$salereport->setCellValue('AC'.(count($aDates)+11), 'CASH DIFF');
       // $salereport->setCellValue('AD'.(count($aDates)+11), '=AD'.(count($aDates)+7).'-AC'.(count($aDates)+7));



$spreadsheet->createSheet();



$format = '0.000';
$spreadsheet->getActiveSheet()
->getStyle('D4:AH'.(count($aDates)+12))->getNumberFormat()
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

