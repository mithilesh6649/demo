<?php
namespace App\Http\Reports;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\DailySaleReport;
use App\Models\CreditDebitCommission;

class GenerateCreditCardReportByBranch
{
    public $branch_id;
    public $year;

    public function __construct($branch_id, $year)
    {
        $this->branch_id = base64_decode($branch_id);
        $this->year = base64_decode($year);
    }

    public function report()
    {
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

        // --------------- //

        $spreadsheet
            ->setActiveSheetIndex(0)
            ->mergeCells("A1:Q1")
            ->setCellValue(
                "A1",
                "MUGHAL MAHAL  Yearly Sales Report -Credit Card FY-" .$this->year
            )
            ->getStyle("A1:N1")
            ->getFont()
            ->setSize(16)
            ->setBold(true);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A17:W17")
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A18:W18")
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        for ($i = 16; $i <= 18; $i++) {
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
            ->getStyle("A20:N20")
            ->getBorders() 
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A20:F20")
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("F20")
            ->getBorders()
            ->getRight()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        for ($i = 20; $i <= 27; $i++) {
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

        for ($i = 25; $i <= 26; $i++) {
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
            ->getStyle("A27:N27")
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("2")
            ->setRowHeight(20, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("20")
            ->setRowHeight(20, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("17")
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
            ->getRowDimension("21")
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
            ->setCellValue("R1", "Branch : ".\App\Models\Branch::find($this->branch_id)['short_name'])
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
            ->getStyle("A17:W17")
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A18:W18")
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        foreach (range("B", "W") as $columnID) {
            $spreadsheet
                ->getActiveSheet()
                ->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $bymonth = $spreadsheet->getActiveSheet()->setTitle("By Branch");

        $bymonth->mergeCells("A2:B2")->setCellValue("A2", "Card Type");
        $bymonth->mergeCells("C2:E2")->setCellValue("C2", "CC AMEX ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::amex));
        $bymonth->mergeCells("F2:H2")->setCellValue("F2", "CC VISA ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::visa));
        $bymonth->mergeCells("I2:K2")->setCellValue("I2", "CC MASTER ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::master_card));
        $bymonth->mergeCells("L2:N2")->setCellValue("L2", "CC DINERS ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::diner));
        $bymonth->mergeCells("O2:Q2")->setCellValue("O2", "PAYMENT GTY ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::payment_getway));
        // $bymonth->mergeCells("R2:T2")->setCellValue("R2", "DR KNET 0.250%");
        $bymonth->mergeCells("R2:T2")->setCellValue("R2", "DR KNET ".CreditDebitCommission::getcardamount($this->branch_id,CreditDebitCommission::k_net));
        $bymonth->mergeCells("U2:W2")->setCellValue("U2", "MONTH TOTAL");

        /**
         * Creating a third row in a first tab
         */

        $bymonth->setCellValue("A3", "S.NO");
        $bymonth->setCellValue("B3", "DATE");
        $bymonth->setCellValue("C3", "Inv Day TTL");
        $bymonth->setCellValue("D3", "comm");
        $bymonth->setCellValue("E3", "After Com TTL");
        $bymonth->setCellValue("F3", "Inv Day TTL");
        $bymonth->setCellValue("G3", "comm");
        $bymonth->setCellValue("H3", "After Com TTL");
        $bymonth->setCellValue("I3", "Inv Day TTL");
        $bymonth->setCellValue("J3", "comm");
        $bymonth->setCellValue("K3", "After Com TTL");
        $bymonth->setCellValue("L3", "Inv Day TTL");
        $bymonth->setCellValue("M3", "comm");
        $bymonth->setCellValue("N3", "After Com TTL");
        $bymonth->setCellValue("O3", "Inv Day TTL");
        $bymonth->setCellValue("P3", "comm");
        $bymonth->setCellValue("Q3", "After Com TTL");
        $bymonth->setCellValue("R3", "Inv Day TTL");
        $bymonth->setCellValue("S3", "comm");
        $bymonth->setCellValue("T3", "After Com TTL");
        $bymonth->setCellValue("U3", "Inv Day TTL");
        $bymonth->setCellValue("V3", "COMM");
        $bymonth->setCellValue("W3", "After Com TTL");

        $column_count = 4;
        $counter = 1;
        for ($i = 1; $i <= 12; $i++) {
            // my code

            $amount = $this->getReportVal(
                $this->branch_id,
                $i,
                $this->year,
                \App\Models\DailySaleReport::AMEX
            );
            $d_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::amex))/100;
            $final_amount = $amount - $d_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("C" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("C" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("D" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("D" . $column_count, $d_discount == 0 ? '-' : $d_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("E" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("E" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal(
                $this->branch_id,
                $i,
                $this->year,
                \App\Models\DailySaleReport::VISA
            );
            $g_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::visa))/100;
            $final_amount = $amount - $g_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("F" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("F" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("G" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("G" . $column_count, $g_discount == 0 ? '-' : $g_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("H" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("H" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal(
                $this->branch_id,
                $i,
                $this->year,
                \App\Models\DailySaleReport::MASTER
            );
            $j_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::master_card))/100;
            $final_amount = $amount - $j_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("I" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("I" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("J" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("J" . $column_count, $j_discount == 0 ? '-' : $j_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("K" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("K" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal(
                $this->branch_id,
                $i,
                $this->year,
                \App\Models\DailySaleReport::DINNER
            );
            $m_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::diner))/100;
            $final_amount = $amount - $m_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("L" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("L" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("M" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("M" . $column_count, $m_discount == 0 ? '-' : $m_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("N" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("N" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal(
                $this->branch_id,
                $i,
                $this->year,
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
            $bymonth->setCellValue("O" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("P" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("P" . $column_count, $p_discount == 0 ? '-' :$p_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("Q" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("Q" . $column_count, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal(
                $this->branch_id,
                $i,
                $this->year,
                \App\Models\DailySaleReport::KNET
            );
            $s_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($this->branch_id,CreditDebitCommission::k_net))/100;
            $final_amount = $amount - $s_discount;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("R" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("R" . $column_count, $amount == 0 ? '-' : $amount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("S" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("S" . $column_count, $s_discount == 0 ? '-' : $s_discount);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("T" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("T" . $column_count, $final_amount == 0 ? '-' : $final_amount);




            $amount = $this->getReportVal(
                        $this->branch_id,
                        $i,
                        $this->year,
                        \App\Models\DailySaleReport::MONTH_TOTAL
                    );

            $v_discount =$this->GetdiscountReportVal(
                        $this->branch_id,
                        $i,
                        $this->year,
                        \App\Models\DailySaleReport::MONTH_TOTAL
                    );

             $f_amount =  $amount;
             $f_comission = $v_discount;
             $f_A_amount = $f_amount - $f_comission;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("U" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("U" . $column_count, ($amount == 0 ? '-' : $amount));

            $spreadsheet
                ->getActiveSheet()
                ->getStyle("V" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("V" . $column_count, ($v_discount == 0 ? '-' : $v_discount));


            $spreadsheet
                ->getActiveSheet()
                ->getStyle("W" . $column_count)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue("W" . $column_count, $f_A_amount == 0 ? '-' : $f_A_amount);

            $column_count++;
            $counter++;

            // my code

            $col = "A" . ($i + 3);
            $col2 = "B" . ($i + 3);
            $col_u = "U" . ($i + 3);
            $col_v = "V" . ($i + 3);
            $col_w = "W" . ($i + 3);
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );
            $bymonth->setCellValue($col, $i);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col2)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );
            $bymonth->setCellValue(
                $col2,
                date("M-y", mktime(0, 0, 0, $i, 1, $this->year))
            );

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_u)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
          //  $bymonth->setCellValue($col_u, "00.000");

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_v)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
           // $bymonth->setCellValue($col_v, "00.000");

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_w)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            //$bymonth->setCellValue($col_w, "00.000");
        }

        $bymonth->mergeCells("A17:B17")->setCellValue("A17", "TTL Bef Vs Aft");
        $bymonth->mergeCells("A18:B18")->setCellValue("A18", "Comm TTL");

        $bymonth->setCellValue("W3", "After Com TTL");
        $bymonth->setCellValue("V18", "=SUM(V4:V15)");
        $bymonth->setCellValue("T18", "=SUM(S4:S15)");
        $bymonth->setCellValue("Q18", "=SUM(P4:P15)");
        $bymonth->setCellValue("N18", "=SUM(M4:M15)");
        $bymonth->setCellValue("K18", "=SUM(J4:J15)");
        $bymonth->setCellValue("H18", "=SUM(G4:G15)");
        $bymonth->setCellValue("E18", "=SUM(D4:D15)");

        foreach (range("C", "W") as $columnID) {
            $col = $columnID . "17";
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue(
                $col,
                "=SUM(" . $columnID . "4:" . $columnID . "17)"
            );
        }

        $bymonth->setCellValue("A20", "Details of  Cr & Dr Card ");
        $bymonth->setCellValue("A21", "A) TOTAL CREDIT CARD SALES - AMEX ");
        $bymonth->setCellValue("A22", "B) TOTAL CREDIT CARD SALES - VISA");
        $bymonth->setCellValue("A23", "C) TOTAL CREDIT CARD SALES - MASTER");
        $bymonth->setCellValue("A24", "D) TOTAL CREDIT CARD SALES - KNET");
        $bymonth->setCellValue("A25", "E) TOTAL CREDIT CARD SALES - DINERS");
        $bymonth->setCellValue("A26", "F) TOTAL CREDIT CARD SALES - OTHERS");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("H20")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $bymonth->mergeCells("H20:I20")->setCellValue("H20", "Total");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("K20")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $bymonth->mergeCells("K20:L20")->setCellValue("K20", "Aft Comm");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("N20")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $bymonth->mergeCells("N20")->setCellValue("N20", "Comm");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("F27")
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $bymonth->mergeCells("F27")->setCellValue("F27", "Total");

        for ($i = 21; $i <= 27; $i++) {
            $col_h = "H" . $i;
            $m_col_h = "H" . $i . ":I" . $i;

            $col_k = "K" . $i;
            $m_col_k = "K" . $i . ":L" . $i;

            $col_N = "N" . $i;

            $sum_array_H = ["","=SUM(C4:C15)","=SUM(F4:F15)","=SUM(I4:I15)","=SUM(R4:R15)","=SUM(L4:L15)","00.000","=SUM(H21:H26)"];

            $sum_array_N = ["","=SUM(D4:D15)","=SUM(G4:G15)","=SUM(J4:J15)","=SUM(S4:S15)","=SUM(M4:M15)","00.000","=SUM(N21:N26)"];

            $sum_array_K = ["","=SUM(E4:E15)","=SUM(H4:H15)","=SUM(K4:K15)","=SUM(T4:T15)","=SUM(N4:N15)","00.000","=SUM(K21:K26)"];

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_h)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->mergeCells($m_col_h)->setCellValue($col_h, $sum_array_H[$i-20]);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_k)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->mergeCells($m_col_k)->setCellValue($col_k, $sum_array_K[$i-20]);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_N)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bymonth->setCellValue($col_N, $sum_array_N[$i-20]);
        }

        $format = "0.000";
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("C4:W27")
            ->getNumberFormat()
            ->setFormatCode($format);

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
         $timestamp = "-".date('d-m-Y')."(".date('h-i-s-A',time()).")";
        $fileName = "Credit-Card-Report-By-Branch".$timestamp.".xlsx";
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

    public function getReportVal($branch_id, $month, $year, $column)
    {
        try {
            $reports = DailySaleReport::where("branch_id", $branch_id)
                ->whereMonth("report_date", $month)
                ->whereYear("report_date", $year)
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

    public function GetdiscountReportVal($branch_id, $month, $year, $column)
    {
        try {
            $reports = DailySaleReport::where("branch_id", $branch_id)
                ->whereMonth("report_date", $month)
                ->whereYear("report_date", $year)
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
