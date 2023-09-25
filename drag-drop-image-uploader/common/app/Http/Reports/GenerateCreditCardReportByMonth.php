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

class GenerateCreditCardReportByMonth
{
    public $month;
    public $year;

    public function __construct($month, $year)
    {
        $this->month = base64_decode($month);
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
                "MUGHAL MAHAL  Yearly Sales Report -Credit Card FY-2022"
            )
            ->getStyle("A1:N1")
            ->getFont()
            ->setSize(16)
            ->setBold(true);

        $bybranch = $spreadsheet->getActiveSheet()->setTitle("By Month");

        // $bybranch->mergeCells("A2:B2")->setCellValue("A2", "Card Type");
        // $bybranch->mergeCells("C2:E2")->setCellValue("C2", "CC AMEX 1.85%");
        // $bybranch->mergeCells("F2:H2")->setCellValue("F2", "CC VISA  1.85%");
        // $bybranch->mergeCells("I2:K2")->setCellValue("I2", "CC MSTER  1.85%");
        // $bybranch->mergeCells("L2:N2")->setCellValue("L2", "CC DINERS  1.85%");
        // $bybranch->mergeCells("O2:Q2")->setCellValue("O2", "PAYMENT GTY ");
        // $bybranch->mergeCells("R2:T2")->setCellValue("R2", "DR KNET  0.15%");
        // $bybranch->mergeCells("U2:W2")->setCellValue("U2", "MONTH TOTAL");

