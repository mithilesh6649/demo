<?php

namespace App\Http\Reports;

use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \App\Models\Branch;
use \App\Models\MaintenanceReport;

class GenerateMaintenanceReport
{
    public $branch_id;
    public $date;
    public $date_format;
    public $report_date_1;
    public $report_date_2;

    public function __construct($branch_id, $date)
    {
        $this->branch_id = $branch_id;
        $this->date = $date;
        $this->date_format = $this->date[1];

        $this->report_date_1 = str_replace("/", "-", $this->date[0]);
        $this->report_date_1 = date('Y-m-d', strtotime($this->report_date_1));

        $this->report_date_2 = str_replace("/", "-", $this->date[1]);
        $this->report_date_2 = date('Y-m-d', strtotime($this->report_date_2));

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

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray_heading);
        $spreadsheet->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray_heading);

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:G1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('fcda51');

        $spreadsheet->getActiveSheet()
            ->getStyle('A2:G2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('fcda51');

        // --------------- //

        $spreadsheet->setActiveSheetIndex(0);
        /* Rename worksheet */
        $by_month_tab = $spreadsheet->getActiveSheet()->setTitle("MAINTENANCE SHEET");
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
        $spreadsheet->getActiveSheet()->mergeCells("A1:G1");

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);

        //Set Font size
        $spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);
        //Set Cell alignment center
        $spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );
        $spreadsheet->getActiveSheet()->getStyle("A1")->getAlignment()->setVertical(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        );

        $spreadsheet->getActiveSheet()->setCellValue("A2", "STATEMENT OF MAINTENANCE REPORT");
        //Merge Heading
        $spreadsheet->getActiveSheet()->mergeCells("A2:G2");
        $branch_name = 'All Branches';
        if ($this->branch_id != 0) {
            $branch_name = Branch::find($this->branch_id)->short_name;
        }
        $expenses = $this->branch_id == 0
        ? MaintenanceReport::where('report_date', '>=', $this->report_date_1)->where('report_date', '<=', $this->report_date_2)->orderBy('report_date', 'DESC')
            ->orderBy('id', 'DESC')->get()
        : MaintenanceReport::where('report_date', '>=', $this->report_date_1)->where('report_date', '<=', $this->report_date_2)->where('branch_id', $this->branch_id)->orderBy('report_date', 'DESC')
            ->orderBy('id', 'DESC')->get();

        $spreadsheet->getActiveSheet()->setCellValue("C3", "Date: " . "(" . $this->date[0] . ' - ' . $this->date[1] . ")");
        $spreadsheet->getActiveSheet()->setCellValue("D3", "Branch Name: " . $branch_name);

        $spreadsheet->getActiveSheet()->setCellValue("A4", "Category");
        $spreadsheet->getActiveSheet()->setCellValue("B4", "Sub Category");

        $spreadsheet->getActiveSheet()->setCellValue("C4", "Invoice Number");
        $spreadsheet->getActiveSheet()->setCellValue("D4", "Voucher Number");
        $spreadsheet->getActiveSheet()->setCellValue("E4", "Amount");
        $spreadsheet->getActiveSheet()->setCellValue("F4", "Attachment");
        $spreadsheet->getActiveSheet()->setCellValue("G4", "Report Date");

        $counter = 5;
        foreach ($expenses as $expense) {
            $spreadsheet->getActiveSheet()->setCellValue("A" . $counter, isset($expense->category->cat_name) ? $expense->category->cat_name : '');
            $spreadsheet->getActiveSheet()->setCellValue("B" . $counter, isset($expense->sub_category->sub_cat_name) ? $expense->sub_category->sub_cat_name : '');
            $spreadsheet->getActiveSheet()->setCellValue("C" . $counter, $expense->voucher_number == null ? '-' : $expense->voucher_number);
            $spreadsheet->getActiveSheet()->setCellValue("D" . $counter, $expense->doc_ref_no);
            $spreadsheet->getActiveSheet()->setCellValue("E" . $counter, 'KD' . ' ' . number_format($expense->amount, 3, '.', ''));
            $spreadsheet->getActiveSheet()->setCellValue("F" . $counter, \App\Models\MaintenanceReportDoc::checkmaintenanceattachment($expense->id));
            $spreadsheet->getActiveSheet()->setCellValue("G" . $counter, date('d/m/Y', strtotime($expense->report_date)));

            $spreadsheet->getActiveSheet()->getStyle("A" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("B" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("C" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("D" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("E" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("F" . $counter)->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("G" . $counter)->getFont()->setSize(12);

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

            $spreadsheet->getActiveSheet()->getStyle("F" . $counter)->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
            $spreadsheet->getActiveSheet()->getStyle("F" . $counter)->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );
            $spreadsheet->getActiveSheet()->getStyle("G" . $counter)->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
            $spreadsheet->getActiveSheet()->getStyle("G" . $counter)->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );

            $counter++;
        }

        $spreadsheet->getActiveSheet()->setCellValue("C" . $counter, 'Maintenance Cash Exp-Day Total(-)');
        $spreadsheet->getActiveSheet()->mergeCells("C" . $counter . ":D" . $counter);
        $spreadsheet->getActiveSheet()->setCellValue("E" . $counter, $expenses->sum('amount'));
        $spreadsheet->getActiveSheet()->getStyle("C" . $counter)->getFont()->setSize(12);

        $counter_2 = $counter + 2;

        $spreadsheet->getActiveSheet()->setCellValue("A" . ($counter_2 + 1), 'Date:');
        $spreadsheet->getActiveSheet()->setCellValue("C" . ($counter_2 + 1), '(+)Cash Reviced');
        $spreadsheet->getActiveSheet()->setCellValue("E" . ($counter_2 + 1), MaintenanceReport::totalReceived($this->branch_id, $this->date));
        $spreadsheet->getActiveSheet()->getStyle("A" . ($counter_2 + 1))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 1))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("E" . ($counter_2 + 1))->getFont()->setSize(12);

        $spreadsheet->getActiveSheet()->setCellValue("A" . ($counter_2 + 2), 'Mode:');
        $spreadsheet->getActiveSheet()->setCellValue("C" . ($counter_2 + 2), '(-)Cash Expense');
        $spreadsheet->getActiveSheet()->setCellValue("E" . ($counter_2 + 2), MaintenanceReport::totalExpense($this->branch_id, $this->date));
        $spreadsheet->getActiveSheet()->getStyle("A" . ($counter_2 + 2))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 2))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("E" . ($counter_2 + 2))->getFont()->setSize(12);

        $spreadsheet->getActiveSheet()->setCellValue("A" . ($counter_2 + 3), 'Amount');
        $spreadsheet->getActiveSheet()->setCellValue("C" . ($counter_2 + 3), 'Petty Cash Closing Balance.=');
        $spreadsheet->getActiveSheet()->setCellValue("E" . ($counter_2 + 3), MaintenanceReport::closingBalance($this->branch_id, $this->date));
        $spreadsheet->getActiveSheet()->getStyle("A" . ($counter_2 + 3))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 3))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("E" . ($counter_2 + 3))->getFont()->setSize(12);

        $spreadsheet->getActiveSheet()->setCellValue("B" . ($counter_2 + 5), 'Prepared By');
        $spreadsheet->getActiveSheet()->setCellValue("C" . ($counter_2 + 5), 'Verified By');
        $spreadsheet->getActiveSheet()->setCellValue("D" . ($counter_2 + 5), 'Approved By');
        $spreadsheet->getActiveSheet()->getStyle("B" . ($counter_2 + 5))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("C" . ($counter_2 + 5))->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle("D" . ($counter_2 + 5))->getFont()->setSize(12);

        $spreadsheet->getActiveSheet()->getStyle("B" . ($counter_2 + 5))->getFont()->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
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
            ->getStyle("F4")
            ->getFont()
            ->setSize(12);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("G4")
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
            ->getStyle("A2:G2")
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2:G2")
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
            ->getStyle("A2:G2")
            ->getBorders()
            ->getRight()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );

        // border a1
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1:G1")
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1:G1")
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
        $spreadsheet->getActiveSheet()->getStyle("A1:G1")->getBorders()->getRight()->setBorderStyle(
            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        );

        $new_counter = $counter_2 + 7;
        for ($i = 3; $i < $new_counter; $i++) {
            $spreadsheet->getActiveSheet()->getStyle("A" . $i . ":G" . $i)->getBorders()->getRight()->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
            $spreadsheet->getActiveSheet()->getStyle("A" . $i . ":G" . $i)->getBorders()->getLeft()->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
            $spreadsheet->getActiveSheet()->getStyle("A" . $i . ":G" . $i)->getBorders()->getTop()->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
            $spreadsheet->getActiveSheet()->getStyle("A" . $i . ":G" . $i)->getBorders()->getBottom()->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );
        }

        // format
        $format = '0.000';
        $last_column = $counter_2 + 3;
        $spreadsheet->getActiveSheet()->getStyle('D5:AD' . $last_column)->getNumberFormat()->setFormatCode($format);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A1:G1')
        //     ->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A2:G2')
        //     ->getFont()
        //     ->getColor()
        //     ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('C3')
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
            ->getStyle('F4')
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $spreadsheet->getActiveSheet()
            ->getStyle('G4')
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
            ->getStyle('D3')
            ->getFont()
            ->getColor()
            ->setARGB('009549');
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = "Maintenance-Reporting" . $timestamp . ".xlsx";
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
