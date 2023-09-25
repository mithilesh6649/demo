<?php
namespace App\Http\Reports\salesreport;

use App\Models\Branch;
use App\Models\DailySaleReport;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class NetSalesMonthlydownload
{

    public $filter_year;

    public function __construct($year)
    {

        $this->filter_year = date('Y', strtotime($year));

    }

    public function result()
    {

        $spreadsheet = new Spreadsheet();

        $year = $this->filter_year;

        //five tab bank deposit
        $monthnetsales = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
            , DB::raw('SUM(net_sale) as netsales'))
            ->whereYear('report_date', $year)
            ->groupBy('month', 'branch_id')
            ->get();

        $monthnetsale_check = array();

        foreach ($monthnetsales as $key => $data) {
            // return $data['month'];
            if (!in_array($data['month'], $monthnetsale_check)) {
                // $month[] = $data['month'];
                $monthnetsale_check[$data['month']][$data['branch_id']] = $data;

            }
        }

        $allmonth = array();

        for ($i = 1; $i <= 12; $i++) {
            // if (in_array($i, $sel_month)) {
            $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
            // }
        }

        $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

        $total_branches = count($branch);

        $alphabet = 'A';

        for ($i = 0; $i <= count($branch); $i++) {
            $alphabet++;
        }

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:' . $alphabet . '1')
            ->setCellValue('A1', "ALL BRANCH MONTHLY NET SALE-" . $this->filter_year)
            ->getStyle("A1:" . $alphabet . "1")
            ->getFont()
            ->setSize(12);
        //->setItalic(true);

        $styleArray_heading = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Calibri',
                'size' => 12,
            ));

        $spreadsheet->getActiveSheet()->getStyle('A2:' . $alphabet . '2')->applyFromArray($styleArray_heading);

        $rowname = array();
        foreach (range('A', $alphabet) as $rowna) {
            $rowname[] = $rowna;
        }
        foreach (range('A', $alphabet) as $rowna) {
            $rowname[] = 'A' . $rowna;
        }

        $rows = array(
            '',
        );

        foreach ($branch as $key => $brn) {
            array_push($rows, $brn);
        }

        foreach ($spreadsheet->getActiveSheet()->getColumnIterator() as $column) {
            $spreadsheet->getActiveSheet()->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        array_push($rows, "Total");

        $rowArray = array_merge($rows);

        //->setItalic(true);

        // $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue($rowname[count($rowArray)-1].'1', "Month & Year")
        //     ->getStyle($rowname[count($rowArray)-1]."1")
        //     ->getFont()
        //     ->setSize(8)
        //     ->setItalic(true);

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
            ->getStyle('A1:' . $alphabet . '1')
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
                    ->getStyle($colmn . ($i + 2))->getBorders()
                    ->getOutline()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
        }

        $i = 0;
        foreach (range('A', $rowname[count($rowArray) - 1]) as $columnID) {
            $col = $columnID . "2";

            $spreadsheet->getActiveSheet()
                ->getStyle($col)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $BANKDEP->setCellValue($col, $rowArray[$i]);
            $i++;
        }

        //fill data in all branch wise cash deposit
        $counter = 3;

        foreach ($allmonth as $key => $month) {
            $start_branch_alphabet = "B";

            $sum_starting = "B";

            $total_sum = 0;

            $spreadsheet->getActiveSheet()->setCellValue("A" . $counter, ($key > 9 ? $key : '0' . $key) . '/' . $year);

            foreach ($branch as $bkey => $branch_name) {
                if (isset($monthnetsale_check[$key])) {
                    if (in_array($bkey, array_keys($monthnetsale_check[$key]))) {

                        $total_sum = $total_sum + $monthnetsale_check[$key][$bkey]['netsales'];

                        $netsales = $monthnetsale_check[$key][$bkey]['netsales'] == 0 ? '-' : number_format((float) $monthnetsale_check[$key][$bkey]['netsales'], 3, '.', '');

                        $spreadsheet->getActiveSheet()->setCellValue($start_branch_alphabet . $counter, $netsales);
                    } else {
                        $spreadsheet->getActiveSheet()->setCellValue($start_branch_alphabet . $counter, '-');
                    }
                } else {
                    $spreadsheet->getActiveSheet()->setCellValue($start_branch_alphabet . $counter, '-');
                }
                $last_alphabet = $start_branch_alphabet;
                $start_branch_alphabet++;
            }

            // $spreadsheet->getActiveSheet()->setCellValue($start_branch_alphabet . $counter, $total_sum == 0 ? '-' : number_format((float) $total_sum, 3, '.', ''));
            $spreadsheet->getActiveSheet()->setCellValue($start_branch_alphabet . $counter, "=SUM(" . $sum_starting . $counter . ":" . $last_alphabet . $counter . ")");
            $counter++;

        }

        $spreadsheet->getActiveSheet()->setCellValue("A16", "TOTAL");

        $start_alphabet = "B";

        $sub_total = array();
        foreach ($branch as $bkey => $branch_name) {
            $spreadsheet->getActiveSheet()->setCellValue($start_alphabet . (count($allmonth) + 4), "=SUM(" . $start_alphabet . "3:" . $start_alphabet . (count($allmonth) + 2) . ")");
            // $sub_total[] ="=SUM(".$start_alphabet."3:".$start_alphabet.(count($allmonth)+2).")";
            $start_alphabet++;
        }

        $spreadsheet->getActiveSheet()->setCellValue($start_alphabet . (count($allmonth) + 4), "=SUM(" . $start_alphabet . "3:" . $start_alphabet . (count($allmonth) + 2) . ")");

        $format = '0.000';
        $spreadsheet->getActiveSheet()
            ->getStyle('B3:' . $start_alphabet . (count($allmonth) + 4))->getNumberFormat()
            ->setFormatCode($format);

        // $BANKDEP->setCellValue('A36', "NO.DAYS SALE");

       $all_center = "13"; 

 
  for ($i = 3; $i <= $all_center; $i++) {
       $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AG3'.$i)->getAlignment()->setWrapText(true);  
      $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AG3'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AG3'.$i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
   
  }

    $styleArray_headingss = array(
            'font' => array(
                'bold' => true,
                //'color' => array('rgb' => '000000'),
                //'name' => 'Calibri',
               // 'size' => 8,
            ));

         $spreadsheet->getActiveSheet()->getStyle('A16:' . $alphabet . '16')->applyFromArray($styleArray_headingss);
         

        $spreadsheet->createSheet();

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = 'Monthly-Net-Sale' . $timestamp . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

}
