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
 
class CashDeposit
{

    public $month;
    public $year;

    public function __construct($month,$year){

        if(!$month)
        {
            $this->month=Carbon::now('m');
        }else{
            $this->month=$month;
        }

        if(!$year)
        {
            $this->year=Carbon::now('Y');
        }else{
            $this->year=$year;
        }



    }

    public function result()
    {

        $spreadsheet = new Spreadsheet();

        $current_month=$this->month;

        $year=$this->year;

        //five tab bank deposit
        $monthdeposit = DailySaleReport::select('branch_id',DB::raw('DATE(report_date) as date') 
                                       , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'))
                                        ->whereMonth('report_date', $current_month)
                                        ->whereYear('report_date',$year)
                                        ->groupBy('date','branch_id')
                                        ->get();

               

         $dailymonthdepositbank=array();
         foreach ($monthdeposit as $value_bank) {
            $dailymonthdepositbank[date('d-M-Y',strtotime($value_bank->date))][$value_bank->branch_id]=$value_bank;
         }

         $branchbankdeposit=Branch::where('status','1')->get()->pluck('short_name','id');
                  
       
        /**
         * start five Report BANK DEP
         */

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

     // $aDates=array_intersect_key($aDates,array_keys ($dailymonthdepositbank));


        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:H1')
            ->setCellValue('A1', "MUGHAL MAHAL-BRANCH WISE SALES CASH DEPOSIT")
            ->getStyle("A1:H1")
            ->getFont()
            ->setSize(12);
            //->setItalic(true);
        
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

        $branch_namepe=Branch::select('short_name')->where('status','1')->get()->pluck('short_name')->toArray();
        $rowArray=array_merge($firstar,$branch_namepe,$thirdaar);
         
         $branch_na=Branch::select('short_name','id')->where('status','1')->get()->pluck('short_name','id');

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('I1:'.$rowname[count($rowArray)-1].'1')
            ->setCellValue('I1',date('d-m-Y',strtotime($aDates[count($aDates)-(count($aDates))]))." To ".date('d-m-Y',strtotime($aDates[count($aDates)-1])))
            ->getStyle("I1:M1")
            ->getFont()
            ->setSize(12);
            //->setItalic(true);

        // $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue($rowname[count($rowArray)-1].'1', "Month & Year")
        //     ->getStyle($rowname[count($rowArray)-1]."1")
        //     ->getFont()
        //     ->setSize(8)
        //     ->setItalic(true);

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
            ->getStyle('A2:'.$rowname[count($rowArray)].'2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:'.$rowname[count($rowArray)].'2')
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
     
//      $spreadsheet->getActiveSheet()
// ->getStyle('A2:AH3')
// ->getFill()
// ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
// ->getStartColor()
// ->setARGB('9bdef2'); 

     
     $spreadsheet->getActiveSheet()
->getStyle('A2:AH3')
->getFont()->setName('Calibri') ; 

       
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
            ->setTitle('BANK Deposit Branch Wise');

        // $BANKDEP->mergeCells('C2:'.$rowname[count($rowArray)-2].'2')
        //     ->setCellValue('C2', 'CASH IN HAND - ACTUAL');
        // $BANKDEP->setCellValue($rowname[count($rowArray)-1].'2', "Observation ");

        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        //$spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)].'3')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)].'3')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)].'3')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)].'3')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:'.$rowname[count($rowArray)].'3')
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
                    ->getStyle('C4:'.$rowname[count($rowArray)-1].count($aDates))->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

         $col_total=array();

         for ($i = 1;$i <=count($aDates);$i++){

          $col_total[]='=SUM(C'.($i+3).':'.$rowname[count($rowArray)-2].($i+3).')';
        
         
        }
          
        for ($i = 1;$i <=count($aDates);$i++)
        {

            $col_A_data = "A" . ($i + 3);
            $col_B_data = "B" . ($i + 3);
            $cols_total = $rowname[count($rowArray)-1]. ($i + 3);

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
           

       // $BANKDEP->setCellValue('A36', "NO.DAYS SALE");

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
       
        foreach(range('C', $rowname[count($rowArray)]) as $rowval){

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
  


        foreach (range('B',$rowname[count($rowArray)-1]) as $columnID)
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

           // $BANKDEP->setCellValue($key, $colbtom[$i]);

          //  $BANKDEP->setCellValue($key2, count($aDates));

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
        
        $format = '0.000';
        $spreadsheet->getActiveSheet()
            ->getStyle('A1:'.$rowname[count($rowArray)-1].'38')->getNumberFormat()
            ->setFormatCode($format);

         $spreadsheet->getActiveSheet()->removeRow(2);

      
        $spreadsheet->createSheet();

       
        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
        $timestamp = "-".date('d-m-Y')."(".date('h-i-s-A',time()).")";
        $fileName = 'Cash-Deposite-Branch-Wise'.$timestamp.'.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

    
}

