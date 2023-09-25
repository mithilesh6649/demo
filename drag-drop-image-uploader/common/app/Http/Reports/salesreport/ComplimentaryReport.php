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

class ComplimentaryReport
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

    $last_day = date("Y-m-d", strtotime($first_second));
    if($last_day =="2022-09-01"){
      $last_day_opening_bal = DailySaleReport::where("report_date",date("Y-m-d",strtotime($last_day)))->where('branch_id',$branch_id)->first();
   
    }else{
     $last_day_opening_bal = DailySaleReport::where("report_date",$last_day)->where('branch_id',$branch_id)->first();
    }

    $dates = DailySaleReport::select(DB::raw('DATE(report_date) as date'))->whereDate("report_date",">=",date("Y-m-d", strtotime($first_second)))->whereDate("report_date","<=",date("Y-m-d", strtotime($last_second)))->groupBy('date')
    ->get()
    ->pluck('date');

    $datevales=array();
    foreach($data as $d)
    {
        $datevales[date('d-M-Y',strtotime($d->report_date))]=$d;
    }

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
->mergeCells('A1:F1')
->setCellValue('A1', "MUGHAL MAHAL COMPLIMENTARY REPORT F/M " . date('M-Y',strtotime($first_second)))
->getStyle("A1:F1")
->getFont()
->setSize(9);

$spreadsheet->getActiveSheet()
->getStyle('A1:F1')
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


$spreadsheet->setActiveSheetIndex(0)
->mergeCells('A2:B2')
->setCellValue('A2', 'Branch - '.$branch_name->short_name)
->getStyle("A2:B2")
->getFont()
->setSize(9);

 $spreadsheet->setActiveSheetIndex(0)
    ->mergeCells('D2:F2')
    ->setCellValue('D2', 'Period :'.date('d-m-Y',strtotime($first_second))." To ".date('d-m-Y',strtotime($last_second)))
    ->getStyle("D2:F2")
    ->getFont()
    ->setSize(9);
            //->setItalic(true);

$spreadsheet->getActiveSheet()
->getStyle('A2:F2')
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// $spreadsheet->getActiveSheet()
// ->getStyle('A'.(count($aDates)+7).':F'.(count($aDates)+7))
// ->getFont()
// ->setSize(6);

$spreadsheet->getActiveSheet()
->getStyle('A2:F2')
->getFont()
->setSize(10);

$spreadsheet->getActiveSheet()
->getStyle('A1:F1')
->getFill()
->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
->getStartColor()
->setARGB('FFFF00');

$spreadsheet->getActiveSheet()
->getStyle('A2:F3')
->getFill()
->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
->getStartColor()
->setARGB('9bdef2');


// $spreadsheet->getActiveSheet()
// ->getStyle('A'.(count($aDates)+7).':F'.(count($aDates)+7))
// ->getFill()
// ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
// ->getStartColor()
// ->setARGB('ed7b7b');

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
->getStyle('A3:F3')
->getFont()->setBold(true)->setName('Calibri') ;

$spreadsheet->getActiveSheet()
->getStyle('A2:F2')
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


$salereport = $spreadsheet->getActiveSheet()
->setTitle('COMPLIMENTARY REPORT');

$spreadsheet->getActiveSheet()
->getStyle('A3:F3')
->getAlignment()
->setWrapText(true);
$spreadsheet->getActiveSheet()
->getStyle('A3:F3')
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()
->getStyle('A3:F3')
->getAlignment()
->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$spreadsheet->getActiveSheet()
->getStyle('A3:F3')
->getAlignment()
->setWrapText(true);
$spreadsheet->getActiveSheet()
->getStyle('A3:F3')
->getFont()
->setSize(7);
$spreadsheet->getActiveSheet()
->getRowDimension('3')
->setRowHeight(25, 'pt');

$rowArray = ['DATE', 'Name', 'Contact', 'Invoice', 'Amount', 'Ref'];

$i = 0;
foreach (range('A', 'F') as $columnID)
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

$spreadsheet->getActiveSheet()
->getStyle('C4:C'.(count($aDates)+12))
->getAlignment()
->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



$i=0;
$m=1;

foreach ($datevales as $key => $value) {
   
   if($value['complimentary_amount']!=null)
     {
        $a=0;
        foreach(json_decode($value['complimentary_amount']) as $complimentary_amount)
        {
           
            $salereport->setCellValue('A'.($i+4),date('d/m/Y',strtotime($key)));
            $salereport->setCellValue('B'.($i+4),json_decode($value['complimentary_name'])[$a]);
            $salereport->setCellValue('C'.($i+4),json_decode($value['complimentary_contact'])[$a]);
            $salereport->setCellValue('D'.($i+4),json_decode($value['complimentary_invoice'])[$a]);
            $salereport->setCellValue('E'.($i+4),$complimentary_amount);
            $salereport->setCellValue('F'.($i+4),json_decode($value['complimentary_ref'])[$a]);
            
          $a++;
          $m++;
          $i++;
        }
      
     }else{
         
         $salereport->setCellValue('A'.($i+4),$key);
         $m++;
         $i++;
     }

}

$spreadsheet->createSheet();


$format = '0.000';
$spreadsheet->getActiveSheet()
->getStyle('E4:E'.($m+4))->getNumberFormat()
->setFormatCode($format);

/* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
$spreadsheet->setActiveSheetIndex(0);

$timestamp = "-".date('d-m-Y')."(".date('h-i-s-A',time()).")";

$fileName = 'complimentary-Reports'.$timestamp.'.xlsx';
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
$writer->save('php://output');
}


}