        $bybranch->setCellValue("A3", "S.NO");
        $bybranch->setCellValue("B3", "Branch");
        $bybranch->setCellValue("C3", "Inv Day TTL");
        $bybranch->setCellValue("D3", "comm");
        $bybranch->setCellValue("E3", "After Com TTL");
        $bybranch->setCellValue("F3", "Inv Day TTL");
        $bybranch->setCellValue("G3", "comm");
        $bybranch->setCellValue("H3", "After Com TTL");
        $bybranch->setCellValue("I3", "Inv Day TTL");
        $bybranch->setCellValue("J3", "comm");
        $bybranch->setCellValue("K3", "After Com TTL");
        $bybranch->setCellValue("L3", "Inv Day TTL");
        $bybranch->setCellValue("M3", "comm");
        $bybranch->setCellValue("N3", "After Com TTL");
        $bybranch->setCellValue("O3", "Inv Day TTL");
        $bybranch->setCellValue("P3", "comm");
        $bybranch->setCellValue("Q3", "After Com TTL");
        $bybranch->setCellValue("R3", "Inv Day TTL");
        $bybranch->setCellValue("S3", "comm");
        $bybranch->setCellValue("T3", "After Com TTL");
        $bybranch->setCellValue("U3", "Inv Day TTL");
        $bybranch->setCellValue("V3", "COMM");
        $bybranch->setCellValue("W3", "After Com TTL");

     
        $branch_name = \App\Models\Branch::where('status',\App\Models\Branch::ACTIVE)->pluck('short_name');
        for ($i = 1; $i <= count($branch_name); $i++) {
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
            $bybranch->setCellValue($col, $i);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col2)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );
            $bybranch->setCellValue($col2, $branch_name[$i - 1]);

            // $spreadsheet
            //     ->getActiveSheet()
            //     ->getStyle($col_u)
            //     ->getAlignment()
            //     ->setHorizontal(
            //         \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            //     );
            // $bybranch->setCellValue($col_u, "00.000");

            // $spreadsheet
            //     ->getActiveSheet()
            //     ->getStyle($col_v)
            //     ->getAlignment()
            //     ->setHorizontal(
            //         \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            //     );
            // $bybranch->setCellValue($col_v, "00.000");

            // $spreadsheet
            //     ->getActiveSheet()
            //     ->getStyle($col_w)
            //     ->getAlignment()
            //     ->setHorizontal(
            //         \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            //     );
            // $bybranch->setCellValue($col_w, "00.000");
        }

        $total_column_no = 5 + count($branch_name);

        // added from above
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A".$total_column_no.":W".$total_column_no)
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A".($total_column_no+1).":W".($total_column_no+1))
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        for ($i = ($total_column_no-1); $i <= ($total_column_no+1); $i++) {
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
            ->getStyle("A".($total_column_no+3).":N".($total_column_no+3))
            ->getBorders()
            ->getTop()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A".($total_column_no+3).":F".($total_column_no+3))
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("F".($total_column_no+3))
            ->getBorders()
            ->getRight()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        for ($i = ($total_column_no+3); $i <= ($total_column_no+9); $i++) {
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

        for ($i = ($total_column_no+8); $i <= ($total_column_no+9); $i++) {
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
            ->getStyle("A".($total_column_no+10).":N".($total_column_no+10))
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK
            )
            ->setColor(new Color("000000"));

        // $spreadsheet
        //     ->getActiveSheet()
        //     ->getRowDimension("2")
        //     ->setRowHeight(20, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("3")
            ->setRowHeight(30, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension(($total_column_no+3))
            ->setRowHeight(20, "pt");

        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension(($total_column_no))
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
            ->getRowDimension(($total_column_no+4))
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
            ->setCellValue("R1", date('F',strtotime($this->month)))
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
            ->getStyle("A".($total_column_no).":W".($total_column_no))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A".($total_column_no+1).":W".($total_column_no+1))
            ->getFont()
            ->getColor()
            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);

        foreach (range("B", "W") as $columnID) {
            $spreadsheet
                ->getActiveSheet()
                ->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        // added from above

        $bybranch->mergeCells("A".$total_column_no.":B".$total_column_no)->setCellValue("A".$total_column_no, "TTL Bef Vs Aft");
        $bybranch->mergeCells("A".($total_column_no+1).":B".($total_column_no+1))->setCellValue("A".($total_column_no+1), "Comm TTL");

        $bybranch->setCellValue("W3", "After Com TTL");
        // $bybranch->setCellValue("V".($total_column_no+1), "01.000");
        // $bybranch->setCellValue("T".($total_column_no+1), "02.000");
        // $bybranch->setCellValue("Q".($total_column_no+1), "03.000");
        // $bybranch->setCellValue("N".($total_column_no+1), "04.000");
        // $bybranch->setCellValue("K".($total_column_no+1), "05.000");
        // $bybranch->setCellValue("H".($total_column_no+1), "06.000");
        // $bybranch->setCellValue("E".($total_column_no+1), "07.000");

        $counter = 4;
        $branches = \App\Models\Branch::where('status',\App\Models\Branch::ACTIVE)->get();
        foreach($branches as $branch){

            $amount = $this->getReportVal($branch->id,$this->month,$this->year,\App\Models\DailySaleReport::AMEX);
            //$d_discount = ($amount * 1.85)/100;

                $d_discount=((double) $amount * CreditDebitCommission::getcardamountcalculate($branch->id,CreditDebitCommission::amex))/100;
            $final_amount = $amount - $d_discount;

            $spreadsheet->getActiveSheet()->getStyle('C'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('C'.$counter, $amount == 0 ? '-' : $amount);

            $spreadsheet->getActiveSheet()->getStyle('D'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('D'.$counter, $d_discount == 0 ? '-' : $d_discount);

            $spreadsheet->getActiveSheet()->getStyle('E'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('E'.$counter, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($branch->id,$this->month,$this->year,\App\Models\DailySaleReport::VISA);
            $g_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch->id,CreditDebitCommission::visa))/100;
            $final_amount = $amount - $g_discount;

            $spreadsheet->getActiveSheet()->getStyle('F'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('F'.$counter, $amount == 0 ? '-' : $amount);

            $spreadsheet->getActiveSheet()->getStyle('G'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('G'.$counter, $g_discount == 0 ? '-' : $g_discount);

            $spreadsheet->getActiveSheet()->getStyle('H'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('H'.$counter, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($branch->id,$this->month,$this->year,\App\Models\DailySaleReport::MASTER);
            $j_discount =((double) $amount * CreditDebitCommission::getcardamountcalculate($branch->id,CreditDebitCommission::master_card))/100;
            $final_amount = $amount - $j_discount;

            $spreadsheet->getActiveSheet()->getStyle('I'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('I'.$counter, $amount == 0 ? '-' : $amount);

            $spreadsheet->getActiveSheet()->getStyle('J'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('J'.$counter, $j_discount == 0 ? '-' : $j_discount);

            $spreadsheet->getActiveSheet()->getStyle('K'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('K'.$counter, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($branch->id,$this->month,$this->year,\App\Models\DailySaleReport::DINNER);
            $m_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch->id,CreditDebitCommission::diner))/100;
            $final_amount = $amount - $m_discount;

            $spreadsheet->getActiveSheet()->getStyle('L'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('L'.$counter, $amount == 0 ? '-' : $amount);

            $spreadsheet->getActiveSheet()->getStyle('M'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('M'.$counter, $m_discount == 0 ? '-' : $m_discount);

            $spreadsheet->getActiveSheet()->getStyle('N'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('N'.$counter, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($branch->id,$this->month,$this->year,\App\Models\DailySaleReport::PAYMENT_GATEWAY);
            $p_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch->id,CreditDebitCommission::payment_getway))/100;
            $final_amount = $amount - $p_discount;

            $spreadsheet->getActiveSheet()->getStyle('O'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('O'.$counter, $amount == 0 ? '-' : $amount);

            $spreadsheet->getActiveSheet()->getStyle('P'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('P'.$counter, $p_discount == 0 ? '-' : $p_discount);

            $spreadsheet->getActiveSheet()->getStyle('Q'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('Q'.$counter, $final_amount == 0 ? '-' : $final_amount);

            $amount = $this->getReportVal($branch->id,$this->month,$this->year,\App\Models\DailySaleReport::KNET);
            $s_discount = ((double) $amount * CreditDebitCommission::getcardamountcalculate($branch->id,CreditDebitCommission::k_net))/100;
            $final_amount = $amount - $s_discount;

            $spreadsheet->getActiveSheet()->getStyle('R'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('R'.$counter, $amount == 0 ? '-' : $amount);

            $spreadsheet->getActiveSheet()->getStyle('S'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('S'.$counter, $s_discount == 0 ? '-' : $s_discount);

            $spreadsheet->getActiveSheet()->getStyle('T'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('T'.$counter, $final_amount == 0 ? '-' : $final_amount);
              

            $amount = $this->getReportVal($branch->id,$this->month,$this->year,\App\Models\DailySaleReport::MONTH_TOTAL);

          $v_discount = $this->GetdiscountReportVal($branch->id,$this->month,$this->year,\App\Models\DailySaleReport::MONTH_TOTAL);
                        
            $final_amount = $amount-$v_discount;
            $a = $amount;
            $final_discount = $v_discount;
            $f_f_amount = $a - $final_discount;

            $f_amount =  $amount;
            $f_comission = $v_discount;
            $f_A_amount = $f_amount - $f_comission;


            $spreadsheet->getActiveSheet()->getStyle('U'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('U'.$counter, $f_amount == 0 ? '-' : $f_amount);

            $spreadsheet->getActiveSheet()->getStyle('V'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('V'.$counter, $f_comission == 0 ? '-' : $f_comission);

            $spreadsheet->getActiveSheet()->getStyle('W'.$counter)->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue('W'.$counter, $f_A_amount == 0 ? '-' : $f_A_amount);

            $counter++;
        }

        foreach (range("C", "W") as $columnID) {
            $col = $columnID . $total_column_no;
            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue($col, "=SUM(".$columnID."4:".$columnID."".($counter-1).")");
        }

        // shifted from above
        $bybranch->setCellValue("V".($total_column_no+1), "=SUM(V".$total_column_no.":V".$total_column_no.")");
        $bybranch->setCellValue("T".($total_column_no+1), "=SUM(S".$total_column_no.":S".$total_column_no.")");
        $bybranch->setCellValue("Q".($total_column_no+1), "=SUM(P".$total_column_no.":P".$total_column_no.")");
        $bybranch->setCellValue("N".($total_column_no+1), "=SUM(M".$total_column_no.":M".$total_column_no.")");
        $bybranch->setCellValue("K".($total_column_no+1), "=SUM(J".$total_column_no.":J".$total_column_no.")");
        $bybranch->setCellValue("H".($total_column_no+1), "=SUM(G".$total_column_no.":G".$total_column_no.")");
        $bybranch->setCellValue("E".($total_column_no+1), "=SUM(D".$total_column_no.":D".$total_column_no.")");
        // shifted from above

        $bybranch->setCellValue("A".($total_column_no+3), "Details of  Cr & Dr Card ");
        $bybranch->setCellValue("A".($total_column_no+4), "A) TOTAL CREDIT CARD SALES - AMEX ");
        $bybranch->setCellValue("A".($total_column_no+5), "B) TOTAL CREDIT CARD SALES - VISA");
        $bybranch->setCellValue("A".($total_column_no+6), "C) TOTAL CREDIT CARD SALES - MASTER");
        $bybranch->setCellValue("A".($total_column_no+7), "D) TOTAL CREDIT CARD SALES - KNET");
        $bybranch->setCellValue("A".($total_column_no+8), "E) TOTAL CREDIT CARD SALES - DINERS");
        $bybranch->setCellValue("A".($total_column_no+9), "F) TOTAL CREDIT CARD SALES - OTHERS");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("H".($total_column_no+3))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $bybranch->mergeCells("H".($total_column_no+3).":I".($total_column_no+3))->setCellValue("H".($total_column_no+3), "Total");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("K".($total_column_no+3))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        $bybranch->mergeCells("K".($total_column_no+3).":L".($total_column_no+3))->setCellValue("K".($total_column_no+3), "Aft Comm");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("N".($total_column_no+3))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $bybranch->mergeCells("N".($total_column_no+3))->setCellValue("N".($total_column_no+3), "Comm");

        $spreadsheet
            ->getActiveSheet()
            ->getStyle("F".($total_column_no+10))
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        $bybranch->mergeCells("F".($total_column_no+10))->setCellValue("F".($total_column_no+10), "Total");

        for ($i = ($total_column_no+4); $i <= ($total_column_no+10); $i++) {
            $col_h = "H" . $i;
            $m_col_h = "H" . $i . ":I" . $i;

            $col_k = "K" . $i;
            $m_col_k = "K" . $i . ":L" . $i;

            $col_N = "N" . $i;

            $sum_array_H = ["","=SUM(C4:C".$counter.")","=SUM(F4:F".$counter.")","=SUM(I4:I".$counter.")","=SUM(R4:R".$counter.")","=SUM(L4:L".$counter.")","00.000","=SUM(H".($total_column_no+4).":H".($total_column_no+10).")"];

            $sum_array_N = ["","=SUM(D4:D".$counter.")","=SUM(G4:G".$counter.")","=SUM(J4:J".$counter.")","=SUM(S4:S".$counter.")","=SUM(M4:M".$counter.")","00.000","=SUM(N".($total_column_no+4).":N".($total_column_no+10).")"];

            $sum_array_K = ["","=SUM(E4:E".$counter.")","=SUM(H4:H".$counter.")","=SUM(K4:K".$counter.")","=SUM(T4:T".$counter.")","=SUM(N4:N".$counter.")","00.000","=SUM(K".($total_column_no+4).":K".($total_column_no+10).")"];

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_h)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->mergeCells($m_col_h)->setCellValue($col_h, $sum_array_H[$i-($total_column_no+3)]);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_k)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->mergeCells($m_col_k)->setCellValue($col_k, $sum_array_K[$i-($total_column_no+3)]);

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($col_N)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
                );
            $bybranch->setCellValue($col_N, $sum_array_N[$i-($total_column_no+3)]);
        }

       // $spreadsheet->getActiveSheet()->removeRow(2);

        $format = "0.000";
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("C4:W".($total_column_no+12))
            ->getNumberFormat()
            ->setFormatCode($format);

        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);
          $timestamp = "-".date('d-m-Y')."(".date('h-i-s-A',time()).")";
        $fileName = "Credit-Card-Report-By-Month".$timestamp.".xlsx";
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
