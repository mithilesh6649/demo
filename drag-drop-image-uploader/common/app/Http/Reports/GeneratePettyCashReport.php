<?php

namespace App\Http\Reports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use \App\Models\DailyPettyExpenseCategory;
use \App\Models\DailyPettyExpenseSubCategory;
use \App\Models\DailyPettyExpense;
use \App\Models\Branch;

class GeneratePettyCashReport
{
    public function result()
    {
        $spreadsheet = new Spreadsheet();
        /* Add some data */
        $spreadsheet->setActiveSheetIndex(0);
        /* Rename worksheet */
        $by_month_tab = $spreadsheet->getActiveSheet()->setTitle("By Month ");
        /* set default value */
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
            // Set some data to 'Column A - D' of 'Row 5'
            //$spreadsheet->setCellValue($letter . '5', 'Column ' . $letter);
            $spreadsheet
                ->getActiveSheet()
                ->getRowDimension($letter)
                ->setRowHeight(35);
        }
        //Heading.............
        $spreadsheet
            ->getActiveSheet()
            ->setCellValue(
                "A1",
                "MUGHAL MAHAL ALL RESTAURANT PETTY CASH EXPENSES F/Y ".date('Y')
            );
        //increase width
        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("1")
            ->setRowHeight(35);
        //Merge Heading
        $spreadsheet->getActiveSheet()->mergeCells("A1:AG1");
        //Set Font size
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1")
            ->getFont()
            ->setSize(20);
        //Set Cell alignment center
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
        //$spreadsheet->getActiveSheet()->getStyle('A1')
        // ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("808080");

        //Heading.............

        $spreadsheet
            ->getActiveSheet()
            ->setCellValue(
                "A2",
                "YEARLY CASH EXPENSES : TYPE OF EXPENSES CATEGORY"
            );
        $spreadsheet->getActiveSheet()->setCellValue("AE2", "Total");
        //Merge Heading
        $spreadsheet->getActiveSheet()->mergeCells("A2:AD2");
        //Set Font size
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

