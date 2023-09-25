<?php

namespace App\Http\Reports;

use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \App\Models\DailyPettyExpense;
use \App\Models\DailyPettyExpenseCategory;
use \App\Models\DailyPettyExpenseSubCategory;

class GeneratePettyCashMonthlyReport
{
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

        $spreadsheet->setActiveSheetIndex(0);
        $by_month_tab = $spreadsheet->getActiveSheet()->setTitle("By Month ");
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
                "MUGHAL MAHAL ALL RESTAURANT PETTY CASH EXPENSES F/Y " . date('Y')
            );

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("1")
            ->setRowHeight(35);

        $spreadsheet->getActiveSheet()->mergeCells("A1:AG1");

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
                "YEARLY CASH EXPENSES : TYPE OF EXPENSES CATEGORY"
            );

        $spreadsheet->getActiveSheet()->setCellValue("AE2", "Total");
        $spreadsheet->getActiveSheet()->mergeCells("A2:AD2");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2")
            ->getFont()
            ->setSize(12);

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
            ->getRowDimension("4")
            ->setRowHeight(15);

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
            ->getStyle("A2:AG2")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("969696");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2:AG2")
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2:AG2")
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
            ->getStyle("A2:AG2")
            ->getBorders()
            ->getRight()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );

        $months_array = [];
        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            if (date('m') >= $m) {
                $months_array[] = $month;
                $months[] = $m;
            }
        }

        $rowArray = [
            "Month",
            "Statement  \n Reg Code",
        ];

        $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();
        $categories_name = [];

        $last_col_1 = 'A';
        foreach ($categories as $category) {
            foreach ($category->subcategories as $subcategory) {
                $categories_name[] = $subcategory->sub_cat_name;
                $last_col_1++;
            }
        }
        $rowArray = array_merge($rowArray, $categories_name);

        $spreadsheet->getActiveSheet()->fromArray(
            $rowArray,
            null,
            "A3"
        );

        $number = 5;
        foreach ($months as $month) {
            $expense = [];
            foreach ($categories as $category) {
                foreach ($category->subcategories as $subcategory) {
                    $expense[] = $this->getExpense($subcategory, $month);
                }
            }
            $rowArrayData = $expense;

            $spreadsheet->getActiveSheet()->fromArray(
                $rowArrayData,
                null,
                "C" . $number
            );

            $spreadsheet->getActiveSheet()->setCellValue("AE" . $number, "=SUM(C" . $number . ":AD" . $number . ")");
            $number++;
        }

        $rowArray = $months_array;
        $columnArray = array_chunk($rowArray, 1);

        $spreadsheet->getActiveSheet()->fromArray(
            $columnArray,
            null,
            "A5"
        );

        $rowArray = $months; //will be changed
        $columnArray = array_chunk($rowArray, 1);
        $spreadsheet->getActiveSheet()->fromArray(
            $columnArray,
            null,
            "B5"
        );

        $categories_count = DailyPettyExpenseSubCategory::all()->count();

        $alpha = 'C';
        for ($i = 1; $i < $categories_count; $i++) {
            $spreadsheet->getActiveSheet()->setCellValue($alpha . "" . $number, "=SUM(" . $alpha . "5:" . $alpha . "" . $number . ")");
            $alpha++;
        }

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:AG3")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("c0c0c0");

        $start_border_row_position = 4;
        $columns = [
            "A",
            "B",
            "C",
            "D",
            "E",
            "F",
            "G",
            "H",
            "I",
            "J",
            "K",
            "L",
            "M",
            "N",
            "O",
            "P",
            "Q",
            "R",
            "S",
            "T",
            "U",
            "V",
            "W",
            "X",
            "Y",
            "Z",
            "AA",
            "AB",
            "AC",
            "AD",
            "AE",
            "AF",
            "AG",
        ];

        for ($i = 4; $i < 19; $i++) {
            $data = "A" . $i . ":AG" . $i;
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
        $end = count($months);
        $end = $end + $start_border_row_position;

        foreach ($columns as $dd) {
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($dd . "3:" . $dd . "18")
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                )
                ->setColor(new Color("000000"));
        }

        $spreadsheet->getActiveSheet()->setCellValue("A" . ++$end, "Total");

        foreach (range("A", "50") as $columnID) {
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
            ->getStyle("A3:AG3")
            ->getAlignment()
            ->setWrapText(true);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:AG3")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:AG3")
            ->getAlignment()
            ->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:AG3")
            ->getFont()
            ->setSize(7);

        $spreadsheet->createSheet();

        $spreadsheet->setActiveSheetIndex(0);

        $fileName = "Petty Cash Monthly Reporting.xlsx";
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

    public function getExpense($subcategory, $month)
    {
        return DailyPettyExpense::whereMonth('created_at', $month)
            ->whereYear('created_at', date('Y'))
            ->where('category_id', $subcategory->category_id)
            ->where('sub_category_id', $subcategory->id)
            ->sum('amount');
    }
}
