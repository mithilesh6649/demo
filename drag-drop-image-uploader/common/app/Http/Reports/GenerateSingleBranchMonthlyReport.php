<?php

namespace App\Http\Reports;

use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \App\Models\Branch;
use \App\Models\DailyPettyExpense;
use \App\Models\DailyPettyExpenseBalance;
use \App\Models\DailyPettyExpenseCategory;

class GenerateSingleBranchMonthlyReport
{
    public $branch_id;
    public $year;

    public function __construct($branch_id, $year)
    {
        $this->branch_id = $branch_id;
        $this->year = $year;
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

        // --------------- //

        $format = '0.000';

        $tab_count = 0;
        $branch = Branch::find($this->branch_id);
        $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();
        $categories_name = [];

        foreach ($categories as $category) {
            foreach ($category->subcategories as $subcategory) {
                $categories_name[] = $subcategory->sub_cat_name;
            }
        }
        $categories_count = count($categories_name);
        $tab_count++;

        $columns_ = [];
        $alphabate_ = 'A';
        for ($i = 1; $i <= ($categories_count + 5); $i++) {
            $columns_[] = $alphabate_;
            $alphabate_++;
        }

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
                ->setRowHeight(35);
        }
        $spreadsheet
            ->getActiveSheet()
            ->setCellValue(
                "A1",
                "MUGHAL MAHAL ALL RESTAURANT PETTY CASH EXPENSES F/Y " . $this->year . " (" . $branch['short_name'] . ")"
            );

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("1")
            ->setRowHeight(35);

        $spreadsheet->getActiveSheet()->mergeCells("A1:" . $columns_[count($columns_) - 1] . "1");

        $spreadsheet->getActiveSheet()->mergeCells($columns_[count($columns_) - 7] . "4:" . $columns_[count($columns_) - 4] . "4");
        $spreadsheet
            ->getActiveSheet()
            ->setCellValue(
                $columns_[count($columns_) - 7] . "4",
                "Opening Balance"
            );

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
            ->setRowHeight(25);

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("3")
            ->setRowHeight(35);

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
            "Branch",
            "Statement  \n Reg Code",
        ];

        $rowArray = array_merge($rowArray, $categories_name);

        $rowArray_2 = [
            "Total",
            "Chq Rcd",
            "Closing Bal",
        ];

        $rowArray = array_merge($rowArray, $rowArray_2);

        $spreadsheet->getActiveSheet()->fromArray(
            $rowArray,
            null,
            "A3"
        );

        $number = 5;
        $s_no_ = [];
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

        $months = [];
        $months_ = [];
        for ($i = 1; $i <= 12; $i++) {
            $i = $i < 10 ? '0' . $i : $i;
            $day_counter++;
            $s_no_[] = $day_counter;
            $expense = [];
            $months[] = $i . '/' . date('y', strtotime($this->year));
            $months_[] = date('Y-m-t', strtotime($this->year . '-' . $i . '-01'));
            foreach ($categories as $category) {
                foreach ($category->subcategories as $subcategory) {
                    $expense[] = $this->getExpenseBranchMonthWise($subcategory, $branch, $i, $this->year) == 0 ? '-' : $this->getExpenseBranchMonthWise($subcategory, $branch, $i, $this->year);
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

        // format
        $last_column = 5 + count($months);

        $temp_alpha = $all_alpha_[count($all_alpha_) - 1];
        $temp_alpha_arr = $all_alpha_;
        for ($i = 0; $i < 3; $i++) {
            $temp_alpha++;
            $temp_alpha_arr[] = $temp_alpha;
        }

        $spreadsheet->getActiveSheet()->getStyle('C4:' . $temp_alpha_arr[count($temp_alpha_arr) - 1] . '' . $last_column)->getNumberFormat()->setFormatCode($format);

        for ($i = 5; $i <= count($months) + 5; $i++) {
            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A" . $i)
                ->getFont()
                ->setSize(7);
        }

        $rowArray = $months;

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

        $day_counter = $day_counter + 5;
        $alpha = 'C';
        for ($i = 1; $i < $categories_count; $i++) {
            $spreadsheet->getActiveSheet()->setCellValue($alpha . "" . $day_counter, "=SUM(" . $alpha . "5:" . $alpha . "" . $day_counter . ")");
            $alpha++;
        }
        $spreadsheet->getActiveSheet()->setCellValue($alpha . "" . $day_counter, "=SUM(" . $alpha . "5:" . $alpha . "" . $day_counter . ")");

        $date_counter = 0;
        for ($i = 5; $i < count($months_) + 5; $i++) {

            $cheque_received = $this->chequeReceivedByMonth($this->branch_id, date('m', strtotime($months_[$date_counter])));
            $spreadsheet->getActiveSheet()->setCellValue($temp_alpha_arr[count($temp_alpha_arr) - 2] . "" . $i, $cheque_received);

            $closing_balance = DailyPettyExpense::closingBalance($this->branch_id, date('Y-m-d', strtotime($months_[$date_counter])));

            $spreadsheet->getActiveSheet()->setCellValue($temp_alpha_arr[count($temp_alpha_arr) - 1] . "" . $i, $closing_balance);
            $date_counter++;
        }

        $opening_balance = DailyPettyExpense::openingBalance($this->branch_id, date('Y-m-d', strtotime($months_[0])));

        $spreadsheet->getActiveSheet()->setCellValue($temp_alpha_arr[count($temp_alpha_arr) - 1] . "4", $opening_balance);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:" . $columns_[count($columns_) - 1] . "3")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("c0c0c0");

        $start_border_row_position = 4;
        $columns = $columns_;

        for ($i = 4; $i < 36; $i++) {
            $data = "A" . $i . ":" . $columns_[count($columns_) - 1] . "" . $i;
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
                ->getStyle($dd . "3:" . $dd . "36")
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                )
                ->setColor(new Color("000000"));
        }
        $spreadsheet->getActiveSheet()->setCellValue("A" . $day_counter, "Total");

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
            ->getStyle("A3:" . $columns_[count($columns_) - 1] . "3")
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:" . $columns_[count($columns_) - 1] . "3")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:" . $columns_[count($columns_) - 1] . "3")
            ->getAlignment()
            ->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:" . $columns_[count($columns_) - 1] . "3")
            ->getFont()
            ->setSize(7);

        $spreadsheet->getActiveSheet()->setTitle('By Month');

        $spreadsheet->setActiveSheetIndex(0);
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = "Petty-Cash-Report-By-Month-Single-Branch" . $timestamp . ".xlsx";
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

    public function getExpenseBranchMonthWise($subcategory, $branch, $month = null, $year = null)
    {
        $month = $month ? $month : date('m');
        $year = $year ? $year : date('Y');
        return DailyPettyExpense::where('branch_id', $branch->id)
            ->where('category_id', $subcategory->category_id)
            ->where('sub_category_id', $subcategory->id)
            ->whereMonth('report_date', $month)
            ->whereYear('report_date', $year)
            ->sum('amount');
    }

    public function chequeReceivedByMonth($branch_id, $month)
    {
        $reports = DailyPettyExpenseBalance::where([
            'branch_id' => $branch_id,
            'cash_expense' => 0,
        ])->where('cash_received', '!=', 0)->whereMonth('report_date', $month)->get();

        $cheque_received = 0.000;
        foreach ($reports as $report) {
            $cheque_received = $cheque_received + number_format($report->cash_received, 3, '.', '');
        }
        return $cheque_received;
    }
}