        //Border..................
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
		for ($m=1; $m<=12; $m++) {
			$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
			if(date('m') >= $m){
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
		foreach($categories as $category){
			foreach($category->subcategories as $subcategory){
				$categories_name[] = $subcategory->sub_cat_name;
                $last_col_1++;
			}
		}
		$rowArray = array_merge($rowArray,$categories_name);

        $spreadsheet->getActiveSheet()->fromArray(
            $rowArray, 
            null,
            "A3" 
        );
		
		$number = 5;
		foreach($months as $month){
			$expense = [];
			foreach($categories as $category){
				foreach($category->subcategories as $subcategory){
					$expense[] = $this->getExpense($subcategory,$month);
				}
			}
			$rowArrayData = $expense;

			$spreadsheet->getActiveSheet()->fromArray(
				$rowArrayData,
				null, 
				"C".$number 
			);

            $spreadsheet->getActiveSheet()->setCellValue("AE".$number, "=SUM(C".$number.":AD".$number.")");
			$number++;
		}

		$rowArray = $months_array;
        $columnArray = array_chunk($rowArray, 1);

        $spreadsheet->getActiveSheet()->fromArray(
            $columnArray,
            null, 
            "A5" 
        );

        $rowArray = $months;   //will be changed
        $columnArray = array_chunk($rowArray, 1);
        $spreadsheet->getActiveSheet()->fromArray(
            $columnArray, 
            null, 
            "B5"
        );
        
        $categories_count = DailyPettyExpenseSubCategory::all()->count();
        
        $alpha = 'C';
		for ($i=1; $i < $categories_count; $i++) { 
            $spreadsheet->getActiveSheet()->setCellValue($alpha."".$number, "=SUM(".$alpha."5:".$alpha."".$number.")");
            $alpha++;
        }

        //backgroud
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:AG3")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("c0c0c0");

        //FOR BORDER
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

        $spreadsheet->getActiveSheet()->setCellValue("A".++$end, "Total");

        foreach (range("A", "50") as $columnID) {
            //   $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
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

        //   $spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
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
        //    $spreadsheet->getActiveSheet()->getStyle('A3:AG3')->getAlignment()->setWrapText(true);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:AG3")
            ->getFont()
            ->setSize(7);

        $spreadsheet->createSheet();


		// -----------------------------******************************************-----------------------------------
		// -----------------------------------------SECOND TAB STARTS------------------------------------------------
		// -----------------------------******************************************-----------------------------------


        /* Add some data */
        $spreadsheet->setActiveSheetIndex(1)->setCellValue("A1", "BRANCH!");

        /* set default value */
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
            // Set some data to 'Column A - D' of 'Row 5'
            //$spreadsheet->setCellValue($letter . '5', 'Column ' . $letter);
            $spreadsheet
                ->getActiveSheet()
                ->getRowDimension($letter)
                ->setRowHeight(35);
        }

        //Heading.............
        $spreadsheet
            ->getActiveSheet()
            ->setCellValue(
                "A1",
                "MUGHAL MAHAL ALL RESTAURANT PETTY CASH EXPENSES F/Y ".date('Y')
            );

        //increase width
        $spreadsheet
            ->getActiveSheet()
            ->getRowDimension("1")
            ->setRowHeight(35);
        //Merge Heading
        $spreadsheet->getActiveSheet()->mergeCells("A1:AG1");
        //Set Font size
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1")
            ->getFont()
            ->setSize(20);
        //Set Cell alignment center
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
        //$spreadsheet->getActiveSheet()->getStyle('A1')
        // ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A1")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("808080");

        //B1

        //Heading.............

        $spreadsheet
            ->getActiveSheet()
            ->setCellValue(
                "A2",
                "YEARLY CASH EXPENSES : TYPE OF EXPENSES CATEGORY"
            );
            
        // added later from above 
        $spreadsheet->getActiveSheet()->setCellValue("AE2", "Total"); 
        // added later from above

        //Merge Heading
        $spreadsheet->getActiveSheet()->mergeCells("A2:AC2");

        //Set Font size
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

        //Border..................
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

        // added later as above
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
        // added later as above 

		$rowArray = [
			"Branch",
			"Statement  \n Reg Code",
		];    

		$categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();	
		$categories_name = [];

		foreach($categories as $category){
			foreach($category->subcategories as $subcategory){
				$categories_name[] = $subcategory->sub_cat_name;
			}
		}
		$rowArray = array_merge($rowArray,$categories_name);	

        $spreadsheet->getActiveSheet()->fromArray(
            $rowArray,
            null, 
            "A3" 
        );

		// ---------------
		$number = 5;
		$branches = Branch::where('status',Branch::ACTIVE)->get();
        $branch_names = [];
        $s_no = [];
		foreach($branches as $branch){
			$expense = [];
            // $branch_names[] = $branch->title_en;
            $branch_names[] = $branch->short_name;
            $s_no[] = $branch->id;
			foreach($categories as $category){
				foreach($category->subcategories as $subcategory){
					$expense[] = $this->getExpenseBranch($subcategory,$branch);
				}
			}
			$rowArrayData = $expense;

			$spreadsheet->getActiveSheet()->fromArray(
				$rowArrayData,
				null, 
				"C".$number 
			);

            $spreadsheet->getActiveSheet()->setCellValue("AE".$number, "=SUM(C".$number.":AD".$number.")");
			$number++;
		}

        $rowArray = $branch_names;
        $columnArray = array_chunk($rowArray, 1);
        $spreadsheet->getActiveSheet()->fromArray(
            $columnArray,
            null,
            "A5" 
        );

        $rowArray = $s_no;
        $columnArray = array_chunk($rowArray, 1);
        $spreadsheet->getActiveSheet()->fromArray(
            $columnArray, 
            null,
            "B5" 
        );

        $last_row = count($branch_names) + 5;
        $alpha = 'C';
        for ($i=1; $i < $categories_count; $i++) { 
            $spreadsheet->getActiveSheet()->setCellValue($alpha."".$last_row, "=SUM(".$alpha."5:".$alpha."".$last_row.")");
            $alpha++;
        }    

        // $spreadsheet->getActiveSheet()->getCell('A12')->getCalculatedValue();

        //backgroud
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:AG3")
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("c0c0c0");

        //FOR BORDER
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
        // $end = 17;
        $end = count($branch_names) + 5;

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

        $spreadsheet->getActiveSheet()->setCellValue("A".$end, "Total");

        foreach (range("A", "Z") as $columnID) {
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

        // $spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
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
        //    $spreadsheet->getActiveSheet()->getStyle('A3:AG3')->getAlignment()->setWrapText(true);
        $spreadsheet
            ->getActiveSheet()
            ->getStyle("A3:AG3")
            ->getFont()
            ->setSize(7);

        /* Rename worksheet */
        $spreadsheet->getActiveSheet()->setTitle("Branch wise");
        $spreadsheet->createSheet();

        
        // -----------------------------******************************************-----------------------------------
		// -----------------------------------------THIRD TAB STARTS------------------------------------------------
		// -----------------------------******************************************-----------------------------------

        
        // looping around branches
        
        $tab_count = 2;
        foreach($branches as $branch){
            /* Add some data */
            $spreadsheet->setActiveSheetIndex($tab_count)->setCellValue("A1", $branch->title_en);
            $tab_count++;
            /* set default value */
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
                // Set some data to 'Column A - D' of 'Row 5'
                //$spreadsheet->setCellValue($letter . '5', 'Column ' . $letter);
                $spreadsheet
                    ->getActiveSheet()
                    ->getRowDimension($letter)
                    ->setRowHeight(35);
            }

            //Heading.............
            $spreadsheet
                ->getActiveSheet()
                ->setCellValue(
                    "A1",
                    "MUGHAL MAHAL RESTAURANT SHARQ : CASH EXPENSES / "
                );

            //increase width
            $spreadsheet
                ->getActiveSheet()
                ->getRowDimension("1")
                ->setRowHeight(35);
            //Merge Heading
            $spreadsheet->getActiveSheet()->mergeCells("A1:AG1");
            //Set Font size
            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A1")
                ->getFont()
                ->setSize(20);
            //Set Cell alignment center
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
            //$spreadsheet->getActiveSheet()->getStyle('A1')
            // ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A1")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("808080");

            //B1

            //Heading.............

            $spreadsheet
                ->getActiveSheet()
                ->setCellValue(
                    "A2",
                    "DAILY CASH EXPENSES : TYPE OF EXPENSES CATEGORY"
                );

            //Merge Heading
            $spreadsheet->getActiveSheet()->mergeCells("A2:AG2");
            
            //Set Font size
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

            //Border..................
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

            $rowArray = array_merge($rowArray,$categories_name);    

            $rowArray_2 = [
                "Day Total",
                "Chq Rcd",
                "Closing Bal",
            ];

            $rowArray = array_merge($rowArray,$rowArray_2);

            $spreadsheet->getActiveSheet()->fromArray(
                $rowArray, 
                null,
                "A3"
            );

            $number = 5;
            $s_no_ = [];
            $dates = [];
            $day_counter = 0;
            $day_total_position = 'C';

            foreach($categories as $category){
                foreach($category->subcategories as $subcategory){
                    $day_total_position++;
                }
            }
            $second_to_day_total_position = --$day_total_position;

            for($i = 1; $i <=  date('t'); $i++){
                $s_no_[] = $i;
                $day_counter++;
                $dates[] =  str_pad($i, 2, '0', STR_PAD_LEFT).'-'.date('M') . "-" . date('Y');

                $expense = [];
                $current_date = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
                foreach($categories as $category){
                    foreach($category->subcategories as $subcategory){
                        $expense[] = $this->getExpenseBranchWise($subcategory,$current_date,$branch->id);
                    }
                }
                $rowArrayData = $expense;

                $spreadsheet->getActiveSheet($tab_count)->fromArray(
                    $rowArrayData,
                    null, 
                    "C".$number 
                );

                // $spreadsheet->getActiveSheet()->setCellValue("AE".$number, "=SUM(C".$number.":AD".$number.")");
                $spreadsheet->getActiveSheet()->setCellValue($day_total_position."".$number, "=SUM(C".$number.":".$second_to_day_total_position."".$number.")");
                $number++;
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

            $day_counter = $day_counter + 5;
            $alpha = 'C';
            for ($i=1; $i < $categories_count; $i++) { 
                $spreadsheet->getActiveSheet()->setCellValue($alpha."".$day_counter, "=SUM(".$alpha."5:".$alpha."".$day_counter.")");
                $alpha++;
            }
          
            // $spreadsheet->getActiveSheet()->getCell('A12')->getCalculatedValue();

            //backgroud
            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A3:AG3")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB("c0c0c0");

            //FOR BORDER
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

            for ($i = 4; $i < 36; $i++) {
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
            $spreadsheet->getActiveSheet()->setCellValue("A".$day_counter, "Total");

            foreach (range("A", "Z") as $columnID) {
                //   $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
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

            //   $spreadsheet->getActiveSheet()->getCell('A3')->setValue("Statement \n Reg Code");
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
            //    $spreadsheet->getActiveSheet()->getStyle('A3:AG3')->getAlignment()->setWrapText(true);
            $spreadsheet
                ->getActiveSheet()
                ->getStyle("A3:AG3")
                ->getFont()
                ->setSize(7);

            /* Rename worksheet */
            $spreadsheet->getActiveSheet()->setTitle($branch->title_en);
            $spreadsheet->createSheet();
        }

        // looping around branches
        
        /* Set active sheet index to the first sheet, so Excel opens this as the first sheet */
        $spreadsheet->setActiveSheetIndex(0);

        /* Add some data */
        //  $spreadsheet->setActiveSheetIndex(1);
        //   $sheets = $spreadsheet->getActiveSheet()->setTitle('By Month');

        $fileName = "Petty Cash Reporting.xlsx";
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

	// get expense
	public function getExpense($subcategory,$month){
		return DailyPettyExpense::whereMonth('created_at',$month)
            ->whereYear('created_at',date('Y'))
            ->where('category_id',$subcategory->category_id)
            ->where('sub_category_id',$subcategory->id)
            ->sum('amount');
	}
	public function getExpenseBranch($subcategory,$branch){
		return DailyPettyExpense::where('branch_id',$branch->id)
            ->where('category_id',$subcategory->category_id)
            ->where('sub_category_id',$subcategory->id)
            ->sum('amount');
	}

    public function getExpenseBranchWise($subcategory,$current_date,$branch_id){
        return DailyPettyExpense::where('branch_id',$branch_id)
            ->where('category_id',$subcategory->category_id)
            ->where('sub_category_id',$subcategory->id)
            ->where('created_at','LIKE',$current_date.'%')
            ->sum('amount');
    }
	// get expense
}
