<?php
namespace App\Http\Reports\salesreport;

 
use App\Models\Branch;
use App\Models\DailyPettyExpense;
use App\Models\DailyPettyExpenseCategory;
use App\Models\DailyPettyExpenseSubCategory;
use App\Models\Cars;
use App\Models\BranchCar;
use App\Models\Driver;
use App\Models\BranchDriver;
use App\Models\PetrolPumps; 
use App\Models\PurchasedGiftCard;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CarFuleReport
{

    public $start; 
    public $end; 
    public $branch_id;
    public $car_id;

    public function __construct($branch_id,$car_id, $date)
    {

        $this->start = date('Y-m-d', strtotime(str_replace('/', '-', $date[0])));

        $this->end = date('Y-m-d', strtotime(str_replace('/', '-', $date[1])));

        $this->branch_id = $branch_id;
        $this->car_id = $car_id;
    }

    public function result()
    {



        $spreadsheet = new Spreadsheet();

        //five tab bank deposit

      

              $daily_car_fule_report = DailyPettyExpense::with('car','driver')->where(['category_id'=>"3",'sub_category_id'=>'11'])->where("branch_id", $this->branch_id)->where("car_id", $this->car_id)
            ->where('report_date', '>=', $this->start)
            ->where('report_date', '<=', $this->end)->orderBy('petrol_slip_date','ASC')->orderBy('fuel_time','ASC')->get();   
 

            
           
           
        /**
         * start five Report BANK DEP
         */

       

        $branch_name = Cars::select('model','no_plate')->where(['status' => '1', 'id' => $this->car_id])->first();
 
        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:F1')
            ->setCellValue('A1', "CAR WISE FULE REPORT")
            ->getStyle("A1:F1")
            ->getFont()
            ->setSize(20);

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('G1:H1')
            ->setCellValue('G1', "CAR: " . strtoupper(@$branch_name->model)." || ".@$branch_name->no_plate )
            ->getStyle("G1:H1")
            ->getFont()
            ->setSize(14);

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('I1')
            ->setCellValue('I1', "PERIOD  ".$this->start." : ".$this->end)
            ->getStyle("I1")
            ->getFont()
            ->setSize(10);
        //->setItalic(true);

        $styleArray_heading = array(
            'font' => array(
                'bold'  => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Calibri',
                'size' => 12,
            ));

        $spreadsheet->getActiveSheet()->getStyle('A3:I3')->applyFromArray($styleArray_heading);

        $rowname = array();
        foreach (range('A', 'I') as $rowna) {
            $rowname[] = $rowna;
        }
        foreach (range('A', 'I') as $rowna) {
            $rowname[] = 'A' . $rowna;
        }

        $rows = array(
            'S.No',
            'Date',
            
            'Branch name',
            'Vehicle No',
            'Driver Name',
            
            'Fule Quantity',
            'KM',
            'Avg',
            'Amount',
        );

        $rowArray = array_merge($rows);
 

        $spreadsheet->getActiveSheet()
            ->getRowDimension('9')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('16')
            ->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension('1')
            ->setRowHeight(30, 'pt');

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:I1')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray)] . '2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray)] . '2')
            ->getFont()
            ->setSize(10)
            ->setItalic(false);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:' . $rowname[count($rowArray) - 1] . '1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('fcda51');

        $styleArray = array(
            'font' => array(
                'italic' => false,
                'color' => array(
                    'rgb' => '000000',
                ),
                'size' => 11,
                'name' => 'Simsun',
            ),
        );

        $spreadsheet->getDefaultStyle()
            ->applyFromArray($styleArray);

        //dd($rowArray);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray) - 1] . '2')
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

      

        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray)] . '2')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray)] . '2')
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray)] . '2')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray)] . '2')
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray)] . '2')
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

        $spreadsheet->getActiveSheet()
            ->getStyle('C2')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new Color('000000'));

        //apply all column border
        foreach (range('A', $rowname[count($rowArray) - 1]) as $colmn) {

            for ($i = 1; $i <= 34; $i++) {
                $spreadsheet->getActiveSheet()
                    ->getStyle($colmn . ($i + 3))->getBorders()
                    ->getOutline()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
        }

        $i = 0;
        foreach (range('A', $rowname[count($rowArray) - 1]) as $columnID) {
            $col = $columnID . "3";

            $spreadsheet->getActiveSheet()
                ->getStyle($col)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));

            $spreadsheet->getActiveSheet()
                ->getColumnDimension($columnID)->setWidth(30);
            $BANKDEP->setCellValue($col, $rowArray[$i]);
            $i++;
        }

        //fill data in all branch wise cash deposit
        $counter = 4;
        $s_no = 1;

        foreach ($daily_car_fule_report as $data) {

           
            $spreadsheet->getActiveSheet()->setCellValue("A" . $counter, $s_no);

            

            $spreadsheet->getActiveSheet()->setCellValue("B" . $counter, @date('d/m/Y', strtotime($data->report_date)));

            $spreadsheet->getActiveSheet()->setCellValue("C" . $counter, @$data->branch->short_name ?? '');
            $spreadsheet->getActiveSheet()->setCellValue("D" . $counter, @$data->car->no_plate ?? 'N/A');
            $spreadsheet->getActiveSheet()->setCellValue("E" . $counter, @$data->driver->drivers_name ?? 'N/A');
            $spreadsheet->getActiveSheet()->setCellValue("F" . $counter, @$data->fuel ?? 'N/A' );
            $spreadsheet->getActiveSheet()->setCellValue("G" . $counter, @$data->driven_km ?? 'N/A');
            $spreadsheet->getActiveSheet()->setCellValue("H" . $counter, ' ');
            $spreadsheet->getActiveSheet()->setCellValue("I" . $counter, number_format($data->amount, 3, '.', ''));

            $counter++;
            $s_no++;
        }
           
            $lastcolval = array(
            '=(G4-G3)/F4',
            '=(G5-G4)/F5',
            '=(G5-G4)/F5',
            '=(G5-G4)/F5',
        );
        
         $daynmic_formula = array();

         $starting_point = 0;
         $oneminus = 0;
        for ($i = 0;$i <count($daily_car_fule_report);$i++)
        { 
           $starting_point = $i+5;             
           $oneminus = $starting_point-1;
          array_push($daynmic_formula,'=(G'.$starting_point.'-G'.$oneminus.')/F'.$oneminus);
        }


    //  dump($daynmic_formula);
        for ($i = 0;$i <count($daily_car_fule_report)-1;$i++)
        { 

           //dump('H' . ($i + 5));
           $spreadsheet->getActiveSheet()->setCellValue('H' . ($i + 5) , $daynmic_formula[$i] );
        }
        
 // dd(count($daily_car_fule_report));


        // $BANKDEP->setCellValue('A36', "NO.DAYS SALE");

        $spreadsheet->createSheet(); 

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = 'Car-Wise-Fule-Report' . $timestamp . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

}
