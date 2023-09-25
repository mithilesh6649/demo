<?php
namespace App\Http\Reports;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use DateTime;
use DatePeriod;
use DateInterval;
class GenerateCreditCardReport  
{
    public $branch_id;
    public $date_range;

	public function __construct($branch_id,$date_range){
        $this->branch_id = base64_decode($branch_id);
        $this->date_range = base64_decode($date_range);
    }

    public function report(){

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:Q1')
        ->setCellValue('A1', 'MUGHAL MAHAL  Yearly Sales Report -Credit Card FY-2022')->getStyle("A1:N1")->getFont()->setSize(16)->setBold(true);
        
        $spreadsheet->getActiveSheet()
                     ->getStyle('A17:W17')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
         $spreadsheet->getActiveSheet()
                     ->getStyle('A18:W18')
                     ->getBorders()
                     ->getBottom()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         for($i=16;$i<=18;$i++)
         {
            $oclbd="A".$i.":W".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($oclbd)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
         }
            
        $spreadsheet->getActiveSheet()
                     ->getStyle('A20:N20')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                     ->getStyle('A20:F20')
                     ->getBorders()
                     ->getBottom()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                     ->getStyle('F20')
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

        for ($i=20; $i <=27 ; $i++) { 
            $bord_N="N".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_N)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

            $bord_G="G".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_G)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
        }
        
        for ($i=25; $i <=26 ; $i++) { 
            $bord_HN="H".$i.":N".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_HN)
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
        }
           
        $spreadsheet->getActiveSheet()
                     ->getStyle('A2:W2')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                     ->getStyle('W1:W3')
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
                     ->getStyle('A27:N27')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                    ->getRowDimension('2')
                    ->setRowHeight(20, 'pt'); 

        $spreadsheet->getActiveSheet()
                    ->getRowDimension('20')
                    ->setRowHeight(20, 'pt');

         $spreadsheet->getActiveSheet()
                    ->getRowDimension('17')
                    ->setRowHeight(20, 'pt');             

        $spreadsheet->getActiveSheet()
                    ->getRowDimension('1')
                    ->setRowHeight(30, 'pt');
         $spreadsheet->getActiveSheet()
                    ->getRowDimension('3')
                    ->setRowHeight(25, 'pt');
        $spreadsheet->getActiveSheet()
                    ->getRowDimension('21')
                    ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $spreadsheet->setActiveSheetIndex(0)->mergeCells('R1:W1')
                    ->setCellValue('R1', 'MUGHAL MAHAL')
                    ->getStyle("R1:W1")
                    ->getFont()
                    ->setSize(16)->setBold(true);

        $spreadsheet->getActiveSheet()
                    ->getStyle('R1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $spreadsheet->getActiveSheet()
                    ->getStyle('A2:U2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
        $spreadsheet->getActiveSheet()
                    ->getStyle('B2:T2')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
                   
        $spreadsheet->getActiveSheet()
                    ->getStyle('C2:W2')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
        
         $spreadsheet->getActiveSheet()
                    ->getStyle('A17:W17')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        $spreadsheet->getActiveSheet()
                    ->getStyle('A18:W18')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
         

        foreach(range('B','W') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $bymonth =  $spreadsheet->getActiveSheet()->setTitle('By Month ');
        
        $bymonth->mergeCells('A2:B2')->setCellValue('A2','Card Type');
        $bymonth->mergeCells('C2:E2')->setCellValue('C2','CC AMEX 3.25%');
        $bymonth->mergeCells('F2:H2')->setCellValue('F2','CC VISA 2.25%');
        $bymonth->mergeCells('I2:K2')->setCellValue('I2','CC MSTER 2.25%');
        $bymonth->mergeCells('L2:N2')->setCellValue('L2','CC DINERS 3.5%');
        $bymonth->mergeCells('O2:Q2')->setCellValue('O2','PAYMENT GTY 1%');
        $bymonth->mergeCells('R2:T2')->setCellValue('R2','DR KNET 0.250%');
        $bymonth->mergeCells('U2:W2')->setCellValue('U2','MONTH TOTAL');
       
       /**
        * Creating a third row in a first tab
        */
      

        $bymonth->setCellValue('A3', 'S.NO');
        $bymonth->setCellValue('B3', 'DATE');
        $bymonth->setCellValue('C3', 'Inv Day TTL');
        $bymonth->setCellValue('D3', 'comm');
        $bymonth->setCellValue('E3', 'After Com TTL');
        $bymonth->setCellValue('F3', 'Inv Day TTL');
        $bymonth->setCellValue('G3', 'comm');
        $bymonth->setCellValue('H3', 'After Com TTL');
        $bymonth->setCellValue('I3', 'Inv Day TTL');
        $bymonth->setCellValue('J3', 'comm');
        $bymonth->setCellValue('K3', 'After Com TTL');
        $bymonth->setCellValue('L3', 'Inv Day TTL');
        $bymonth->setCellValue('M3', 'comm');
        $bymonth->setCellValue('N3', 'After Com TTL');
        $bymonth->setCellValue('O3', 'Inv Day TTL');
        $bymonth->setCellValue('P3', 'comm');
        $bymonth->setCellValue('Q3', 'After Com TTL');
        $bymonth->setCellValue('R3', 'Inv Day TTL');
        $bymonth->setCellValue('S3', 'comm');
        $bymonth->setCellValue('T3', 'After Com TTL');
        $bymonth->setCellValue('U3', 'Inv Day TTL');
        $bymonth->setCellValue('V3', 'COMM');
        $bymonth->setCellValue('W3', 'After Com TTL');
        

        for ($i=1; $i <=12 ; $i++) {
              $col="A".($i+3);
              $col2="B".($i+3);
              $col_u="U".($i+3);
              $col_v="V".($i+3);
              $col_w="W".($i+3);
            $spreadsheet->getActiveSheet()
                    ->getStyle($col)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $bymonth->setCellValue($col,$i);

             $spreadsheet->getActiveSheet()
                    ->getStyle($col2)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $bymonth->setCellValue($col2,date("M-y",mktime(0,0,0,$i,1,date("Y"))));
          
            $spreadsheet->getActiveSheet()
                    ->getStyle($col_u)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $bymonth->setCellValue($col_u,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_v)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $bymonth->setCellValue($col_v,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_w)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $bymonth->setCellValue($col_w,'00.000');

        }

       
        $bymonth->mergeCells('A17:B17')->setCellValue('A17','TTL Bef Vs Aft');
        $bymonth->mergeCells('A18:B18')->setCellValue('A18','Comm TTL');

         $bymonth->setCellValue('W3', 'After Com TTL');
         $bymonth->setCellValue('V18', '00.000');
         $bymonth->setCellValue('T18', '00.000');
         $bymonth->setCellValue('Q18', '00.000');
         $bymonth->setCellValue('N18', '00.000');
          $bymonth->setCellValue('K18', '00.000');
         $bymonth->setCellValue('H18', '00.000');
         $bymonth->setCellValue('E18', '00.000');
         
        
          foreach(range('C','W') as $columnID) {
             $col=$columnID."17";
              $spreadsheet->getActiveSheet()
                    ->getStyle($col)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $bymonth->setCellValue($col,'00.000');
            } 

         $bymonth->setCellValue("A20","Details of  Cr & Dr Card "); 
         $bymonth->setCellValue("A21","A) TOTAL CREDIT CARD SALES - AMEX "); 
         $bymonth->setCellValue("A22","B) TOTAL CREDIT CARD SALES - VISA"); 
         $bymonth->setCellValue("A23","C) TOTAL CREDIT CARD SALES - MASTER");   
         $bymonth->setCellValue("A24","D) TOTAL CREDIT CARD SALES - KNET"); 
         $bymonth->setCellValue("A25","E) TOTAL CREDIT CARD SALES - DINERS"); 
         $bymonth->setCellValue("A26","F) TOTAL CREDIT CARD SALES - OTHERS"); 


        
         $spreadsheet->getActiveSheet()
                    ->getStyle("H20")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $bymonth->mergeCells('H20:I20')->setCellValue('H20','Total');

         $spreadsheet->getActiveSheet()
                    ->getStyle("K20")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $bymonth->mergeCells('K20:L20')->setCellValue('K20','Aft Comm');

         $spreadsheet->getActiveSheet()
                    ->getStyle("N20")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
         $bymonth->mergeCells('N20')->setCellValue('N20','Comm');

          $spreadsheet->getActiveSheet()
                    ->getStyle("F27")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
         $bymonth->mergeCells('F27')->setCellValue('F27','Total');


         for ($i=21; $i<=27 ; $i++) { 
             $col_h="H".$i;
             $m_col_h="H".$i.":I".$i;
             
             $col_k="K".$i;
             $m_col_k="K".$i.":L".$i;

             $col_N="N".$i;
           

              $spreadsheet->getActiveSheet()
                    ->getStyle($col_h)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $bymonth->mergeCells($m_col_h)->setCellValue($col_h,'00.000');

               $spreadsheet->getActiveSheet()
                    ->getStyle($col_k)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $bymonth->mergeCells($m_col_k)->setCellValue($col_k,'00.000');

               $spreadsheet->getActiveSheet()
                    ->getStyle($col_N)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $bymonth->setCellValue($col_N,'00.000');
               
         }


        $spreadsheet->createSheet();

        /**
         * first tab design end
         * start second tab design
         */
 
        $spreadsheet->setActiveSheetIndex(1)->mergeCells('A1:Q1')
        ->setCellValue('A1', 'MUGHAL MAHAL  Yearly Sales Report -Credit Card FY-2022')->getStyle("A1:N1")->getFont()->setSize(16)->setBold(true);
        
        $spreadsheet->getActiveSheet()
                     ->getStyle('A15:W15')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
         $spreadsheet->getActiveSheet()
                     ->getStyle('A16:W16')
                     ->getBorders()
                     ->getBottom()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         for($i=14;$i<=16;$i++)
         {
            $oclbd="A".$i.":W".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($oclbd)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
         }
            
        $spreadsheet->getActiveSheet()
                     ->getStyle('A18:N18')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                     ->getStyle('A18:F18')
                     ->getBorders()
                     ->getBottom()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                     ->getStyle('F18')
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

        for ($i=18; $i <=24 ; $i++) { 
            $bord_N="N".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_N)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

            $bord_G="G".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_G)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
        }
        
        for ($i=23; $i <=24 ; $i++) { 
            $bord_HN="H".$i.":N".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_HN)
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
        }
           
        $spreadsheet->getActiveSheet()
                     ->getStyle('A2:W2')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                     ->getStyle('W1:W3')
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
                     ->getStyle('A25:N25')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                    ->getRowDimension('2')
                    ->setRowHeight(20, 'pt'); 

        $spreadsheet->getActiveSheet()
                    ->getRowDimension('18')
                    ->setRowHeight(20, 'pt');

         $spreadsheet->getActiveSheet()
                    ->getRowDimension('15')
                    ->setRowHeight(20, 'pt');             

        $spreadsheet->getActiveSheet()
                    ->getRowDimension('1')
                    ->setRowHeight(30, 'pt');
         $spreadsheet->getActiveSheet()
                    ->getRowDimension('3')
                    ->setRowHeight(25, 'pt');
        $spreadsheet->getActiveSheet()
                    ->getRowDimension('19')
                    ->setRowHeight(25, 'pt');

        $spreadsheet->getActiveSheet()
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

        $spreadsheet->setActiveSheetIndex(1)->mergeCells('R1:W1')
                    ->setCellValue('R1', 'Branch')
                    ->getStyle("R1:W1")
                    ->getFont()
                    ->setSize(16)->setBold(true);

        $spreadsheet->getActiveSheet()
                    ->getStyle('R1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $spreadsheet->getActiveSheet()
                    ->getStyle('A2:U2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
        $spreadsheet->getActiveSheet()
                    ->getStyle('B2:T2')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
                   
        $spreadsheet->getActiveSheet()
                    ->getStyle('C2:W2')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
        
         $spreadsheet->getActiveSheet()
                    ->getStyle('A15:W15')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        $spreadsheet->getActiveSheet()
                    ->getStyle('A16:W16')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
         

        foreach(range('B','W') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $bybranch =  $spreadsheet->getActiveSheet()->setTitle('By Branch ');
        
        $bybranch->mergeCells('A2:B2')->setCellValue('A2','Card Type');
        $bybranch->mergeCells('C2:E2')->setCellValue('C2','CC AMEX 3.25%');
        $bybranch->mergeCells('F2:H2')->setCellValue('F2','CC VISA 2.25%');
        $bybranch->mergeCells('I2:K2')->setCellValue('I2','CC MSTER 2.25%');
        $bybranch->mergeCells('L2:N2')->setCellValue('L2','CC DINERS 3.5%');
        $bybranch->mergeCells('O2:Q2')->setCellValue('O2','PAYMENT GTY 1%');
        $bybranch->mergeCells('R2:T2')->setCellValue('R2','DR KNET 0.250%');
        $bybranch->mergeCells('U2:W2')->setCellValue('U2','MONTH TOTAL');
       
        $bybranch->setCellValue('A3', 'S.NO');
        $bybranch->setCellValue('B3', 'DATE');
        $bybranch->setCellValue('C3', 'Inv Day TTL');
        $bybranch->setCellValue('D3', 'comm');
        $bybranch->setCellValue('E3', 'After Com TTL');
        $bybranch->setCellValue('F3', 'Inv Day TTL');
        $bybranch->setCellValue('G3', 'comm');
        $bybranch->setCellValue('H3', 'After Com TTL');
        $bybranch->setCellValue('I3', 'Inv Day TTL');
        $bybranch->setCellValue('J3', 'comm');
        $bybranch->setCellValue('K3', 'After Com TTL');
        $bybranch->setCellValue('L3', 'Inv Day TTL');
        $bybranch->setCellValue('M3', 'comm');
        $bybranch->setCellValue('N3', 'After Com TTL');
        $bybranch->setCellValue('O3', 'Inv Day TTL');
        $bybranch->setCellValue('P3', 'comm');
        $bybranch->setCellValue('Q3', 'After Com TTL');
        $bybranch->setCellValue('R3', 'Inv Day TTL');
        $bybranch->setCellValue('S3', 'comm');
        $bybranch->setCellValue('T3', 'After Com TTL');
        $bybranch->setCellValue('U3', 'Inv Day TTL');
        $bybranch->setCellValue('V3', 'COMM');
        $bybranch->setCellValue('W3', 'After Com TTL');
        
          $branch_name=array('Fahahaheel','Farwaniya','Mahboula','Hawally','Jahra','Marina Mall','Salmiya','Sharq','Khairan','Shuwaikh');

        for ($i=1; $i <=10 ; $i++) {
              $col="A".($i+3);
              $col2="B".($i+3);
              $col_u="U".($i+3);
              $col_v="V".($i+3);
              $col_w="W".($i+3);
            $spreadsheet->getActiveSheet()
                    ->getStyle($col)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $bybranch->setCellValue($col,$i);

             $spreadsheet->getActiveSheet()
                    ->getStyle($col2)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $bybranch->setCellValue($col2,$branch_name[$i-1]);
          
            $spreadsheet->getActiveSheet()
                    ->getStyle($col_u)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $bybranch->setCellValue($col_u,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_v)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $bybranch->setCellValue($col_v,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_w)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $bybranch->setCellValue($col_w,'00.000');

        }

       
        $bybranch->mergeCells('A15:B15')->setCellValue('A15','TTL Bef Vs Aft');
        $bybranch->mergeCells('A16:B16')->setCellValue('A16','Comm TTL');

         $bybranch->setCellValue('W3', 'After Com TTL');
         $bybranch->setCellValue('V16', '00.000');
         $bybranch->setCellValue('T16', '00.000');
         $bybranch->setCellValue('Q16', '00.000');
         $bybranch->setCellValue('N16', '00.000');
         $bybranch->setCellValue('K16', '00.000');
         $bybranch->setCellValue('H16', '00.000');
         $bybranch->setCellValue('E16', '00.000');
         
        
          foreach(range('C','W') as $columnID) {
             $col=$columnID."15";
              $spreadsheet->getActiveSheet()
                    ->getStyle($col)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $bybranch->setCellValue($col,'00.000');
            } 

         $bybranch->setCellValue("A18","Details of  Cr & Dr Card "); 
         $bybranch->setCellValue("A19","A) TOTAL CREDIT CARD SALES - AMEX "); 
         $bybranch->setCellValue("A20","B) TOTAL CREDIT CARD SALES - VISA"); 
         $bybranch->setCellValue("A21","C) TOTAL CREDIT CARD SALES - MASTER");   
         $bybranch->setCellValue("A22","D) TOTAL CREDIT CARD SALES - KNET"); 
         $bybranch->setCellValue("A23","E) TOTAL CREDIT CARD SALES - DINERS"); 
         $bybranch->setCellValue("A24","F) TOTAL CREDIT CARD SALES - OTHERS"); 


        
         $spreadsheet->getActiveSheet()
                    ->getStyle("H18")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $bybranch->mergeCells('H18:I18')->setCellValue('H18','Total');

         $spreadsheet->getActiveSheet()
                    ->getStyle("K18")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $bybranch->mergeCells('K18:L18')->setCellValue('K18','Aft Comm');

         $spreadsheet->getActiveSheet()
                    ->getStyle("N18")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
         $bybranch->mergeCells('N18')->setCellValue('N18','Comm');

          $spreadsheet->getActiveSheet()
                    ->getStyle("F25")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
         $bybranch->mergeCells('F25')->setCellValue('F25','Total');


         for ($i=19; $i<=25 ; $i++) { 
             $col_h="H".$i;
             $m_col_h="H".$i.":I".$i;
             
             $col_k="K".$i;
             $m_col_k="K".$i.":L".$i;

             $col_N="N".$i;
           

              $spreadsheet->getActiveSheet()
                    ->getStyle($col_h)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $bybranch->mergeCells($m_col_h)->setCellValue($col_h,'00.000');

               $spreadsheet->getActiveSheet()
                    ->getStyle($col_k)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $bybranch->mergeCells($m_col_k)->setCellValue($col_k,'00.000');

               $spreadsheet->getActiveSheet()
                    ->getStyle($col_N)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $bymonth->setCellValue($col_N,'00.000');
               
         }


        $spreadsheet->createSheet();

       /**
        * end of second Report
        * start of third Report
        */

       $spreadsheet->setActiveSheetIndex(2)->mergeCells('A1:Q1')
        ->setCellValue('A1', 'MUGHAL MAHAL  Yearly Sales Report -Credit Card FY-2022')->getStyle("A1:N1")->getFont()->setSize(16)->setBold(true);
        
        $spreadsheet->getActiveSheet()
                     ->getStyle('A36:W36')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
         $spreadsheet->getActiveSheet()
                     ->getStyle('A37:W37')
                     ->getBorders()
                     ->getBottom()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         for($i=4;$i<=37;$i++)
         {
            $oclbd="A".$i.":W".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($oclbd)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
         }

         $spreadsheet->getActiveSheet()
                     ->getStyle('A38:F38')
                     ->getBorders()
                     ->getBottom()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                     ->getStyle('F38')
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

        for ($i=38; $i <=42 ; $i++) { 
            $bord_N="N".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_N)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

            $bord_G="G".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_G)
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
        }
        
        for ($i=43; $i <=44; $i++) { 
            $bord_HN="H".$i.":N".$i;
            $spreadsheet->getActiveSheet()
                     ->getStyle($bord_HN)
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
        }
           
        $spreadsheet->getActiveSheet()
                     ->getStyle('A2:W2')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                     ->getStyle('W1:W3')
                     ->getBorders()
                     ->getRight()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
                     ->getStyle('A45:N45')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
                     ->getStyle('A1:W60')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
        
        $spreadsheet->getActiveSheet()
                     ->getStyle('Q38:W38')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
                     ->setColor(new Color('000000'));
         
         $spreadsheet->getActiveSheet()
                     ->getStyle('Q39:U42')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                     ->setColor(new Color('000000'));
         
         $spreadsheet->getActiveSheet()
                     ->getStyle('Q40:U40')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                     ->setColor(new Color('000000'));

          $spreadsheet->getActiveSheet()
                     ->getStyle('U41')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                     ->setColor(new Color('000000'));
      
       $spreadsheet->getActiveSheet()
                     ->getStyle('Q42:U42')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                     ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
                     ->getStyle('Q44:U44')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                     ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
                     ->getStyle('Q44:U44')
                     ->getBorders()
                     ->getTop()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                     ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
                     ->getStyle('V40:V42')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                     ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
                     ->getStyle('V41')
                     ->getBorders()
                     ->getOutline()
                     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                     ->setColor(new Color('000000'));

         $spreadsheet->getActiveSheet()
                    ->getStyle('A36:W37')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
         $spreadsheet->getActiveSheet()
                    ->getStyle('A2:W3')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       

         $spreadsheet->getActiveSheet()
                    ->getRowDimension('2')
                    ->setRowHeight(20, 'pt'); 

         $spreadsheet->getActiveSheet()
                    ->getRowDimension('36')
                    ->setRowHeight(20, 'pt');

         $spreadsheet->getActiveSheet()
                    ->getRowDimension('39')
                    ->setRowHeight(20, 'pt');             

         $spreadsheet->getActiveSheet()
                    ->getRowDimension('1')
                    ->setRowHeight(30, 'pt');
         $spreadsheet->getActiveSheet()
                    ->getRowDimension('3')
                    ->setRowHeight(25, 'pt');
         $spreadsheet->getActiveSheet()
                    ->getRowDimension('38')
                    ->setRowHeight(25, 'pt');

         $spreadsheet->getActiveSheet()
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

         $spreadsheet->setActiveSheetIndex(2)->mergeCells('R1:W1')
                    ->setCellValue('R1', 'Branch:')
                    ->getStyle("R1:W1")
                    ->getFont()
                    ->setSize(16)->setBold(true);
 
         $spreadsheet->getActiveSheet()
                    ->getStyle('R1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $spreadsheet->getActiveSheet()
                    ->getStyle('A2:U2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
        $spreadsheet->getActiveSheet()
                    ->getStyle('B2:T2')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
                   
        $spreadsheet->getActiveSheet()
                    ->getStyle('C2:W2')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
        
         $spreadsheet->getActiveSheet()
                    ->getStyle('A36:W36')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        $spreadsheet->getActiveSheet()
                    ->getStyle('A37:W37')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
         
        $spreadsheet->getActiveSheet()
                    ->getStyle('U4:U34')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);

         $spreadsheet->getActiveSheet()
                    ->getStyle('Q41:U42')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
    
     $spreadsheet->getActiveSheet()
                    ->getStyle('V42')
                    ->getFont()
                    ->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
    


        foreach(range('D','W') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

       $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);

        $daily =  $spreadsheet->getActiveSheet()->setTitle('Branch Daily ');
        
        $daily->mergeCells('A2:B2')->setCellValue('A2','A');
        $daily->mergeCells('C2:E2')->setCellValue('C2','CC AMEX 3.25%');
        $daily->mergeCells('F2:H2')->setCellValue('F2','CC VISA 2.25%');
        $daily->mergeCells('I2:K2')->setCellValue('I2','CC MSTER 2.25%');
        $daily->mergeCells('L2:N2')->setCellValue('L2','CC DINERS 3.5%');
        $daily->mergeCells('O2:Q2')->setCellValue('O2','PAYMENT GTY 1%');
        $daily->mergeCells('R2:T2')->setCellValue('R2','DR KNET 0.250%');
        $daily->mergeCells('U2:W2')->setCellValue('U2','MONTH TOTAL');
       
       /**
        * Creating a third row in a first tab
        */
      

        $daily->setCellValue('A3', 'S.NO');
        $daily->setCellValue('B3', 'DATE');
        $daily->setCellValue('C3', 'Inv Day TTL');
        $daily->setCellValue('D3', 'comm');
        $daily->setCellValue('E3', 'After Com TTL');
        $daily->setCellValue('F3', 'Inv Day TTL');
        $daily->setCellValue('G3', 'comm');
        $daily->setCellValue('H3', 'After Com TTL');
        $daily->setCellValue('I3', 'Inv Day TTL');
        $daily->setCellValue('J3', 'comm');
        $daily->setCellValue('K3', 'After Com TTL');
        $daily->setCellValue('L3', 'Inv Day TTL');
        $daily->setCellValue('M3', 'comm');
        $daily->setCellValue('N3', 'After Com TTL');
        $daily->setCellValue('O3', 'Inv Day TTL');
        $daily->setCellValue('P3', 'comm');
        $daily->setCellValue('Q3', 'After Com TTL');
        $daily->setCellValue('R3', 'Inv Day TTL');
        $daily->setCellValue('S3', 'comm');
        $daily->setCellValue('T3', 'After Com TTL');
        $daily->setCellValue('U3', 'Inv Day TTL');
        $daily->setCellValue('V3', 'COMM');
        $daily->setCellValue('W3', 'After Com TTL');
        
         $aDates = array();
            $oStart = new DateTime('2022-01-01');
            $oEnd = clone $oStart;
            $oEnd->add(new DateInterval("P1M"));

            while ($oStart->getTimestamp() < $oEnd->getTimestamp()) {
                $aDates[] = $oStart->format('d-M-Y');
                $oStart->add(new DateInterval("P1D"));
            }


        for ($i=1; $i <=31 ; $i++) {
              $col="A".($i+3);
              $col2="B".($i+3);
              $col_u="U".($i+3);
              $col_v="V".($i+3);
              $col_d="D".($i+3);
              $col_e="E".($i+3);
              $col_g="G".($i+3);
              $col_h="H".($i+3);
              $col_j="J".($i+3);
              $col_k="K".($i+3);
              $col_l="L".($i+3);
              $col_m="M".($i+3);
              $col_n="N".($i+3);
              $col_p="P".($i+3);
              $col_q="Q".($i+3);
              $col_s="S".($i+3);
              $col_t="T".($i+3);

              $col_u="U".($i+3);
              $col_v="V".($i+3);
              $col_w="W".($i+3);
             
           


            $spreadsheet->getActiveSheet()
                    ->getStyle($col_d)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_d,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_e)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_e,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_g)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_g,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_h)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_h,'00.000');

              $spreadsheet->getActiveSheet()
                    ->getStyle($col_j)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_j,'00.000');
          
           $spreadsheet->getActiveSheet()
                    ->getStyle($col_k)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_k,'00.000');
           
           $spreadsheet->getActiveSheet()
                    ->getStyle($col_l)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_l,'00.000');
            
            $spreadsheet->getActiveSheet()
                    ->getStyle($col_m)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_m,'00.000');

             $spreadsheet->getActiveSheet()
                    ->getStyle($col_n)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_n,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $daily->setCellValue($col,$i);

             $spreadsheet->getActiveSheet()
                    ->getStyle($col2)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $daily->setCellValue($col2,$aDates[$i-1]);
          
            $spreadsheet->getActiveSheet()
                    ->getStyle($col_u)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_u,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_v)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_v,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_w)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_w,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_p)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_p,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_q)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_q,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_s)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_s,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_t)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_t,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_u)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_u,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_v)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_v,'00.000');

            $spreadsheet->getActiveSheet()
                    ->getStyle($col_w)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $daily->setCellValue($col_w,'00.000');

            
            

        }

       
        $daily->mergeCells('A36:B36')->setCellValue('A36','TTL Bef Vs Aft');
        $daily->mergeCells('A37:B37')->setCellValue('A37','Comm TTL');

         $daily->setCellValue('W3', 'After Com TTL');
         $daily->setCellValue('V37', '00.000');
         $daily->setCellValue('T37', '00.000');
         $daily->setCellValue('Q37', '00.000');
         $daily->setCellValue('N37', '00.000');
          $daily->setCellValue('K37', '00.000');
         $daily->setCellValue('H37', '00.000');
         $daily->setCellValue('E37', '00.000');
         
        
          foreach(range('C','W') as $columnID) {
             $col=$columnID."36";
              $spreadsheet->getActiveSheet()
                    ->getStyle($col)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $daily->setCellValue($col,'00.000');
            } 

         $daily->setCellValue("A38","Details of  Cr & Dr Card "); 
         $daily->setCellValue("A39","A) TOTAL CREDIT CARD SALES - AMEX "); 
         $daily->setCellValue("A40","B) TOTAL CREDIT CARD SALES - VISA"); 
         $daily->setCellValue("A41","C) TOTAL CREDIT CARD SALES - MASTER");   
         $daily->setCellValue("A42","D) TOTAL CREDIT CARD SALES - KNET"); 
         $daily->setCellValue("A43","E) TOTAL CREDIT CARD SALES - DINERS"); 
         $daily->setCellValue("A44","F) TOTAL CREDIT CARD SALES - OTHERS"); 


        
         $spreadsheet->getActiveSheet()
                    ->getStyle("H38")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $daily->mergeCells('H38:I38')->setCellValue('H38','Total');

         $spreadsheet->getActiveSheet()
                    ->getStyle("K38")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $daily->mergeCells('K38:L38')->setCellValue('K38','Aft Comm');

         $spreadsheet->getActiveSheet()
                    ->getStyle("N38")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
         $daily->setCellValue('N38','Comm');

       
         for ($i=39; $i<=45 ; $i++) { 
             $col_h="H".$i;
             $m_col_h="H".$i.":I".$i;
             
             $col_k="K".$i;
             $m_col_k="K".$i.":L".$i;

             $col_N="N".$i;
           

              $spreadsheet->getActiveSheet()
                    ->getStyle($col_h)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $daily->mergeCells($m_col_h)->setCellValue($col_h,'00.000');

               $spreadsheet->getActiveSheet()
                    ->getStyle($col_k)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $daily->mergeCells($m_col_k)->setCellValue($col_k,'00.000');

               $spreadsheet->getActiveSheet()
                    ->getStyle($col_N)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               $daily->setCellValue($col_N,'00.000');
               
         }

          $spreadsheet->getActiveSheet()
                    ->getStyle('B49')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

          $daily->setCellValue("B49","Notes: "); 
          
          $spreadsheet->getActiveSheet()
                    ->getStyle('B50')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
         $spreadsheet->getActiveSheet()
                    ->getStyle('B51')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
         $spreadsheet->getActiveSheet()
                    ->getStyle('B52')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        
        $spreadsheet->getActiveSheet()
                    ->getStyle('Q39')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $spreadsheet->getActiveSheet()
                            ->getStyle('Q40')
                            ->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $spreadsheet->getActiveSheet()
                            ->getStyle('Q41')
                            ->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
         $spreadsheet->getActiveSheet()
                            ->getStyle('Q42')
                            ->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
 
          $daily->setCellValue("B50","1"); 
          $daily->setCellValue("B51","2"); 
          $daily->setCellValue("B52","3"); 
          $daily->setCellValue("C50","Amex,Visa,Master,Dinner (Credit) Comminssion 1.85%/Per 1KWD"); 
          $daily->setCellValue("C51","K-net (Debit) Commission .015%/Per 1KWD"); 
          $daily->setCellValue("C52","MM Pay Commssion KWD 0.150/per Transaction "); 
          
          
          $daily->mergeCells('Q38:W38')->setCellValue('Q38','SALES A/C GBK# 5194393  DEPOSIT/TO TRANSFER ');
          $daily->mergeCells('Q39:U39')->setCellValue('Q39','TO DEPOSIT  BY (VISA/KNET/MASTER/OTHERS) CHQ#');
          $daily->mergeCells('Q40:U40')->setCellValue('Q40','DIRECT TR FROM AMEX');
          $daily->mergeCells('Q41:T41')->setCellValue('Q41','BANK MACHINE RENT OF GBK');
          $daily->setCellValue('U41','00.000');
         // $daily->mergeCells('Q42:U42');
          $daily->mergeCells('Q42:U43')->setCellValue('Q42','ACTUAL TRASFER IN SALE A/C AFTER RENT+COMM.');

         for ($i=39; $i <=42 ; $i++) { 
             $col="V".$i;
             $merge_col="V".$i.":W".$i;
              $spreadsheet->getActiveSheet()
                            ->getStyle($col)
                            ->getAlignment()
                            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
             $daily->mergeCells($merge_col)->setCellValue($col,'00.000');
         }
     


        $spreadsheet->createSheet();


        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);


        $fileName = 'Credit_Card_Reporting.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
  

 }
}