<?php

namespace App\Http\Reports;

use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \App\Models\Branch;
use \App\Models\DailyPettyExpense;
use \App\Models\DailyPettyExpenseCategory;
use \App\Models\DailyPettyExpenseBalance;

class GenerateBranchPettyCashReport
{
    public $branch_id;
    public $date_range;

    public function __construct($branch_id, $date_range)
    {
        $this->branch_id = $branch_id;
        $this->date_range = base64_decode($date_range);
    }

    public function result()
    {
        $spreadsheet = new Spreadsheet();

        // Styling Heading //

        $styleArray_heading = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Calibri',
            ));

        $spreadsheet->getActiveSheet()->getStyle('A1:AD1')->applyFromArray($styleArray_heading);
        $spreadsheet->getActiveSheet()->getStyle('A3:AD3')->applyFromArray($styleArray_heading);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A1:AD1')->getFill()
        //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        //     ->getStartColor()
        //     ->setARGB('fcda51');

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A3:AD2')->getFill()
        //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        //     ->getStartColor()
        //     ->setARGB('fcda51');

        // --------------- //

        $format = '0.000';
        $tab_count = 0;
        $branches = $this->branch_id == 0
        ? Branch::where('status', Branch::ACTIVE)->get()
        : Branch::where('status', Branch::ACTIVE)->where('id', $this->branch_id)->get();
        $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();
        $categories_name = [];

        foreach ($categories as $category) {
            foreach ($category->subcategories as $subcategory) {
                $categories_name[] = $subcategory->sub_cat_name;
            }
        }
        $categories_count = count($categories_name);

        $branch_counter = 1;
        foreach ($branches as $branch) {
            $spreadsheet->setActiveSheetIndex($tab_count)->setCellValue("A1", $branch->short_name);
            $tab_count++;

            $spreadsheet
                ->getDefaultStyle()
                ->getFont()
                ->setName("Arial")
                ->setSize(10);
            $spreadsheet
                ->getDefaultStyle()
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );

            foreach (range("1", "100") as $key => $letter) {
                $spreadsheet
                    ->getActiveSheet()
                    ->getRowDimension($letter)
                    ->setRowHeight(20);
            }
            $spreadsheet
                ->getActiveSheet()
                ->setCellValue(
                    "A1",
                    "MUGHAL MAHAL RESTAURANT " . $branch->short_name . " : CASH EXPENSES / "
                );

            $spreadsheet
                ->getActiveSheet()
                ->getRowDimension("1")
                ->setRowHeight(20);

            $columns_ = [];
            $alphabate_ = 'A';
            for ($i = 1; $i <= ($categories_count + 5); $i++) {
                $columns_[] = $alphabate_;
                $alphabate_++;
            }

            $spreadsheet->getActiveSheet()->mergeCells("A1:" . $columns_[count($columns_) - 1] . "1");

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A1")
                ->getFont()
                ->setSize(20);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A1")
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );
            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A1")
                ->getAlignment()
                ->setVertical(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                );

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A1")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("808080");

            $spreadsheet
                ->getActiveSheet()
                ->setCellValue(
                    "A2",
                    ""
                );

            $spreadsheet->getActiveSheet()->mergeCells("A2:" . $columns_[count($columns_) - 1] . "2");

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A2")
                ->getFont()
                ->setSize(12);

            $spreadsheet
                ->getActiveSheet()
                ->getRowDimension("4")
                ->setRowHeight(15);

            $spreadsheet
                ->getActiveSheet()
                ->getRowDimension("2")
                ->setRowHeight(20);

            $spreadsheet
                ->getActiveSheet()
                ->getRowDimension("3")
                ->setRowHeight(30);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A2")
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A2")
                ->getAlignment()
                ->setVertical(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                );

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A2")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("969696");

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A2")
                ->getBorders()
                ->getTop()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                );

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A2")
                ->getBorders()
                ->getBottom()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                );

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A2")
                ->getBorders()
                ->getLeft()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                );

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A2")
                ->getBorders()
                ->getRight()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                );

            $rowArray = [
                "Date",
                "Statement  \n Reg Code",
            ];

            $rowArray = array_merge($rowArray, $categories_name);

            $rowArray_2 = [
                "Day Total",
                "Chq Rcd",
                "Closing Bal",
            ];

            $rowArray = array_merge($rowArray, $rowArray_2);

            $spreadsheet->getActiveSheet()->fromArray(
                $rowArray,
                null,
                "A3"
            );

            // $spreadsheet->setActiveSheetIndex(0)
            //             ->mergeCells('A1:G1')
            //             ->setCellValue('A1', 'Period :')
            //             ->getStyle("A1:G1")
            //             ->getFont()
            //             ->setSize(12);
            
            // opening balance
           

            $number = 5;
            $s_no_ = [];
            $dates = [];
            $day_counter = 0;
            $day_total_position = 'C';

            $all_alpha_ = [];
            foreach ($categories as $category) {
                foreach ($category->subcategories as $subcategory) {
                    $all_alpha_[] = $day_total_position;
                    $day_total_position++;
                }
            }

            $second_to_day_total_position = $all_alpha_[count($all_alpha_) - 1];
            if ($this->date_range) {

                $date_range = explode(',', $this->date_range);
                $start_date = date('Y-m-d', strtotime(str_replace("/", "-", $date_range[0])));
                $end_date = date('Y-m-d', strtotime(str_replace("/", "-", $date_range[1])));

                $dates = array();
                if (is_string($start_date) === true) {
                    $start_date = strtotime($start_date);
                }

                if (is_string($end_date) === true) {
                    $end_date = strtotime($end_date);
                }

                if ($start_date > $end_date) {
                    return createDateRangeArray($end_date, $start_date);
                }

                do {
                    $dates[] = date('d-M-Y', $start_date);
                    $start_date = strtotime("+ 1 day", $start_date);
                } while ($start_date <= $end_date);

                for ($i = 0; $i < count($dates); $i++) {
                    $s_no_[] =($i+1);
                    $day_counter++;
                    $expense = [];
                    $current_date = date('Y-m-d', strtotime($dates[$i]));

                    foreach ($categories as $category) {
                        foreach ($category->subcategories as $subcategory) {
                            $expense[] = $this->getExpenseBranchWise($subcategory, $current_date, $branch->id) == 0 ? '-' : $this->getExpenseBranchWise($subcategory, $current_date, $branch->id);
                        }
                    }
                    $rowArrayData = $expense;

                    $spreadsheet->getActiveSheet($tab_count)->fromArray(
                        $rowArrayData,
                        null,
                        "C" . $number
                    );

                    $spreadsheet->getActiveSheet()->setCellValue($day_total_position . "" . $number, "=SUM(C" . $number . ":" . $second_to_day_total_position . "" . $number . ")");
                    $number++;
                }

            } else {

                for ($i = 1; $i <= date('t'); $i++) {
                    $s_no_[] = $i;
                    $day_counter++;
                    $dates[] = str_pad($i, 2, '0', STR_PAD_LEFT) . '-' . date('M') . "-" . date('Y');
                    $expense = [];
                    $current_date = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);

                    foreach ($categories as $category) {
                        foreach ($category->subcategories as $subcategory) {
                            $expense[] = $this->getExpenseBranchWise($subcategory, $current_date, $branch->id) == 0 ? '-' : $this->getExpenseBranchWise($subcategory, $current_date, $branch->id);
                        }
                    }
                    $rowArrayData = $expense;

                    $spreadsheet->getActiveSheet($tab_count)->fromArray(
                        $rowArrayData,
                        null,
                        "C" . $number
                    );

                    $spreadsheet->getActiveSheet()->setCellValue($day_total_position . "" . $number, "=SUM(C" . $number . ":" . $second_to_day_total_position . "" . $number . ")");
                    $number++;
                }
            }

            for ($i = 5; $i <= count($dates) + 5; $i++) {
                $spreadsheet
                    ->getActiveSheet()
                    ->getStyle("A" . $i)
                    ->getFont()
                    ->setSize(7); 
            }

            $rowArray = $dates;

            $columnArray = array_chunk($rowArray, 1);
            $spreadsheet->getActiveSheet()->fromArray(
                $columnArray,
                null,
                "A5"
            );
         

            $rowArray = $s_no_;
            
            $columnArray = array_chunk($rowArray, 1);
            $spreadsheet->getActiveSheet()->fromArray(
                $columnArray,
                null,
                "B5"
            );

            // format
            $last_column = 5 + count($dates);
            $temp_alpha = $all_alpha_[count($all_alpha_) - 1];
            $temp_alpha_arr = $all_alpha_;
            for ($i = 0; $i < 3; $i++) {
                $temp_alpha++;
                $temp_alpha_arr[] = $temp_alpha;
            }

            $spreadsheet->getActiveSheet()->getStyle('C5:' . $temp_alpha_arr[count($temp_alpha_arr) - 1] . '' . $last_column)->getNumberFormat()->setFormatCode($format);

            $day_counter = $day_counter + 5;
            $alpha = 'C';
            for ($i = 1; $i < $categories_count; $i++) {
                $spreadsheet->getActiveSheet()->setCellValue($alpha . "" . $day_counter, "=SUM(" . $alpha . "5:" . $alpha . "" . ($day_counter - 1) . ")");
                $alpha++;
            }
            $spreadsheet->getActiveSheet()->setCellValue($alpha . "" . $day_counter, "=SUM(" . $alpha . "5:" . $alpha . "" . ($day_counter - 1) . ")");

            $date_counter = 0;
            for ($i = 5; $i < count($dates) + 5; $i++) {

                $cheque_received = DailyPettyExpense::totalReceived($this->branch_id, date('Y-m-d', strtotime($dates[$date_counter])));

                $spreadsheet->getActiveSheet()->setCellValue($temp_alpha_arr[count($temp_alpha_arr) - 2] . "" . $i, $cheque_received);

                $closing_balance = DailyPettyExpense::closingBalance($this->branch_id, date('Y-m-d', strtotime($dates[$date_counter])));

                $spreadsheet->getActiveSheet()->setCellValue($temp_alpha_arr[count($temp_alpha_arr) - 1] . "" . $i, $closing_balance);
                $date_counter++;
            }

            $columns = [];
            $alphabate = 'A';
            for ($i = 1; $i <= ($categories_count + 5); $i++) {
                $columns[] = $alphabate;
                $alphabate++;
            }

            //code here
            $cdate=date('Y-m-d',strtotime($dates[0]));
            
            $spreadsheet->setActiveSheetIndex(0)
                        ->mergeCells($columns[count($columns)-4].'4:'.$columns[count($columns)-1].'4')
                        ->setCellValue($columns[count($columns)-4].'4', 'opening balance : '.$this->getopeningbalance($cdate,$this->branch_id));

             $spreadsheet->getActiveSheet()->getStyle($columns[count($columns)-4].'4:'.$columns[count($columns)-1].'4')->applyFromArray($styleArray_heading);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($columns[0] . "3:" . $columns[count($columns) - 1] . "3")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("c0c0c0");

            $start_border_row_position = 4;

            for ($i = 4; $i <(count($dates)+5); $i++) {
                $data = $columns[0] . $i . ":" . $columns[count($columns) - 1] . $i;
                $spreadsheet
                    ->getActiveSheet()
                    ->getStyle($data)
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    )
                    ->setColor(new Color("000000"));
            }

            $start = 3;
            $end = 17;

            foreach ($columns as $dd) {
                $spreadsheet
                    ->getActiveSheet()
                    ->getStyle($dd . "3:" . $dd .(count($dates)+5))
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    )
                    ->setColor(new Color("000000"));
            }
            $spreadsheet->getActiveSheet()->setCellValue("A" . $day_counter, "Total");

             $spreadsheet
                ->getActiveSheet()
                ->getStyle("A" . $day_counter)
                ->getFont()
                ->setSize(9);

            $spreadsheet->getActiveSheet()->getStyle("A" .$day_counter.":AD".$day_counter)->applyFromArray($styleArray_heading);

          
            foreach (range("A", $columns_[count($columns_) - 1]) as $columnID) {
                $spreadsheet
                    ->getActiveSheet()
                    ->getStyle($columnID)
                    ->getAlignment()
                    ->setHorizontal("center");
                $spreadsheet
                    ->getActiveSheet()
                    ->getStyle($columnID)
                    ->getAlignment()
                    ->setVertical("center");
            }

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($columns[0] . "3:" . $columns[count($columns) - 1] . "3")
                ->getAlignment()
                ->setWrapText(true);
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($columns[0] . "3:" . $columns[count($columns) - 1] . "3")
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($columns[0] . "3:" . $columns[count($columns) - 1] . "3")
                ->getAlignment()
                ->setVertical(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                );

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($columns[0] . "3:" . $columns[count($columns) - 1] . "3")
                ->getFont()
                ->setSize(7);

            $spreadsheet->getActiveSheet()->setTitle($branch->short_name);
            count($branches) != $branch_counter ? $spreadsheet->createSheet() : '';
            $branch_counter++;
        }
        
       $lastColumn =  $spreadsheet->setActiveSheetIndex(0)->getHighestDataColumn();
       $lastRow    =  $spreadsheet->setActiveSheetIndex(0)->getHighestDataRow();

        $spreadsheet->setActiveSheetIndex(0);
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = "Branch-Petty-Cash-Reporting" . $timestamp . ".xlsx";
        $writer = new Xlsx($spreadsheet);
        header(
            "Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        );
        header(
            'Content-Disposition: attachment; filename="' .
            urlencode($fileName) .
            '"'
        );
        $writer->save("php://output");
    }

    public function getExpenseBranchWise($subcategory, $current_date, $branch_id)
    {
        return DailyPettyExpense::where('branch_id', $branch_id)
            ->where('category_id', $subcategory->category_id)
            ->where('sub_category_id', $subcategory->id)
            ->where('report_date', $current_date)
            ->sum('amount');
    } 

     public function getopeningbalance($date, $branch_id)
    {
            
        $total_date=DailyPettyExpenseBalance::where('branch_id', $branch_id)->whereMonth('report_date',date('m',strtotime($date)))->orderby('report_date','ASC')->get()->pluck('report_date');


        $data=DailyPettyExpenseBalance::select('id','petty_cash_opening_balance')->where('branch_id', $branch_id)->whereDate('report_date',$total_date[0])->orderby('id','ASC')->first();

        if($data)
        {
            return number_format($data->petty_cash_opening_balance,3,'.','');
        }else{
            return number_format(0,3,'.','');
        }


    }
}
