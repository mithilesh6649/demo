<?php
namespace App\Http\Reports\salesreport;

use App\Models\Branch;
use App\Models\PurchasedGiftCard;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GiftCardReport
{

    public $start;
    public $end;
    public $branch_id;

    public function __construct($branch_id, $date)
    {

        $this->start = date('Y-m-d', strtotime(str_replace('/', '-', $date[0])));

        $this->end = date('Y-m-d', strtotime(str_replace('/', '-', $date[1])));

        $this->branch_id = $branch_id;
    }

    public function result()
    {

        $spreadsheet = new Spreadsheet();

        //five tab bank deposit

        $gift_card_data = PurchasedGiftCard::where('branch_id', $this->branch_id)
            ->where('date', '>=', $this->start)
            ->where('date', '<=', $this->end)
            ->get();

        /**
         * start five Report BANK DEP
         */

        // $gift_card_data=array_intersect_key($gift_card_data,array_keys ($dailymonthdepositbank));

        $branch_name = Branch::select('short_name')->where(['status' => '1', 'id' => $this->branch_id])->first();

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('A1:F1')
            ->setCellValue('A1', "GIFT CARD REPORT")
            ->getStyle("A1:F1")
            ->getFont()
            ->setSize(20);

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('G1:H1')
            ->setCellValue('G1', "BRANCH: " . $branch_name->short_name)
            ->getStyle("G1:H1")
            ->getFont()
            ->setSize(14);

        $spreadsheet->setActiveSheetIndex(0)
            ->mergeCells('I1')
            ->setCellValue('I1', "PERIOD")
            ->getStyle("I1")
            ->getFont()
            ->setSize(14);
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
            'Card Number',
            'Date used',
            'Branch name',
            'Guest Name',
            'Guest Mobile Number',
            'POS Invoice Number',
            'POS Invoice Amount',
            'Card Amount',
        );

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

        foreach ($gift_card_data as $data) {

            $card_number = json_decode($data->card_number);

            $spreadsheet->getActiveSheet()->setCellValue("A" . $counter, $s_no);

            $card_number = implode(",", $card_number);

            $spreadsheet->getActiveSheet()->setCellValue("B" . $counter, $card_number);

            $spreadsheet->getActiveSheet()->setCellValue("C" . $counter, date('d/m/Y', strtotime($data->date)));
            $spreadsheet->getActiveSheet()->setCellValue("D" . $counter, $data->branch->short_name);
            $spreadsheet->getActiveSheet()->setCellValue("E" . $counter, $data->guest_name ?? 'N/A');
            $spreadsheet->getActiveSheet()->setCellValue("F" . $counter, $data->mobile_number ?? 'N/A');
            $spreadsheet->getActiveSheet()->setCellValue("G" . $counter, $data->pos_invoice_number ?? 'N/A');
            $spreadsheet->getActiveSheet()->setCellValue("H" . $counter, number_format($data->pos_invoice_amount, 3, '.', ''));
            $spreadsheet->getActiveSheet()->setCellValue("I" . $counter, number_format($data->card_amount, 3, '.', ''));

            $counter++;
            $s_no++;
        }

        // $BANKDEP->setCellValue('A36', "NO.DAYS SALE");

        $spreadsheet->createSheet();

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = 'Gift-Cards-Report' . $timestamp . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

}
