<?php
namespace App\Http\Reports;

use App\Models\DailySaleReport;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\CreditDebitCommission;

class GenerateCreditCardDailyReport
{
    public $branch_id;
    public $date_range;

    public function __construct($branch_id, $date_range)
    {
        $this->branch_id = base64_decode($branch_id);
        $this->date_range = base64_decode($date_range);
    }

    public function report()
    { 

        $date_range = explode(",", $this->date_range);

        $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $date_range[0])));
        $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $date_range[1])));

        $data = DailySaleReport::where(['branch_id' => $this->branch_id])
            ->where('report_date', '>=', $start_date)
            ->where('report_date', '<=', $end_date)
            ->where(function ($q) {
                return $q->whereNotNull('amex')
                    ->orWhereNotNull('visa')
                    ->orWhereNotNull('master')
                    ->orWhereNotNull('dinner')
                    ->orWhereNotNull('knet')
                    ->orWhereNotNull('mm_online_link');
            })
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->report_date)->format('Y-m-d');
            });

        $count_data = count($data);

        $spreadsheet = new Spreadsheet();

        // Styling Heading //

        $styleArray_heading = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'name' => 'Calibri',
            ));

        $spreadsheet->getActiveSheet()->getStyle('A1:W1')->applyFromArray($styleArray_heading);
        $spreadsheet->getActiveSheet()->getStyle('A2:W2')->applyFromArray($styleArray_heading);

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

        $spreadsheet
            ->setActiveSheetIndex(0)
            ->mergeCells("A1:Q1")
            ->setCellValue(
                "A1",
                "MUGHAL MAHAL  Yearly Sales Report -Credit Card FY-" . date("Y")
            )
            ->getStyle("A1:N1")
            ->getFont()
            ->setSize(16)
            ->setBold(true);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A" . ($count_data + 9) . ":W" . ($count_data + 9))
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A" . ($count_data + 10) . ":W" . ($count_data + 10))
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        for ($i = 4; $i <= ($count_data + 10); $i++) {
            $oclbd = "A" . $i . ":W" . $i;
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($oclbd)
                ->getBorders()
                ->getRight()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
                )
                ->setColor(new Color("000000"));
        }

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A" . ($count_data + 11) . ":F" . ($count_data + 11))
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("F" . ($count_data + 11))
            ->getBorders()
            ->getRight()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        for ($i = ($count_data + 11); $i <= ($count_data + 15); $i++) {
            $bord_N = "N" . $i;
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($bord_N)
                ->getBorders()
                ->getRight()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
                )
                ->setColor(new Color("000000"));

            $bord_G = "G" . $i;
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($bord_G)
                ->getBorders()
                ->getRight()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
                )
                ->setColor(new Color("000000"));
        }

        for ($i = ($count_data + 16); $i <= ($count_data + 17); $i++) {
            $bord_HN = "H" . $i . ":N" . $i;
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($bord_HN)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
                )
                ->setColor(new Color("000000"));
        }

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2:W2")
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("W1:W3")
            ->getBorders()
            ->getRight()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A" . ($count_data + 18) . ":N" . ($count_data + 18))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1:W" . ($count_data + 33))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 11) . ":W" . ($count_data + 11))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 12) . ":U" . ($count_data + 15))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 13) . ":U" . ($count_data + 13))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("U" . ($count_data + 14))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 15) . ":U" . ($count_data + 15))
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 17) . ":U" . ($count_data + 17))
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("V" . ($count_data + 13) . ":V" . ($count_data + 15))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("V" . ($count_data + 14))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A" . ($count_data + 9) . ":W" . ($count_data + 10))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2:W3")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("2")
            ->setRowHeight(20, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("36")
            ->setRowHeight(20, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("39")
            ->setRowHeight(20, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("1")
            ->setRowHeight(30, "pt");
        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("3")
            ->setRowHeight(25, "pt");
        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("38")
            ->setRowHeight(25, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );

        $spreadsheet
            ->setActiveSheetIndex(0)
            ->mergeCells("R1:W1")
            ->setCellValue(
                "R1",
                "Branch: " .
                \App\Models\Branch::find($this->branch_id)["short_name"]
            )
            ->getStyle("R1:W1")
            ->getFont()
            ->setSize(16)
            ->setBold(true);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("R1")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A2:U2")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("B2:T2")
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("C2:W2")
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A" . ($count_data + 10) . ":W" . ($count_data + 10))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A" . ($count_data + 11) . ":W" . ($count_data + 11))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("U4:U" . ($count_data + 7))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 14) . ":U" . ($count_data + 14))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("V" . ($count_data + 15))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);

        $spreadsheet
            ->getActiveSheet()
            ->getColumnDimension("C")
            ->setWidth(17);

        foreach (range("D", "W") as $columnID) {
            $spreadsheet
                ->getActiveSheet()
                ->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $spreadsheet
            ->getActiveSheet()
            ->getColumnDimension("B")
            ->setWidth(15);

        $daily = $spreadsheet->getActiveSheet()->setTitle("Branch Daily");

        $daily->mergeCells("A2:B2")->setCellValue("A2", "A");
        $daily->mergeCells("C2:E2")->setCellValue("C2", "CC AMEX ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::amex));
        $daily->mergeCells("F2:H2")->setCellValue("F2", "CC VISA ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::visa));
        $daily->mergeCells("I2:K2")->setCellValue("I2", "CC MSTER ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::master_card));
        $daily->mergeCells("L2:N2")->setCellValue("L2", "CC DINERS ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::diner));
        $daily->mergeCells("O2:Q2")->setCellValue("O2", "PAYMENT GTY ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::payment_getway));
        $daily->mergeCells("R2:T2")->setCellValue("R2", "DR KNET ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::k_net));
        $daily->mergeCells("U2:W2")->setCellValue("U2", "MONTH TOTAL");

        /**
         * Creating a third row in a first tab
         */

        $daily->setCellValue("A3", "S.NO");
        $daily->setCellValue("B3", "DATE");
        $daily->setCellValue("C3", "Inv Day TTL");
        $daily->setCellValue("D3", "comm");
        $daily->setCellValue("E3", "After Com TTL");
        $daily->setCellValue("F3", "Inv Day TTL");
        $daily->setCellValue("G3", "comm");
        $daily->setCellValue("H3", "After Com TTL");
        $daily->setCellValue("I3", "Inv Day TTL");
        $daily->setCellValue("J3", "comm");
        $daily->setCellValue("K3", "After Com TTL");
        $daily->setCellValue("L3", "Inv Day TTL");
        $daily->setCellValue("M3", "comm");
        $daily->setCellValue("N3", "After Com TTL");
        $daily->setCellValue("O3", "Inv Day TTL");
        $daily->setCellValue("P3", "comm");
        $daily->setCellValue("Q3", "After Com TTL");
        $daily->setCellValue("R3", "Inv Day TTL");
        $daily->setCellValue("S3", "comm");
        $daily->setCellValue("T3", "After Com TTL");
        $daily->setCellValue("U3", "Inv Day TTL");
        $daily->setCellValue("V3", "COMM");
        $daily->setCellValue("W3", "After Com TTL");

        // $aDates = [];
        // $oStart = new DateTime("2022-01-01");
        // $oEnd = clone $oStart;
        // $oEnd->add(new DateInterval("P1M"));

        // while ($oStart->getTimestamp() < $oEnd->getTimestamp()) {
        //     $aDates[] = $oStart->format("d-M-Y");
        //     $oStart->add(new DateInterval("P1D"));
        // }

        // $dates = [];
        // if ($this->date_range) {
        //     $date_range = explode(",", $this->date_range);
        //     $start_date = date(
        //         "Y-m-d",
        //         strtotime(str_replace("/", "-", $date_range[0]))
        //     );
        //     $end_date = date(
        //         "Y-m-d",
        //         strtotime(str_replace("/", "-", $date_range[1]))
        //     );

        //     if (is_string($start_date) === true) {
        //         $start_date = strtotime($start_date);
        //     }
        //     if (is_string($end_date) === true) {
        //         $end_date = strtotime($end_date);
        //     }
        //     if ($start_date > $end_date) {
        //         return createDateRangeArray($end_date, $start_date);
        //     }
        //     do {
        //         $dates[] = date("Y-m-d", $start_date);
        //         $start_date = strtotime("+ 1 day", $start_date);
        //     } while ($start_date <= $end_date);
        // } else {
        //     for ($i = 1; $i <= date("t"); $i++) {
        //         $dates[] =
        //             date("Y") .
        //             "-" .
        //             date("m") .
        //             "-" .
        //             str_pad($i, 2, "0", STR_PAD_LEFT);
        //     }
        // }

        $column_count = 4;
        $counter = 1;
        foreach ($data as $key => $date) {
            $current_date = date("d-M-Y", strtotime($key));

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("A" . $column_count, $counter);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("B" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("B" . $column_count, $current_date);

            $amount = $this->getReportVal($this->branch_id, $key, \App\Models\DailySaleReport::AMEX);
            //$d_discount = ((double) $amount * 1.85) / 100;

            $d_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::amex))/100;

            $final_amount = $amount - $d_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("C" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("C" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("D" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("D" . $column_count, $d_discount == 0 ? '-' : $d_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("E" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("E" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($this->branch_id, $key, \App\Models\DailySaleReport::VISA);
            $g_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::visa))/100;
            $final_amount = $amount - $g_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("F" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("F" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("G" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("G" . $column_count, $g_discount == 0 ? '-' : $g_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("H" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("H" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($this->branch_id, $key, \App\Models\DailySaleReport::MASTER);
            $j_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::master_card))/100;
            $final_amount = $amount - $j_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("I" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("I" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("J" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("J" . $column_count, $j_discount == 0 ? '-' : $j_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("K" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("K" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($this->branch_id, $key, \App\Models\DailySaleReport::DINNER);
            $m_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::diner))/100;
            $final_amount = $amount - $m_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("L" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("L" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("M" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("M" . $column_count, $m_discount == 0 ? '-' : $m_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("N" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("N" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal(
                $this->branch_id,
                $key,
                \App\Models\DailySaleReport::PAYMENT_GATEWAY
            );
            $p_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::payment_getway))/100;
            $final_amount = $amount - $p_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("O" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("O" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("P" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("P" . $column_count, $p_discount == 0 ? '-' : $p_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("Q" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("Q" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($this->branch_id, $key, \App\Models\DailySaleReport::KNET);
            $s_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::k_net))/100;
            $final_amount = $amount - $s_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("R" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("R" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("S" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("S" . $column_count, $s_discount == 0 ? '-' : $s_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("T" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("T" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal(
                $this->branch_id,
                $key,
                \App\Models\DailySaleReport::MONTH_TOTAL
            );

          $v_discount = $this->GetdiscountReportVal(
                $this->branch_id,
                $key,
                \App\Models\DailySaleReport::MONTH_TOTAL
            );
                        
            $final_amount = $amount-$v_discount;
            $a = $amount;
            $final_discount = $v_discount;
            $f_f_amount = $a - $final_discount;

            //  ------------------ //

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("U" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("U" . $column_count, ($amount == 0 ? '-' : $amount));

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("V" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("V" . $column_count, $final_discount == 0 ? '-' : $final_amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("W" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue("W" . $column_count, $f_f_amount == 0 ? '-' : $f_f_amount);

            $column_count++;
            $counter++;
        }

        $daily->mergeCells("A" . ($count_data + 9) . ":B" . ($count_data + 9))->setCellValue("A" . ($count_data + 9), "TTL Bef Vs Aft");
        $daily->mergeCells("A" . ($count_data + 10) . ":B" . ($count_data + 10))->setCellValue("A" . ($count_data + 10), "Comm TTL");

        $daily->setCellValue("W3", "After Com TTL");
        $daily->setCellValue("V" . ($count_data + 10), "=SUM(V" . ($count_data + 9) . ":V" . ($count_data + 9) . ")");
        $daily->setCellValue("T" . ($count_data + 10), "=SUM(S" . ($count_data + 9) . ":S" . ($count_data + 9) . ")");
        $daily->setCellValue("Q" . ($count_data + 10), "=SUM(P" . ($count_data + 9) . ":P" . ($count_data + 9) . ")");
        $daily->setCellValue("N" . ($count_data + 10), "=SUM(M" . ($count_data + 9) . ":M" . ($count_data + 9) . ")");
        $daily->setCellValue("K" . ($count_data + 10), "=SUM(J" . ($count_data + 9) . ":J" . ($count_data + 9) . ")");
        $daily->setCellValue("H" . ($count_data + 10), "=SUM(H" . ($count_data + 9) . ":H" . ($count_data + 9) . ")");
        $daily->setCellValue("E" . ($count_data + 10), "=SUM(D" . ($count_data + 9) . ":D" . ($count_data + 9) . ")");

        foreach (range("C", "W") as $columnID) {
            $col = $columnID . ($count_data + 9);
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $daily->setCellValue(
                $col,
                "=SUM(" . $columnID . "4:" . $columnID . ($count_data + 8) . ")"
            );
        }

        $daily->setCellValue("A" . ($count_data + 11), "Details of  Cr & Dr Card ");
        $daily->setCellValue("A" . ($count_data + 12), "A) TOTAL CREDIT CARD SALES - AMEX ");
        $daily->setCellValue("A" . ($count_data + 13), "B) TOTAL CREDIT CARD SALES - VISA");
        $daily->setCellValue("A" . ($count_data + 14), "C) TOTAL CREDIT CARD SALES - MASTER");
        $daily->setCellValue("A" . ($count_data + 15), "D) TOTAL CREDIT CARD SALES - KNET");
        $daily->setCellValue("A" . ($count_data + 16), "E) TOTAL CREDIT CARD SALES - DINERS");
        $daily->setCellValue("A" . ($count_data + 17), "F) TOTAL CREDIT CARD SALES - OTHERS");
        $daily->setCellValue("F" . ($count_data + 18), "Total");
        $daily->setCellValue("I" . ($count_data + 18), "=SUM(H" . ($count_data + 12) . ":H" . ($count_data + 17) . ")");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("H" . ($count_data + 11))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $daily->mergeCells("H" . ($count_data + 11) . ":I" . ($count_data + 11))->setCellValue("H" . ($count_data + 11), "Total");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("K" . ($count_data + 11))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $daily->mergeCells("K" . ($count_data + 11) . ":L" . ($count_data + 11))->setCellValue("K" . ($count_data + 11), "Aft Comm");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("N" . ($count_data + 11))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->setCellValue("N" . ($count_data + 11), "Comm");

        // --------------------------------------------------------------
        $spreadsheet->getActiveSheet()->getStyle("H" . ($count_data + 12))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("H" . ($count_data + 12) . ":I" . ($count_data + 12))->setCellValue("H" . ($count_data + 12), "=SUM(C4:C" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("H" . ($count_data + 13))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("H" . ($count_data + 13) . ":I" . ($count_data + 13))->setCellValue("H" . ($count_data + 13), "=SUM(F4:F" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("H" . ($count_data + 14))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("H" . ($count_data + 14) . ":I" . ($count_data + 14))->setCellValue("H" . ($count_data + 14), "=SUM(I4:I" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("H" . ($count_data + 15))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("H" . ($count_data + 15) . ":I" . ($count_data + 15))->setCellValue("H" . ($count_data + 15), "=SUM(R4:R" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("H" . ($count_data + 16))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("H" . ($count_data + 16) . ":I" . ($count_data + 16))->setCellValue("H" . ($count_data + 16), "=SUM(L4:L" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("H" . ($count_data + 17))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("H" . ($count_data + 17) . ":I" . ($count_data + 17))->setCellValue("H" . ($count_data + 17), "0.000");

        $spreadsheet->getActiveSheet()->getStyle("K" . ($count_data + 12))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("K" . ($count_data + 12) . ":L" . ($count_data + 12))->setCellValue("K" . ($count_data + 12), "=SUM(D4:D" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("K" . ($count_data + 13))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("K" . ($count_data + 13) . ":L" . ($count_data + 13))->setCellValue("K" . ($count_data + 13), "=SUM(G4:G" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("K" . ($count_data + 14))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("K" . ($count_data + 14) . ":L" . ($count_data + 14))->setCellValue("K" . ($count_data + 14), "=SUM(J4:J" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("K" . ($count_data + 15))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("K" . ($count_data + 15) . ":L" . ($count_data + 15))->setCellValue("K" . ($count_data + 15), "=SUM(S4:S" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("K" . ($count_data + 16))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("K" . ($count_data + 16) . ":L" . ($count_data + 16))->setCellValue("K" . ($count_data + 16), "=SUM(M4:M" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("K" . ($count_data + 17))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->mergeCells("K" . ($count_data + 17) . ":L" . ($count_data + 17))->setCellValue("K" . ($count_data + 17), "0.000");

        $spreadsheet->getActiveSheet()->getStyle("N" . ($count_data + 12))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->setCellValue("N" . ($count_data + 12), "=SUM(E4:E" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("N" . ($count_data + 13))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->setCellValue("N" . ($count_data + 13), "=SUM(I4:I" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("N" . ($count_data + 14))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->setCellValue("N" . ($count_data + 14), "=SUM(K4:K" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("N" . ($count_data + 15))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->setCellValue("N" . ($count_data + 15), "=SUM(T4:T" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("N" . ($count_data + 16))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->setCellValue("N" . ($count_data + 16), "=SUM(N4:N" . ($count_data + 8) . ")");

        $spreadsheet->getActiveSheet()->getStyle("N" . ($count_data + 17))->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $daily->setCellValue("N" . ($count_data + 17), "0.000");
        // --------------------------------------------------------

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("B" . ($count_data + 22))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT
            );

        $daily->setCellValue("B" . ($count_data + 22), "Notes: ");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("B" . ($count_data + 23))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("B" . ($count_data + 24))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("B" . ($count_data + 25))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 12))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 13))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 14))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("Q" . ($count_data + 15))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );

        $daily->setCellValue("B" . ($count_data + 23), "1");
        $daily->setCellValue("B" . ($count_data + 24), "2");
        $daily->setCellValue("B" . ($count_data + 25), "3");
        $daily->setCellValue("B" . ($count_data + 26), "4");
        $daily->setCellValue("B" . ($count_data + 27), "5");
        $daily->setCellValue("B" . ($count_data + 28), "6");

        $daily->setCellValue("C" . ($count_data + 23),"Amex Comminssion".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::amex)."/Per 1KWD");
        $daily->setCellValue("C" . ($count_data + 24), "Visa (Credit) Commission ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::visa)."Per 1KWD");
        $daily->setCellValue("C" . ($count_data + 25), "Master (Credit) Commission ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::master_card)."/Per 1KWD");
        $daily->setCellValue("C" . ($count_data + 26), "Dinner (Credit) Commission ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::diner)."/Per 1KWD");
        $daily->setCellValue("C" . ($count_data + 27), "K-net (Debit) Commission ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::k_net)."/Per 1KWD");
        $daily->setCellValue(
            "C" . ($count_data + 28),
            "MM Pay Commssion KWD ".CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::mm_pay_link)."/per Transaction "
        );

        $daily
            ->mergeCells("Q" . ($count_data + 11) . ":W" . ($count_data + 11))
            ->setCellValue(
                "Q" . ($count_data + 11),
                "SALES A/C GBK# 5194393  DEPOSIT/TO TRANSFER "
            );
        $daily
            ->mergeCells("Q" . ($count_data + 12) . ":U" . ($count_data + 12))
            ->setCellValue(
                "Q" . ($count_data + 12),
                "TO DEPOSIT  BY (VISA/KNET/MASTER/OTHERS) CHQ#"
            );
        $daily
            ->mergeCells("Q" . ($count_data + 13) . ":U" . ($count_data + 13))
            ->setCellValue("Q" . ($count_data + 13), "DIRECT TR FROM AMEX");
        $daily
            ->mergeCells("Q" . ($count_data + 14) . ":T" . ($count_data + 14))
            ->setCellValue("Q" . ($count_data + 14), "BANK MACHINE RENT OF GBK");
        $daily->setCellValue("U" . ($count_data + 14), "00.000");
        // $daily->mergeCells('Q42:U42');
        $daily
            ->mergeCells("Q" . ($count_data + 15) . ":U" . ($count_data + 16))
            ->setCellValue(
                "Q" . ($count_data + 15),
                "ACTUAL TRASFER IN SALE A/C AFTER RENT+COMM."
            );

        for ($i = ($count_data + 12); $i <= ($count_data + 15); $i++) {
            $col = "V" . $i;
            $merge_col = "V" . $i . ":W" . $i;
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );
            $daily->mergeCells($merge_col)->setCellValue($col, "00.000");
        }

        $format = '0.000';
        $spreadsheet->getActiveSheet()->getStyle('C4:W' . ($count_data + 18))->getNumberFormat()->setFormatCode($format);

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
        $timestamp = "-" . date('d-m-Y') . "(" . date('h-i-s-A', time()) . ")";
        $fileName = "Credit-Card-Commission-Report" . $timestamp . ".xlsx";
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

    public function getReportVal($branch_id, $date, $column)
    {
        try {
            $reports = DailySaleReport::where("branch_id", $branch_id)
                ->whereDate("report_date", $date)
                ->get();
            if ($column == \App\Models\DailySaleReport::MONTH_TOTAL) {
                $amount =
                (double) $reports->sum(DailySaleReport::AMEX) +
                (double) $reports->sum(DailySaleReport::VISA) +
                (double) $reports->sum(DailySaleReport::MASTER) +
                (double) $reports->sum(DailySaleReport::DINNER) +
                (double) $reports->sum(DailySaleReport::KNET) +
                (double) $reports->sum(DailySaleReport::PAYMENT_GATEWAY);
            } else {
                $amount = (double) $reports->sum($column);
            }
            return $amount;
        } catch (\Exception $e) {
            return 00.000;
        }
    }

    public function GetdiscountReportVal($branch_id, $date, $column)
    {
        try {
            $reports = DailySaleReport::where("branch_id", $branch_id)
                ->whereDate("report_date", $date)
                ->get();

            if ($column == \App\Models\DailySaleReport::MONTH_TOTAL) {
                $amount =
                (((double) $reports->sum(DailySaleReport::AMEX)* CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::amex))/100) +
                (((double) $reports->sum(DailySaleReport::VISA)* CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::visa))/100) +
                (((double) $reports->sum(DailySaleReport::MASTER)* CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::master_card))/100) +
                (((double) $reports->sum(DailySaleReport::DINNER)* CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::diner))/100) +
                (((double) $reports->sum(DailySaleReport::KNET)* CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::k_net))/100) +
                (((double) $reports->sum(DailySaleReport::PAYMENT_GATEWAY)* CreditDebitCommission::getcardamountcalculate($branch_id,CreditDebitCommission::payment_getway))/100);
            }

            return $amount;
        } catch (\Exception $e) {
            return 00.000;
        }
    }

}
