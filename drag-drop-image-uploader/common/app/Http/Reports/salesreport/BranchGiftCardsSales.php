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

class BranchGiftCardsSales
{

    public $start;
    public $end;

    public function __construct($start, $end)
    {

        $this->start = date('Y-m-d', strtotime(str_replace('/', '-', $start)));

        $this->end = date('Y-m-d', strtotime(str_replace('/', '-', $end)));

    }

    public function result()
    {
       
        $spreadsheet = new Spreadsheet();

        $first_second = $this->start;
        $last_second = $this->end;

        $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
            , DB::raw('SUM(net_sale) as net_sale') , DB::raw('printed_gift_card as printed_gift_card')  , DB::raw('e_gift_card as e_gift_card'))
            ->where('report_date', '>=', $this->start)
            ->where('report_date', '<=', $this->end)
            ->orderBy('date', 'ASC')
            ->groupBy('date','printed_gift_card','e_gift_card','branch_id')
            ->get();
           

            //   $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
            // , DB::raw('SUM(net_sale) as net_sale') , DB::raw('printed_gift_card as printed_gift_card')  , DB::raw('e_gift_card as e_gift_card'))
            // ->where('report_date', '>=', $report_date_1)
            // ->where('report_date', '<=', $report_date_2)
            // ->orderBy('date', 'ASC')
            // ->groupBy('date','printed_gift_card','e_gift_card', 'branch_id')
            // ->get();



