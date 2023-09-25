<?php
namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Cars;
use App\Models\City;
use App\Models\CityBlock;
use App\Models\DailyPettyExpenseCategory;
use App\Models\DailyPettyExpenseSubCategory;
use App\Models\Designation;
use App\Models\MaintenanceCategory;
use App\Models\MaintenanceSubCategory;
use Auth;
use DB;
use Illuminate\Http\Request;

// use Auth;
class MiscController extends Controller
{

    public function citiesList(Request $request)
    {
        if (Auth::user()->can("cities_management")) {

            $citiesList = City::with('cityBranch:branch_id,city_id', 'cityBranch.Branch')->get();
            return view('misc.cities.cities_list', compact('citiesList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function addCity()
    {
        if (Auth::user()->can("add_city")) {
            $blocks = Block::where('status', '1')->get();
            return view('misc.cities.add_city', compact('blocks'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveCity(Request $request)
    {

        $city = City::create($request->all());
        // dd($city->id);
        if ($request->blocks_id != "") {
            foreach ($request->blocks_id as $key => $id) {
                $CityBlock = new CityBlock();
                $CityBlock->city_id = $city->id;
                $CityBlock->block_id = $id;
                $CityBlock->status = '1';
                $CityBlock->save();

            }
        }

        return redirect()
            ->route("cities_list")
            ->with("success", "City has been added successfully!");

    }

    public function checkCityExist(Request $request)
    {

        $city = City::where('city', $request->city)->get();
        if (count($city) > 0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        } else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }

    }

    public function viewCity($id)
    {
        if (Auth::user()->can("view_city")) {

            $city = City::where('id', $id)->first();

            $CityBlock = CityBlock::where('city_id', $id)->where('status', '1')
                ->get();
            // dd($CityBlock);

            // $CityBlock = $city->CityBlock->toArray();

            $blocks = Block::where('status', '1')->get();

            return view('misc.cities.view_city', compact('city', 'CityBlock', 'blocks'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editCity($id)
    {
        if (Auth::user()->can("edit_city")) {

            $city = City::with('CityBlock')->where('id', $id)->first();

            $CityBlock = CityBlock::where('city_id', $id)->where('status', '1')
                ->get();
            // dd($CityBlock);

            // $CityBlock = $city->CityBlock->toArray();

            $blocks = Block::where('status', '1')->get();

            return view('misc.cities.edit_city', compact('city', 'blocks', 'CityBlock'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function updateCity(Request $request)
    {

        CityBlock::where('city_id', $request->id)->delete();
        $current_city = City::where('id', $request->id)->first();
        $current_city->city = $request->city;
        $current_city->city_ar = $request->city_ar;
        $current_city->status = $request->status;
        $current_city->update();

        if ($request->blocks_id != "") {
            foreach ($request->blocks_id as $key => $id) {
                $CityBlock = new CityBlock();
                $CityBlock->city_id = $request->id;
                $CityBlock->block_id = $id;
                $CityBlock->status = '1';
                $CityBlock->save();

            }
        }

        return redirect()
            ->route("cities_list")
            ->with("success", "City has been updated successfully!");

    }

    //Delete City
    public function deleteCity(Request $request)
    {

        $del_currency = City::where('id', $request->id)->delete();
        return response()->json(['success' => 1]);
    }

    //deleted city list
    public function deletedCityList(Request $request)
    {
        if (Auth::user()->can("manage_recyle_cities_tab")) {

            $deletedCities = City::onlyTrashed()->get();
            return view('misc.cities.deleted_cities_list', compact('deletedCities'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    //Restore Deleted City
    public function restoreCity(Request $request)
    {
        $City = City::withTrashed()->find($request->id)->restore();
        return "success";
    }

    //Permanent Delete  City
    public function permanentDeleteCity(Request $request)
    {
        $City = City::onlyTrashed()->find($request->id)->forceDelete();
        return "success";
    }

    // Start Coding For Blocks............................

    public function blocksList(Request $request)
    {
        //if (Auth::user()->can("cities_management")) {

        $blocksList = Block::get();
        return view('misc.blocks.blocks_list', compact('blocksList'));
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    public function addBlocks()
    {
        // if (Auth::user()->can("add_city")) {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view('misc.blocks.add_block', compact('status'));
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    public function saveBlocks(Request $request)
    {
        // dd($request->all());
        $block = Block::create($request->all());

        return redirect()
            ->route("blocks_list")
            ->with("success", "Block has been added successfully!");

    }

    public function checkBlocksExist(Request $request)
    {

        $city = Block::where('block', $request->block)->get();
        if (count($city) > 0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        } else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }

    }

    public function viewBlocks($id)
    {
        ///   if (Auth::user()->can("view_city")) {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        $block = Block::where('id', $id)->first();
        return view('misc.blocks.view_block', compact('block', 'status'));
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    public function editBlocks($id)
    {
        // if (Auth::user()->can("edit_city")) {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        $block = Block::where('id', $id)->first();
        return view('misc.blocks.edit_block', compact('block', 'status'));
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    public function updateBlocks(Request $request)
    {
        $block = Block::where('id', $request->id)->first();
        $block->block = $request->block;

        $block->status = $request->status;
        $block->update();

        return redirect()
            ->route("blocks_list")
            ->with("success", "Block has been updated successfully!");

    }

    //Delete City
    public function deleteBlocks(Request $request)
    {

        $del_currency = Block::where('id', $request->id)->delete();
        return response()->json(['success' => 1]);
    }

    //deleted city list
    public function deletedBlocksList(Request $request)
    {
        //if (Auth::user()->can("manage_recyle_cities_tab")) {

      $deletedBlocks = Block::onlyTrashed()->get();
        return view('misc.blocks.deleted_blocks_list', compact('deletedBlocks'));
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }

    }

    //Restore Deleted City
    public function restoreBlocks(Request $request)
    {
        $Block = Block::withTrashed()->find($request->id)->restore();
        return "success";
    }

    //Permanent Delete  City
    public function permanentDeleteBlocks(Request $request)
    {
        $Block = Block::onlyTrashed()->find($request->id)->forceDelete();
        return "success";
    }

    // End Coding For Blocks...............................

    // Start Coding For CityBlocks...............................

    public function CityblocksList()
    {
        $allCityBlock = CityBlock::get();
        dd($allCityBlock);
    }

    public function importCityBlocks()
    {

        // return 'hello';
        //City::truncate();
        CityBlock::truncate();

        if (($handle = fopen(public_path() . '/cityblock.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // Logical Code ...............

                // $string_finding = strpos($data[2],'to');
                // dump($data[2]);
                // dump("Length =".strlen($data[2]));
                //  dump($string_finding);

                if (strlen($data[2]) != 0) {

                    $string_finding = strpos($data[2], 'to');
                    if ($string_finding) {
                        dump($data[1]);
                        $city_id = City::where('city', 'LIKE', '%' . trim($data[1]) . '%')->value('id');
                        if (!empty($city_id)) {
                            $blocks_with_to = trim($data[2]);
                            $block_to_form_array = explode('to', $blocks_with_to);

                            $block_to = (int) trim($block_to_form_array[0]);
                            $block_from = (int) trim($block_to_form_array[1]);

                            for ($i = $block_to; $i <= $block_from; $i++) {
                                //dd(Block::where('block',$i)->value('id'));
                                $CityBlock = new CityBlock();
                                $CityBlock->city_id = $city_id;
                                $CityBlock->block_id = Block::where('block', $i)->value('id');
                                $CityBlock->status = '1';
                                $CityBlock->save();

                            }
                        }
                        //  dump($data[1]);
                        //  dump($data[2]);
                        // dd($city_id);

                    } elseif (strlen($data[2]) == 1) {
                        // dump($data[1]);
                        // dump($data[2]);
                        $city_id = City::where('city', 'LIKE', '%' . trim($data[1]) . '%')->value('id');
                        if (!empty($city_id)) {
                            $CityBlock = new CityBlock();
                            $CityBlock->city_id = $city_id;
                            $CityBlock->block_id = Block::where('block', $data[2])->value('id');
                            $CityBlock->status = '1';
                            $CityBlock->save();
                        }

                    }

                    //dump($data[2]);
                    // dump("Length =".strlen($data[2]));
                    //dump($string_finding);

                }

                // dump($data[1]);

                //dd('yes');
                //  echo 'City => '.$data[1].' Branch => '.$data[2].'<br/>';

                // $city = City::create([
                //     'city' => $data[1],
                // ]);

                // $branch_name = rtrim($data[2]);
                // $branch_name = ltrim($branch_name);

                // $branch = Branch::where('title_en', 'LIKE', '%' . $branch_name . '%')->first();
                // if ($branch) {
                //     BranchLocality::create([
                //         'branch_id' => $branch->id,
                //         'city_id' => $city->id,
                //     ]);
                // } else {
                //     echo 'not found<br/>';
                //     echo $branch_name;
                // }

            }
            fclose($handle);

            return 'City Blocks Imported Successfully';
        }

    }

    // End Coding For CityBlocks...............................

    //For Expense Category..............

    public function ExpenseCategoryList(Request $request)
    {
        if (Auth::user()->can("petty_exp_category_management")) {

            $citiesList = DailyPettyExpenseCategory::get();
            return view('misc.expense_category.list', compact('citiesList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function addExpenseCategory()
    {
        if (Auth::user()->can("add_petty_exp_category")) {

            return view('misc.expense_category.add');
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveExpenseCategory(Request $request)
    {
        $city = DailyPettyExpenseCategory::create($request->all());

        return redirect()
            ->route("expense_category_list")
            ->with("success", "Petty Expense Category has been added successfully!");

    }

    public function updateExpenseCategory(Request $request)
    {
        $city = DailyPettyExpenseCategory::where('id', $request->id)->first()->update($request->all());

        return redirect()
            ->route("expense_category_list")
            ->with("success", "Petty Expense Category has been updated successfully!");

    }

    public function viewExpenseCategory($id)
    {
        if (Auth::user()->can("view_petty_exp_category")) {

            $city = DailyPettyExpenseCategory::where('id', $id)->first();
            return view('misc.expense_category.view', compact('city'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editExpenseCategory($id)
    {
        if (Auth::user()->can("edit_petty_exp_category")) {

            $city = DailyPettyExpenseCategory::where('id', $id)->first();
            return view('misc.expense_category.edit', compact('city'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Delete City
    public function deleteExpenseCategory(Request $request)
    {

        $del_expense_cate = DailyPettyExpenseCategory::where('id', $request->id)->first();
        $del_expense_cate->subcategories->each(function ($subcat) {
            $subcat->delete();
        });

        if ($del_expense_cate->delete()) {
            return response()->json(['success' => 1]);
        }

        // $del_currency = DailyPettyExpenseCategory::where('id',$request->id)->delete();
        // return response()->json(['success' => 1]);
    }

    //deletedList
    public function deletedExpenseCategoryList()
    {
        //  if (Auth::user()->can("manage_recyle_drivers_tab")) {

        $DailyPettyExpenseCategory = DailyPettyExpenseCategory::onlyTrashed()->get();

        return view('misc.expense_category.deleted_list', compact("DailyPettyExpenseCategory"));
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    //Restore
    public function restoreExpenseCategory(Request $request)
    {

        $del_expense_cate = DailyPettyExpenseCategory::where('id', $request->id)->onlyTrashed()->first();
        //dd($del_expense_cate->id);
        $all_del_cat = DailyPettyExpenseSubCategory::where('category_id', $del_expense_cate->id)->onlyTrashed()->get();

        $all_del_cat->each(function ($exp_cat) {
            $exp_cat->restore();
        });

        if ($del_expense_cate->restore()) {
            return "success";
        }

        // DailyPettyExpenseCategory::withTrashed()
        //     ->find($request->id)
        //     ->restore();
        // return "success";
    }

    //Permanent Delete
    public function permanentDeleteExpenseCategory(Request $request)
    {
        // DailyPettyExpenseCategory::onlyTrashed()
        //     ->find($request->id)
        //     ->forceDelete();
        // return "success";

        $del_expense_cate = DailyPettyExpenseCategory::where('id', $request->id)->onlyTrashed()->first();
        //dd($del_expense_cate->id);
        $all_del_cat = DailyPettyExpenseSubCategory::where('category_id', $del_expense_cate->id)->onlyTrashed()->get();

        $all_del_cat->each(function ($exp_cat) {
            $exp_cat->forceDelete();
        });

        if ($del_expense_cate->forceDelete()) {
            return "success";
        }

    }

    //ExpenseSubCategoryList

    public function ExpenseSubCategoryList(Request $request)
    {
        if (Auth::user()->can("petty_exp_sub_category_management")) {

            $citiesList = DailyPettyExpenseSubCategory::with('category')->get();
            //dd($citiesList);
            return view('misc.expense_sub_category.list', compact('citiesList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function addExpenseSubCategory()
    {
        if (Auth::user()->can("add_petty_exp_sub_category")) {

            $DailyPettyExpenseCategory = DailyPettyExpenseCategory::where('status', '1')->get();

            return view('misc.expense_sub_category.add', compact('DailyPettyExpenseCategory'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveExpenseSubCategory(Request $request)
    {
        $city = DailyPettyExpenseSubCategory::create($request->all());

        return redirect()
            ->route("expense_sub_category_list")
            ->with("success", "Petty Expense  Sub Category has been added successfully!");

    }

    public function updateExpenseSubCategory(Request $request)
    {

        $city = DailyPettyExpenseSubCategory::where('id', $request->id)->first()->update($request->all());

        return redirect()
            ->route("expense_sub_category_list")
            ->with("success", "Petty Expense Sub Category has been updated successfully!");

    }

    public function viewExpenseSubCategory($id)
    {
        if (Auth::user()->can("view_petty_exp_sub_category")) {
            $DailyPettyExpenseCategory = DailyPettyExpenseCategory::where('status', '1')->get();

            $city = DailyPettyExpenseSubCategory::where('id', $id)->first();
            return view('misc.expense_sub_category.view', compact('city', 'DailyPettyExpenseCategory'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editExpenseSubCategory($id)
    {
        if (Auth::user()->can("edit_petty_exp_sub_category")) {
            $DailyPettyExpenseCategory = DailyPettyExpenseCategory::where('status', '1')->get();

            $city = DailyPettyExpenseSubCategory::where('id', $id)->first();
            return view('misc.expense_sub_category.edit', compact('city', 'DailyPettyExpenseCategory'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Delete City
    public function deleteExpenseSubCategory(Request $request)
    {

        $del_currency = DailyPettyExpenseSubCategory::where('id', $request->id)->delete();
        return response()->json(['success' => 1]);
    }

    //deletedList
    public function deletedExpenseSubCategoryList()
    {
        //  if (Auth::user()->can("manage_recyle_drivers_tab")) {

        $DailyPettyExpenseSubCategory = DailyPettyExpenseSubCategory::onlyTrashed()->get();

        return view('misc.expense_sub_category.deleted_list', compact("DailyPettyExpenseSubCategory"));
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    //Restore
    public function restoreExpenseSubCategory(Request $request)
    {
        DailyPettyExpenseSubCategory::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete
    public function permanentDeleteExpenseSubCategory(Request $request)
    {
        DailyPettyExpenseSubCategory::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

    /* Maintenance Report */

    public function MaintenanceCategoryList()
    {
        if (Auth::user()->can("maintenance_report_category_management")) {
            $MaintenanceCategoryList = MaintenanceCategory::all();
            return view('misc.maintenance_category.list', compact('MaintenanceCategoryList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function addMaintenanceCategory()
    {
        if (Auth::user()->can("add_maintenance_category")) {
            return view('misc.maintenance_category.add');
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveMaintenanceCategory(Request $request)
    {

        $MaintenanceCategory = MaintenanceCategory::create($request->all());

        return redirect()
            ->route("maintenance_category_list")
            ->with("success", "Maintenance Category has been added successfully!");
    }

    public function deleteMaintenanceCategory(Request $request)
    {
        $MaintenanceCategory = MaintenanceCategory::where('id', $request->id)->delete();
        return response()->json(['success' => 1]);
    }

    public function viewMaintenanceCategory($id)
    {
        if (Auth::user()->can("view_maintenance_category")) {
            $MaintenanceCategory = MaintenanceCategory::where('id', $id)->first();
            return view('misc.maintenance_category.view', compact('MaintenanceCategory'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editMaintenanceCategory($id)
    {
        if (Auth::user()->can("edit_maintenance_category")) {
            $MaintenanceCategory = MaintenanceCategory::where('id', $id)->first();
            return view('misc.maintenance_category.edit', compact('MaintenanceCategory'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function updateMaintenanceCategory(Request $request)
    {
        $city = MaintenanceCategory::where('id', $request->id)->first()->update($request->all());

        return redirect()
            ->route("maintenance_category_list")
            ->with("success", "Maintenance Category has been updated successfully!");
    }

    //deletedList
    public function deletedMaintenanceCategoryList()
    {
        if (Auth::user()->can("manage_recyle_maintenance_category_tab")) {

            $MaintenanceCategory = MaintenanceCategory::onlyTrashed()->get();

            return view('misc.maintenance_category.deleted_list', compact("MaintenanceCategory"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Restore
    public function restoreMaintenanceCategory(Request $request)
    {
        MaintenanceCategory::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete
    public function permanentDeleteMaintenanceCategory(Request $request)
    {
        MaintenanceCategory::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

    // Maintenance Sub-Category //

    public function MaintenanceSubCategoryList()
    {

        if (Auth::user()->can("maintenance_report_sub_category_management")) {
            $MaintenanceSubCategoryList = MaintenanceSubCategory::query();

            $MaintenanceSubCategoryList->with('category');

            $MaintenanceSubCategoryList->wherehas('category', function ($query) {
                $query->where('status', 1);
            });

            $MaintenanceSubCategoryList = $MaintenanceSubCategoryList->get();

            return view('misc.maintenance_sub_category.list', compact('MaintenanceSubCategoryList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function addMaintenanceSubCategory()
    {
        if (Auth::user()->can("add_maintenance_sub_category")) {
            $MaintenanceCategoryList = MaintenanceCategory::where('status', 1)->get();
            return view('misc.maintenance_sub_category.add', compact('MaintenanceCategoryList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function checkMaintenanceSubCategoryExist(Request $request)
    {

        $maintenance_sub_category = MaintenanceSubCategory::where(['sub_cat_name' => $request->sub_cat_name, 'cat_id' => $request->cat_id, 'status' => 1])->first();

        if ($maintenance_sub_category != null) {
            return json_encode(['msg' => 1]);
        } else {
            return json_encode(['msg' => 0]);
        }
    }

    public function saveMaintenanceSubCategory(Request $request)
    {

        $MaintenanceCategory = MaintenanceSubCategory::create($request->all());

        return redirect()
            ->route("maintenance_sub_category_list")
            ->with("success", "Maintenance Sub Category has been added successfully!");
    }

    public function deleteMaintenanceSubCategory(Request $request)
    {
        $MaintenanceSubCategory = MaintenanceSubCategory::where('id', $request->id)->delete();
        return response()->json(['success' => 1]);
    }

    public function viewMaintenanceSubCategory($id)
    {
        if (Auth::user()->can("view_maintenance_sub_category")) {
            $MaintenanceSubCategory = MaintenanceSubCategory::where('id', $id)->first();
            return view('misc.maintenance_sub_category.view', compact('MaintenanceSubCategory'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editMaintenanceSubCategory($id)
    {
        if (Auth::user()->can("edit_maintenance_sub_category")) {
            $MaintenanceCategory = MaintenanceCategory::where('status', 1)->get();
            $MaintenanceSubCategory = MaintenanceSubCategory::where('id', $id)->first();
            return view('misc.maintenance_sub_category.edit', compact('MaintenanceCategory', 'MaintenanceSubCategory'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function updateMaintenanceSubCategory(Request $request)
    {
        $MaintenanceSubCategory = MaintenanceSubCategory::where('id', $request->id)->first()->update($request->all());

        return redirect()
            ->route("maintenance_sub_category_list")
            ->with("success", "Maintenance Sub Category has been updated successfully!");

    }

    //deletedList
    public function deletedMaintenanceSubCategoryList()
    {
        if (Auth::user()->can("manage_recyle_maintenance_sub_category_tab")) {

            $MaintenanceSubCategory = MaintenanceSubCategory::onlyTrashed()->get();

            return view('misc.maintenance_sub_category.deleted_list', compact("MaintenanceSubCategory"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Restore
    public function restoreMaintenanceSubCategory(Request $request)
    {
        MaintenanceSubCategory::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete
    public function permanentDeleteMaintenanceSubCategory(Request $request)
    {
        MaintenanceSubCategory::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

    // ------Designations---------------- //

    public function designationsList()
    {
        if (Auth::user()->can("staff_designations_management")) {

            $list = Designation::orderBy('created_at', 'DESC')->get();
            return view('misc.designations.list', compact('list'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function designationsAdd()
    {
        if (Auth::user()->can("add_designations")) {
            return view('misc.designations.add');
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function designationsSave(Request $request)
    {

        $owner = new Designation();
        $owner->designation = $request->designation;
        $owner->status = 1;
        $owner->save();

        return redirect()->route('designations.list')->with(['status' => 'Designation added successfully !']);

    }

    public function designationsView($id)
    {
        if (Auth::user()->can("view_designations")) {

            $designation = Designation::where('id', $id)->first();
            return view('misc.designations.view', compact('designation'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function designationsEdit($id)
    {
        if (Auth::user()->can("edit_designations")) {
            $designations = Designation::where('id', $id)->first();
            return view('misc.designations.edit', compact('designations'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function designationsUpdate(Request $request)
    {
        $designation = Designation::where('id', $request->id)->first();
        $designation->designation = $request->designation;
        $designation->status = $request->status;
        $designation->update();

        return redirect()->route('designations.list')->with(['status' => 'Designation has been updated successfully !']);
    }

    public function designationsDelete(Request $request)
    {
        $designation = Designation::where('id', $request->id)->first();
        if ($designation) {
            $designation->delete();
            return response()->json(['success' => 1]);

        } else {
            return response()->json(['success' => 0]);

        }
    }

    //checkDesignationsExist

    public function checkDesignationsExist(Request $request)
    {

        $designation = Designation::where('designation', $request->designation)->get();
        if (count($designation) > 0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        } else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }

    }

    //deletedList
    public function deletedDesignationsList()
    {
        if (Auth::user()->can("manage_recyle_designations_tab")) {

            $Designation = Designation::onlyTrashed()->get();

            return view('misc.designations.deleted_list', compact("Designation"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Restore
    public function restoreDesignations(Request $request)
    {
        Designation::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete
    public function permanentDeleteDesignations(Request $request)
    {
        Designation::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

    //-----End Designations ---------------//

    //  Expiry Date For Car //

    // public function mail_send()
    // {

    //     $data = array('name' => "Ashutosh Sir");

    //     \Mail::send(['html' => 'mail'], $data, function ($message) {
    //         $message->to('mayank_thakur@rvtechnologies.com', 'Mayank Thakur')->subject
    //             ('Testing Mail');
    //         $message->from('ashutosh@rvtechnologies.com', 'Ashutosh Singh');
    //     });

    // }

    public function mail_sends()
    {

        $all_cars = Cars::with('owner:id,ownership_name', 'driver:id,drivers_name', 'carBranch:car_id,branch_id', 'carBranch.Branch')->orderBy('expiry_date', 'ASC')->get();
        $one_month_back = "";
        $_15_days_back = "";
        foreach ($all_cars as $car) {
            $strtotime = strtotime($car->expiry_date);
            $one_month_back = date("Y-m-d", strtotime("-1 month", $strtotime));
            $_15_days_back = date("Y-m-d", strtotime("-15 day", $strtotime));
            // dump($car->expiry_date);
            // dump($one_month_back);
            // dd($_15_days_back);
            $current_month_day = date("Y-m-d");

            if ($one_month_back <= $current_month_day) {

                //For One Months Before Expiry
                if ($car->expiry_before_one_months == 0) {

                    $data = array('car_details' => $car);

                    \Mail::send(['html' => 'mail'], $data, function ($message) {
                        $message->to('mithilesh_kumar@rvtechnologies.com', 'Mayank Thakur')->subject
                            ('Testing Mail');
                        $message->from('mithileshkumar6649@gmail.com', 'Ashutosh Singh');
                    });

                    $car->expiry_before_one_months = 1;
                    $car->update();

                    // dump('yes one months');
                } else {

                    //For 15 Days  Before Expiry
                    if ($_15_days_back <= $current_month_day) {

                        if ($car->expiry_before_15_days == 0) {

                            $data = array('car_details' => $car);

                            \Mail::send(['html' => 'mail'], $data, function ($message) {
                                $message->to('mithilesh_kumar@rvtechnologies.com', 'Mayank Thakur')->subject
                                    ('Testing Mail');
                                $message->from('mithileshkumar6649@gmail.com', 'Ashutosh Singh');
                            });

                            $car->expiry_before_15_days = 1;
                            $car->update();
                        }

                    }

                    // $data = array('car_details' => $car);

                    // \Mail::send(['html' => 'mail'], $data, function ($message) {
                    //     $message->to('mithilesh_kumar@rvtechnologies.com', 'Mayank Thakur')->subject
                    //         ('Testing Mail');
                    //     $message->from('mithileshkumar6649@gmail.com', 'Ashutosh Singh');
                    // });

                    //dd($car);

                }
            }

        }

    }

    //  --------------- //
}
