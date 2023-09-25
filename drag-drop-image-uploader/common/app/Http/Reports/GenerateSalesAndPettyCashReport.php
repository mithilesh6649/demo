<?php

namespace App\Http\Reports;

use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \App\Models\Branch;
use \App\Models\DailyPettyExpense;
use \App\Models\Signature;

class GenerateSalesAndPettyCashReport
{
    public $branch_id;
    public $date;
    public $date_format;

    public function __construct($branch_id, $date)
    {
        $this->branch_id = $branch_id;
        $this->date = $date;
        $this->date_format = $date;

        $this->date = str_replace("/", "-", $this->date);
        $this->date = date('Y-m-d', strtotime($this->date));
    }

    public function result()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);

        // Styling Heading //

        $styleArray_heading = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Calibri',
            ));

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray_heading);
        $spreadsheet->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray_heading);

        $spreadsheet->getActiveSheet()
        ->getStyle('A1:E1')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('fcda51');

        $spreadsheet->getActiveSheet()
        ->getStyle('A2:E2')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('fcda51');

        // --------------- //

        /* Rename worksheet */
        $by_month_tab = $spreadsheet->getActiveSheet()->setTitle("PETTY CASH SHEET");
        /* set default value */
        $spreadsheet->getDefaultStyle()->getFont()->setName("Arial")->setSize(10);
        $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );
        //Heading.............
        $spreadsheet->getActiveSheet()->setCellValue("A1", "MUGHAL MAHAL");
        //increase width
        $spreadsheet->getActiveSheet()->getRowDimension("1")->setRowHeight(35);
        //Merge Heading
        $spreadsheet->getActiveSheet()->mergeCells("A1:E1");

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);

        //Set Font size
        $spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);
        //Set Cell alignment center
        $spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );
        $spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->setVertical(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        );

        $spreadsheet->getActiveSheet()->setCellValue("A2", "STATEMENT OF DAILY PETTY CASH EXPENSE");
        //Merge Heading
        $spreadsheet->getActiveSheet()->mergeCells("A2:E2");
        $branch_name = 'All Branches';
        if ($this->branch_id != 0) {
            $branch_name = Branch::find($this->branch_id)->short_name;
        }
        $expenses = $this->branch_id == 0
        ? DailyPettyExpense::whereDate('report_date', $this->date)->get()
        : DailyPettyExpense::whereDate('report_date', $this->date)->where('branch_id', $this->branch_id)->get();

        $sl_no = [];
        foreach ($expenses as $expense_item) {
            $sl_no[] = $expense_item->doc_ref_no;
        }
        $sl_no = array_unique($sl_no);

        $spreadsheet->getActiveSheet()->setCellValue("A3", "Sl No: ");
        $spreadsheet->getActiveSheet()->setCellValue("B3", implode(',', $sl_no));

        $spreadsheet->getActiveSheet()->setCellValue("C3", "Date: " . $this->date_format);
        $spreadsheet->getActiveSheet()->setCellValue("D3", "Branch Name: " . $branch_name);

        $spreadsheet->getActiveSheet()->setCellValue("A4", "SI NO.");
        $spreadsheet->getActiveSheet()->setCellValue("B4", "Expense Category");

        $spreadsheet->getActiveSheet()->setCellValue("C4", "Description");
        $spreadsheet->getActiveSheet()->setCellValue("D4", "Invoice Number");
        $spreadsheet->getActiveSheet()->setCellValue("E4", "KD");

        $counter = 5;
        $s_no = 1;
        foreach ($expenses as $expense) {
            $spreadsheet->getActiveSheet()->setCellValue("A" . $counter, $s_no);
            $spreadsheet->getActiveSheet()->setCellValue("B" . $counter, $expense->sub_category->sub_cat_name);
            $spreadsheet->getActiveSheet()->setCellValue("C" . $counter, $expense->description == null ? '-' : $expense->description);
            $spreadsheet->getActiveSheet()->setCellValue("D" . $counter, $expense->voucher_number == null ? '-' : $expense->voucher_number);
            $spreadsheet->getActiveSheet()->setCellValue("E" . $counter, $expense->amount);

            $spreadsheet->getActiveSheet()->getStyle("A" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("B" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("C" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("D" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("E" . $counter)->getFont()->setSize(12);

            $spreadsheet->getActiveSheet()->getStyle("A" . $counter)->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
            $spreadsheet->getActiveSheet()->getStyle("A" . $counter)->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

            $spreadsheet->getActiveSheet()->getStyle("B" . $counter)->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
            $spreadsheet->getActiveSheet()->getStyle("B" . $counter)->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

            $spreadsheet->getActiveSheet()->getStyle("C" . $counter)->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
            $spreadsheet->getActiveSheet()->getStyle("C" . $counter)->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

            $spreadsheet->getActiveSheet()->getStyle("D" . $counter)->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
            $spreadsheet->getActiveSheet()->getStyle("D" . $counter)->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

            $spreadsheet->getActiveSheet()->getStyle("E" . $counter)->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
            $spreadsheet->getActiveSheet()->getStyle("E" . $counter)->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

            $counter++;
            $s_no++;
        }
        $spreadsheet->getActiveSheet()->setCellValue("C" . $counter, 'Petty Cash Exp-Day Total(-)');
        $spreadsheet->getActiveSheet()->mergeCells("C" . $counter . ":D" . $counter);
        $spreadsheet->getActiveSheet()->setCellValue("E" . $counter, $expenses->sum('amount'));
        $spreadsheet->getActiveSheet()->getStyle("C" . $counter)->getFont()->setSize(12);

        $counter_2 = $counter + 2;

        $spreadsheet->getActiveSheet()->setCellValue("B" . $counter_2, 'Details Cash Receviced');
        $spreadsheet->getActiveSheet()->setCellValue("C" . $counter_2, 'Petty Cash Closing Balance.=');
        $spreadsheet->getActiveSheet()->setCellValue("E" . $counter_2, DailyPettyExpense::openingBalance($this->branch_id, $this->date));
        $spreadsheet->getActiveSheet()->getStyle("B" . $counter_2)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . $counter_2)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("E" . $counter_2)->getFont()->setSize(12);

        $spreadsheet->getActiveSheet()->setCellValue("A" . ($counter_2 + 1), 'Date:');
        $spreadsheet->getActiveSheet()->setCellValue("C" . ($counter_2 + 1), '(+)Cash Reviced');
        $spreadsheet->getActiveSheet()->setCellValue("E" . ($counter_2 + 1), DailyPettyExpense::totalReceived($this->branch_id, $this->date));
        $spreadsheet->getActiveSheet()->getStyle("A" . ($counter_2 + 1))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 1))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("E" . ($counter_2 + 1))->getFont()->setSize(12);

        $spreadsheet->getActiveSheet()->setCellValue("A" . ($counter_2 + 2), 'Mode:');
        $spreadsheet->getActiveSheet()->setCellValue("C" . ($counter_2 + 2), '(-)Cash Expense');
        $spreadsheet->getActiveSheet()->setCellValue("E" . ($counter_2 + 2), DailyPettyExpense::totalExpense($this->branch_id, $this->date));
        $spreadsheet->getActiveSheet()->getStyle("A" . ($counter_2 + 2))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 2))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("E" . ($counter_2 + 2))->getFont()->setSize(12);

        $spreadsheet->getActiveSheet()->setCellValue("A" . ($counter_2 + 3), 'Amount');
        $spreadsheet->getActiveSheet()->setCellValue("C" . ($counter_2 + 3), 'Petty Cash Closing Balance.=');
        $spreadsheet->getActiveSheet()->setCellValue("E" . ($counter_2 + 3), DailyPettyExpense::closingBalance($this->branch_id, $this->date));
        $spreadsheet->getActiveSheet()->getStyle("A" . ($counter_2 + 3))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 3))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("E" . ($counter_2 + 3))->getFont()->setSize(12);

        // $spreadsheet->getActiveSheet()->setCellValue("B".($counter_2+5),'Prepared By');
        $spreadsheet->getActiveSheet()->setCellValue("C" . ($counter_2 + 5), 'Verified By');
        $spreadsheet->getActiveSheet()->setCellValue("D" . ($counter_2 + 5), 'Approved By');

        // Enter Signature Here //

        $signature_count = 6;
              
        foreach (@$expenses as $expense) {

            // $verified_signature = Signature::where(['parent_id' => $expense->id, 'parent_type' => 'daily_petty_report', 'signature_type' => 'verified_by'])->first();
            // $approved_signature = Signature::where(['parent_id' => $expense->id, 'parent_type' => 'daily_petty_report', 'signature_type' => 'approved_by'])->first();

             $verified_signature = Signature::where(['branch_id' => $this->branch_id, 'parent_type' => 'daily_petty_report', 'signature_type' => 'verified_by','report_date' => $this->date])->first();
            $approved_signature = Signature::where(['branch_id' => $this->branch_id, 'parent_type' => 'daily_petty_report', 'signature_type' => 'approved_by','report_date' => $this->date])->first();

            if (@$verified_signature || @$approved_signature) {
                $spreadsheet->getActiveSheet()->getRowDimension($counter_2 + $signature_count)->setRowHeight(70);
            }

            if (@$verified_signature) {

                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                // $drawing->setName('PhpSpreadsheet logo');
                // $drawing->setDescription('PhpSpreadsheet logo');
                $drawing->setPath(env('BRANCH_SIGNATURE_PATH') . $verified_signature->signature);
                $drawing->setHeight(36);
                $drawing->setCoordinates('C' . ($counter_2 + $signature_count));
                $drawing->setOffsetX(10);
                $drawing->setHeight(300);
                $drawing->setWidth(200);
                $drawing->setWorksheet($spreadsheet->getActiveSheet());

            }

            if (@$approved_signature) {

                // $spreadsheet->getActiveSheet()->getDrawingCollection()->setCellValue("D" . ($counter_2 + $signature_count), $expense['verified_by']);

                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                // $drawing->setName('PhpSpreadsheet logo');
                // $drawing->setDescription('PhpSpreadsheet logo');
                $drawing->setPath(env('BRANCH_SIGNATURE_PATH') . $approved_signature->signature);
                $drawing->setHeight(36);
                $drawing->setCoordinates('D' . ($counter_2 + $signature_count));
                $drawing->setOffsetX(10);
                $drawing->setHeight(300);
                $drawing->setWidth(200);
                $drawing->setWorksheet($spreadsheet->getActiveSheet());
            }

            $signature_count++;
            break;

        }

        // ----------------- //

        // $spreadsheet->getActiveSheet()->getStyle("B".($counter_2+5))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 5))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("D" . ($counter_2 + 5))->getFont()->setSize(12);

        // $spreadsheet->getActiveSheet()->getStyle("B".($counter_2+5))->getFont()->getColor()
        // ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 5))->getFont()->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        $spreadsheet->getActiveSheet()->getStyle("D" . ($counter_2 + 5))->getFont()->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        //Set Font size
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2")
            ->getFont()
            ->setSize(20);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3")
            ->getFont()
            ->setSize(12);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("B3")
            ->getFont()
            ->setSize(12);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("C3")
            ->getFont()
            ->setSize(12);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("D3")
            ->getFont()
            ->setSize(12);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A4")
            ->getFont()
            ->setSize(12);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("B4")
            ->getFont()
            ->setSize(12);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("C4")
            ->getFont()
            ->setSize(12);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("D4")
            ->getFont()
            ->setSize(12);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("E4")
            ->getFont()
            ->setSize(12);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("C" . $counter)
            ->getFont()
            ->setSize(12);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("E" . $counter)
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

        //Border..................
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2:E2")
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2:E2")
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
            ->getStyle("A2:E2")
            ->getBorders()
            ->getRight()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );

        // border a1
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1:E1")
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1:E1")
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1")
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
        $spreadsheet->getActiveSheet()->getStyle("A1:E1")->getBorders()->getRight()->setBorderStyle(
            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        );

        $new_counter = $counter_2 + $signature_count;

        for ($i = 3; $i < $new_counter; $i++) {
            $spreadsheet->getActiveSheet()->getStyle("A" . $i . ":E" . $i)->getBorders()->getRight()->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
            $spreadsheet->getActiveSheet()->getStyle("A" . $i . ":E" . $i)->getBorders()->getLeft()->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
            $spreadsheet->getActiveSheet()->getStyle("A" . $i . ":E" . $i)->getBorders()->getTop()->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
            $spreadsheet->getActiveSheet()->getStyle("A" . $i . ":E" . $i)->getBorders()->getBottom()->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
        }

        // format
        $format = '0.000';
        $last_column = $counter_2 + 3;
        $spreadsheet->getActiveSheet()->getStyle('C5:AD' . $last_column)->getNumberFormat()->setFormatCode($format);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A1:E1')
        //     ->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A2:E2')
        //     ->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('A3')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('C3')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('D3')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('A4')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('B4')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('C4')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('D4')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('E4')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('C' . $counter)
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('E' . $counter)
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('B3')
            ->getFont()
            ->getColor()
            ->setARGB('009549');
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = "Daily-Petty-Cash-Reporting" . $timestamp . ".xlsx";
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
}