        $salesbranch = array();
        foreach ($data as $value_bank) {
            $salesbranch[date('d-M-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
        }

        $salesbranch_key = array_keys($salesbranch);

        $aDates = array();
        $start = strtotime($first_second);
        $end = strtotime($last_second);
        $day = array();

        $date = strtotime("-1 day", $start);
        $end = strtotime("-1 day", $end);
        while ($date < $end) {
            $date = strtotime("+1 day", $date);
            $aDates[] = date('d-M-Y', $date);
            $day[] = date('D', $date);
        }

        if (count($salesbranch_key) > 0) {
            $aDates = array();
            $start = strtotime($first_second);
            $end = strtotime($last_second);
            $day = array();
            foreach ($salesbranch_key as $edate) {
                $aDates[] = date('d-M-Y', strtotime($edate));
                $day[] = date('D', strtotime($edate));
            }
        }

        // (Imp) For Showing Only Existing Data in Database //

        // dd($salesbranch);

        // $aDates = array_intersect_key($aDates, array_keys($salesbranch));

        // ------------- //

        $branch = Branch::where('status', '1')->get()
            ->pluck('title_en', 'id');

        /**
         * start six tab Daily Sales Branch Wise
         */

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:J1')
            ->setCellValue('A1', "MUGHAL MAHAL-BRANCH WISE GIFT CARDS  REPORT")
            ->getStyle("A1:J1")
            ->getFont()
            ->setSize(12);
        //->setItalic(true);
        $rowname = array();
        foreach (range('A', 'Z') as $rowna) {
            $rowname[] = $rowna;
        }
        foreach (range('A', 'Z') as $rowna) {
            $rowname[] = 'A' . $rowna;
        }

        $firstar = array(
            'Date',
            'Day ',
        );

        $thirdaar = array(
            'TOTAL',
        );

        $branch_namepe = Branch::select('short_name')->where('status', '1')
            ->get()
            ->pluck('short_name')
            ->toArray();

        $rowArray = array_merge($firstar, $branch_namepe, $thirdaar);

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('k1:' . $rowname[count($rowArray) - 2] . '1')->setCellValue('K1', date('d-m-Y', strtotime($first_second)) . " To " . date('d-m-Y', strtotime($last_second)))->getStyle("K1:M1")
            ->getFont()
            ->setSize(12);
        //->setItalic(true);
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
            ->getStyle('A1:' . $rowname[count($rowArray) - 1] . '1')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray) - 1] . '2')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray) - 1] . '2')->getFont()
            ->setSize(10);
        //->setItalic(false);
        $spreadsheet->getActiveSheet()
            ->getStyle('A1:' . $rowname[count($rowArray) - 1] . '2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('fcda51');

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'italic' => false,
                'color' => array(
                    'rgb' => '000000',
                ),
                'size' => 8,
                'name' => 'Simsun',
            ),

        );

        $spreadsheet->getDefaultStyle()
            ->applyFromArray($styleArray);

        // Styling Heading //

        $styleArray_heading = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Calibri',
            ));

        $spreadsheet->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($styleArray_heading);
        $spreadsheet->getActiveSheet()->getStyle('A2:Q2')->applyFromArray($styleArray_heading);

        // --------------- //

        $DailySales = $spreadsheet->getActiveSheet()
            ->setTitle('DAILY SALES BY BRANCH');

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray) - 1] . '2')->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray) - 1] . '2')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray) - 1] . '2')->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray) - 1] . '2')->getAlignment()
            ->setWrapText(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:' . $rowname[count($rowArray) - 1] . '2')->getFont()
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
        foreach (range('A', $rowname[count($rowArray) - 1]) as $colmn) {

            for ($i = 1; $i <= (count($aDates) + 1); $i++) {
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

            $spreadsheet->getActiveSheet()
                ->getColumnDimension($columnID)->setWidth(17);
            $DailySales->setCellValue($col, $rowArray[$i]);
            $i++;
        }

        $col_total = array();
        $m = 3;

        for ($i = 1; $i <= count($aDates); $i++) {

            $col_total[] = '=SUM(C' . $m . ':' . $rowname[count($rowArray) - 2] . $m . ')';
            $m++;
        }

        for ($i = 1; $i <= count($aDates); $i++) {

            $col_A_data = "A" . ($i + 2);
            $col_B_data = "B" . ($i + 2);
            $cols_total = $rowname[count($rowArray) - 1] . ($i + 2);

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

       // $DailySales->setCellValue('A' . (count($aDates) + 6), "NO.DAYS SALE");

       // $DailySales->setCellValue('A' . (count($aDates) + 8), "CASH ACT-TTL");

        $spreadsheet->getActiveSheet()
            ->getStyle('B' . (count($aDates) + 6) . ':' . $rowname[count($rowArray) - 2] . (count($aDates) + 8))->getAlignment()
            ->setWrapText(true);

        $spreadsheet->getActiveSheet()
            ->getStyle('B' . (count($aDates) + 6) . ':' . $rowname[count($rowArray) - 2] . (count($aDates) + 8))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('B1' . ':' . $rowname[count($rowArray) - 2] . (count($aDates) + 3))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()
            ->getStyle('B' . (count($aDates) + 6) . ':' . $rowname[count($rowArray) - 2] . (count($aDates) + 8))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $branch_na = Branch::select('title_en', 'id')->where('status', '1')
            ->get()
            ->pluck('short_name', 'id');
        //fill data in all branch wise Grass sales
        for ($i = 1; $i <= count($aDates); $i++) {
            if (in_array($aDates[$i - 1], array_keys($salesbranch))) {

                $j = 0;
                foreach ($branch_na as $key => $val) {
                    if (in_array($key, array_keys($salesbranch[$aDates[$i - 1]]))) {

                        $DailySales->setCellValue($rowname[$j + 2] . ($i + 2), $salesbranch[$aDates[$i - 1]][$key]['demo'] == '' ? ' -':$salesbranch[$aDates[$i - 1]][$key]['demo']);
                    } else {
                        $DailySales->setCellValue($rowname[$j + 2] . ($i + 2), '-');
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
            'Total',
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

        $COL12 = array();
        $COL22 = array();
        $COL32 = array();
        $COL42 = array();
        $COL52 = array();
        $COL62 = array();
        $actualtotalsale2 = array();

        foreach (range('C', $rowname[count($rowArray) - 1]) as $rowval) {

            $COL12[] = '=COUNT(' . $rowval . '3:' . $rowval . (count($aDates) + 3) . ')';
            $COL22[] = '=SUM(' . $rowval . '3:' . $rowval . (count($aDates) + 3) . ')';
            $COL32[] = '=MAX(' . $rowval . '3:' . $rowval . (count($aDates) + 3) . ')';
            $COL42[] = '=MIN(' . $rowval . '3:' . $rowval . (count($aDates) + 3) . ')';
            $COL52[] = '=' . $rowval . (count($aDates) + 6) . '/' . $rowval . (count($aDates) + 5);
            $COL62[] = '=' . $rowval . (count($aDates) + 7) . '*' . count($aDates);
            $actualtotalsale2[] = '=' . $rowval . (count($aDates) + 6) . '/' . $rowname[count($rowArray) - 1] . (count($aDates) + 6);

        }

        $COL1 = array_merge($COL11, $COL12);
        $COL2 = array_merge($COL21, $COL22);
        $COL3 =  array_merge($COL51, $COL52);       //array_merge($COL31, $COL32);
        $COL4 = array_merge($COL61, $COL62); //array_merge($COL41, $COL42);
        $COL5 = array_merge($COL51, $COL52);
        $COL6 = array_merge($COL61, $COL62);
        $actualtotalsale = array_merge($actualtotalsale1, $actualtotalsale2);

        $i = 0;

        $spreadsheet->getActiveSheet()
            ->getRowDimension((count($aDates) + 5))->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension((count($aDates) + 7))->setRowHeight(20, 'pt');

        $spreadsheet->getActiveSheet()
            ->getRowDimension((count($aDates) + 8))->setRowHeight(20, 'pt');

        foreach (range('A', $rowname[count($rowArray) - 1]) as $columnID) {
            $key1 = $columnID . (count($aDates) + 5);
            $key2 = $columnID . (count($aDates) + 6);
            $key3 = $columnID . (count($aDates) + 7);
            $key4 = $columnID . (count($aDates) + 8);
            $key5 = $columnID . (count($aDates) + 9);
            $key6 = $columnID . (count($aDates) + 10);

            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key1)->getBorders()
            //     ->getOutline()
            //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            //     ->setColor(new Color('000000'));
            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key1)->getAlignment()
            //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // $DailySales->setCellValue($key1, $COL1[$i]);

            $spreadsheet->getActiveSheet()
                ->getStyle($key2)->getBorders()
                ->getOutline()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new Color('000000'));
            $spreadsheet->getActiveSheet()
                ->getStyle($key2)->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $DailySales->setCellValue($key2, $COL2[$i]);

            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key3)->getBorders()
            //     ->getOutline()
            //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            //     ->setColor(new Color('000000'));
            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key3)->getAlignment()
            //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // $DailySales->setCellValue($key3, $COL3[$i]);

            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key4)->getBorders()
            //     ->getOutline()
            //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            //     ->setColor(new Color('000000'));
            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key4)->getAlignment()
            //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // $DailySales->setCellValue($key4, $COL4[$i]);

            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key5)->getBorders()
            //     ->getOutline()
            //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            //     ->setColor(new Color('000000'));
            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key5)->getAlignment()
            //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // $DailySales->setCellValue($key5, $COL5[$i]);

            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key6)->getBorders()
            //     ->getOutline()
            //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            //     ->setColor(new Color('000000'));
            // $spreadsheet->getActiveSheet()
            //     ->getStyle($key6)->getAlignment()
            //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            // $DailySales->setCellValue($key6, $COL6[$i]);

             $i++;

        }


 //DOne..............
        // $DailySales->mergeCells('A' . (count($aDates) + 11) . ':B' . (count($aDates) + 11))->setCellValue('A' . (count($aDates) + 11), 'Actual Total Sale(%)');

     //  $i = 1;

        // foreach (range('C', $rowname[count($rowArray) - 1]) as $colmn) {
        //     $key7 = $colmn . (count($aDates) + 11);

        //     $spreadsheet->getActiveSheet()
        //         ->getStyle($key7)->getBorders()
        //         ->getOutline()
        //         ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        //         ->setColor(new Color('000000'));
        //     $spreadsheet->getActiveSheet()
        //         ->getStyle($key7)->getAlignment()
        //         ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //     $DailySales->setCellValue($key7, $actualtotalsale[$i]);
        //     $i++;

        // }

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A' . (count($aDates) + 11))->getBorders()
        //     ->getOutline()
        //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        //     ->setColor(new Color('000000'));

        // foreach (range('A', $rowname[count($rowArray) - 1]) as $colborder) {
        //     $colss = $colborder . (count($aDates) + 12);
        //     $colss43 = $colborder . (count($aDates) + 13);
        //     $colss44 = $colborder . (count($aDates) + 14);
        //     $spreadsheet->getActiveSheet()
        //         ->getStyle($colss)->getBorders()
        //         ->getRight()
        //         ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        //         ->setColor(new Color('FFFFFF'));

        //     $spreadsheet->getActiveSheet()
        //         ->getStyle($colss43)->getBorders()
        //         ->getOutline()
        //         ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        //         ->setColor(new Color('FFFFFF'));

        //     $spreadsheet->getActiveSheet()
        //         ->getStyle($colss44)->getBorders()
        //         ->getOutline()
        //         ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
        //         ->setColor(new Color('FFFFFF'));
        // }

        // $DailySales->setCellValue('A' . (count($aDates) + 12), 'Net Sale');
        // $DailySales->setCellValue($rowname[count($rowArray) - 1] . (count($aDates) + 12), '=SUM(C' . (count($aDates) + 12) . ':' . $rowname[count($rowArray) - 1] . (count($aDates) + 12) . ')');
        // $DailySales->setCellValue('A' . (count($aDates) + 13), 'Discount');
        // $DailySales->setCellValue($rowname[count($rowArray) - 1] . (count($aDates) + 13), '=SUM(C' . (count($aDates) + 13) . ':' . $rowname[count($rowArray) - 1] . (count($aDates) + 13) . ')');
        // $DailySales->setCellValue('A' . (count($aDates) + 14), 'Diff.');

        // foreach (range('C', $rowname[count($rowArray) - 1]) as $rowval) {

        //     $DailySales->setCellValue($rowval . (count($aDates) + 14), '=' . $rowval . (count($aDates) + 6) . '-' . $rowval . (count($aDates) + 12) . '-' . $rowval . (count($aDates) + 13));
         // }
     
     //Mk Border......
        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A1:' . $rowname[count($rowArray) - 1] . (count($aDates) + 14))->getBorders()
        //     ->getOutline()
        //     ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)
        //     ->setColor(new Color('0563b0'));

        //value format
        $format = '0.000';
        $spreadsheet->getActiveSheet()
            ->getStyle('A1:' . $rowname[count($rowArray) - 1] . (count($aDates) + 14))->getNumberFormat()
            ->setFormatCode($format);

        $spreadsheet->getActiveSheet()
            ->getStyle('C' . (count($aDates) + 6) . ':' . $rowname[count($rowArray) - 1] . (count($aDates) + 8))->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
            ->getStyle('A' . (count($aDates) + 6) . ':A' . (count($aDates) + 8))->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->getActiveSheet()
            ->getStyle('A' . (count($aDates) + 10))->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle($rowname[count($rowArray) - 1] . (count($aDates) + 6))->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle($rowname[count($rowArray) - 1] . (count($aDates) + 6))->getFill()
        //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        //     ->getStartColor()
        //     ->setARGB('f0ea3a');

        
        $spreadsheet->getActiveSheet()
            ->getStyle('A' . (count($aDates) + 7) . ':' . $rowname[count($rowArray) - 1] . (count($aDates) + 7))->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);

        $spreadsheet->getActiveSheet()
            ->getStyle('A' . (count($aDates) + 10) . ':' . $rowname[count($rowArray) - 1] . (count($aDates) + 10))->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle($rowname[count($rowArray) - 1] . (count($aDates) + 12))->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        // $spreadsheet->getActiveSheet()
        //     ->getStyle($rowname[count($rowArray) - 1] . (count($aDates) + 13))->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet->createSheet();

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = 'Branch-Wise-Gift-Card' . $timestamp . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

}
