<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use App\Models\Branch;
use App\Models\BranchMenuItem;
use App\Models\Choice;
use App\Models\ChoiceGroup;
use App\Models\CurrentOffer;
use App\Models\LoyaltyItem;
use App\Models\MostSellingItem;
use App\Models\MenuCategory;
use App\Models\BranchMenuCategory;
use App\Models\MenuItem;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class MenuController extends Controller
{

    public function CurrentmenuItemImage(Request $request)
    {
        $img_name = MenuItem::where("id", $request->current_id)->pluck('thumbnail')->first();
        return $img_name;
    }

    public function Filtercategories(Request $request)
    {

        Session::put('session_cat_id', $request->category_id);
         Session::put('session_item_type', $request->item_type);

        if ($request->from == 'item_availability') {
            $filter_data = MenuItem::where("cat_id", $request->category_id)->get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'item_availability',
            ])->render();
        }

        if ($request->from == 'menu_item') {

          if($request->item_type =='all_type_item'){
            $filter_data = MenuItem::where("cat_id", $request->category_id)->get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'menu_item',
            ])->render();
          }



        if ($request->item_type == 'most_selling_item') {
             $MostSellingItemId =  MostSellingItem::get()->pluck('menu_item_id')->toArray();

            $filter_data = MenuItem::where("cat_id", $request->category_id)->whereIn("id",$MostSellingItemId)->get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'menu_item',
            ])->render();
        }



        if ($request->item_type == 'loyality_item') {
             $LoyaltyItem =  LoyaltyItem::get()->pluck('menu_item_id')->toArray();

            $filter_data = MenuItem::where("cat_id", $request->category_id)->whereIn("id",$LoyaltyItem)->get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'menu_item',
            ])->render();
        }





        }

        return json_encode(["html" => $result_view, "status" => true]);
    }


     public function FilterMenuItems(Request $request){
       // dd($request->all());
          Session::put('session_item_type', $request->type);
          if ($request->type == 'all_type_item') {

             $filter_data = MenuItem::get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'menu_item',
            ])->render();

          }

        if ($request->type == 'most_selling_item') {
             $MostSellingItemId =  MostSellingItem::get()->pluck('menu_item_id')->toArray();

            $filter_data = MenuItem::whereIn("id",$MostSellingItemId)->get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'menu_item',
            ])->render();
        }

            if ($request->type == 'loyality_item') {
          $LoyaltyItemId =  LoyaltyItem::get()->pluck('menu_item_id')->toArray();

            $filter_data = MenuItem::whereIn("id", $LoyaltyItemId)->get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'menu_item',
            ])->render();
        }

        return json_encode(["html" => $result_view, "status" => true]);



     }


    public function ResetFiltercategories(Request $request)
    {
        Session::put('session_cat_id', 'null');
        Session::put('session_item_type', 'null');

        if ($request->from == 'item_availability') {

            $filter_data = MenuItem::get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'item_availability',
            ])->render();
        }

        if ($request->from == 'menu_item') {
            $filter_data = MenuItem::get();
            $result_view = view("menu-management.items.category_partial", [
                "categoriesList" => $filter_data,
                "from" => 'menu_item',
            ])->render();
        }

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function categories()
    {

        if (Auth::user()->can("category_management")) {

            $categories = MenuCategory::with("menuItems")
              //  ->where('category_type', 'regular')
                ->orderBy("category_position", "ASC")
                ->get();

            return view("menu-management.categories.index", compact("categories"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function sortableOrder(Request $request)
    {
        if (Auth::user()->can("edit_category")) {

            foreach ($request->position as $position) {

                MenuCategory::where("id", $position["id"])->update(["category_position" => $position["position"]]);
            }

            $categories = MenuCategory::with("menuItems")
             //   ->where('category_type', 'regular')
                ->orderBy("category_position", "ASC")
                ->get();

            $cattable = view(
                "menu-management.categories.partial-cat",
                compact("categories")
            )->render();

            return response()->json([
                "status" => "success",
                "table" => $cattable,
            ]);
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function addCategory()
    {
        if (Auth::user()->can("add_category")) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
              $branches = Branch::select('id', 'title_en')->where('status', 1)->get();
            return view("menu-management.categories.add", compact('status','branches'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function saveCategory(Request $request)
    {

        $fileName = null;
        if ($request->has('thumbnail')) {
            $base64 = $request->get('thumbnail');
            if ($base64 != "") {

                $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "categories/thumbnail/";
                $folderPath = $path;

                $explodes = explode('base64,', $base64);
                $base_64 = $explodes[1];
                $extension = explode('/', $explodes[0])[1];
                $image_type = explode(';', $extension)[0];
                $image_base64 = base64_decode($base_64);
                $file = $folderPath . uniqid() . '.' . $image_type;
                // dd($file);

                file_put_contents($file, $image_base64);

                $fileName = explode($folderPath, $file)[1];

                $dataToUpdate['thumbnail'] = $fileName;
            } else {
                $fileName = '';
            }
        }

    //    $updatepostion = MenuCategory::where('category_type', 'regular')->get()->pluck('category_position', 'id');
         $updatepostion = MenuCategory::get()->pluck('category_position', 'id');

        foreach ($updatepostion as $key => $value) {
            MenuCategory::where('id', $key)->update(['category_position' => ($value + 1)]);
        }

        $categories = new MenuCategory();
        $categories->name_en = $request->name_en;
        $categories->name_ar = $request->name_ar;
        $categories->description_en = $request->description_en;
        $categories->description_ar = $request->description_ar;

        if($request->file('thumbnail'))
        {
         $fileName="category_".time().".".$request->file("thumbnail")->getClientOriginalExtension();
         $request->file('thumbnail')->move('categories/thumbnail',$fileName);
         $categories->image_name = $fileName;
        }
        $categories->image_name = $fileName;
        $categories->status = $request->status;
        $categories->category_position = 1;

        if ($categories->save()) {

             // $branches = Branch::pluck("id")->toArray();
               if (isset($request->branches)) {
                foreach ($request->branches as $key => $id) {
                    $branchmenuCategory = new BranchMenuCategory();
                    $branchmenuCategory->branch_id = $id;
                    $branchmenuCategory->menu_category_id = $categories->id;
                    $branchmenuCategory->status = 1;
                    $branchmenuCategory->save();
                }
            }

            return redirect()->route("categories")->with(["success" => "Category has been added successfully!"]);
        } else {
            return redirect()->back()->with("warning", "Something went wrong!");
        }

    }

    public function editCategory($id)
    {
        if (Auth::user()->can("edit_category")) {
            $category = MenuCategory::with('BranchMenuCategory','BranchMenuCategory.Branch')->find($id);

              $branches = Branch::select('id', 'title_en')->where('status', 1)->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view("menu-management.categories.edit", compact("category", "status","branches"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function updateCategory(Request $request)
    {


      //    //Start change order coding When Status Inactive ..........

       // if($request->status == 0){

       //  $main_pos_categories = MenuCategory::where("id", $request->category_id)->first();
       //  $toal_category = MenuCategory::count();

       //  for($m=$main_pos_categories->category_position;$m<$toal_category;$m++){
       //  // dump($m+1);
       //   // dump($m);
       //   // MenuCategory::where("category_position",$m+1)->update(["category_position" => $m]);
       //     $MenuCategoryS =  MenuCategory::where("category_position",$m+1)->first();
       //     $MenuCategoryS->category_position = $m;
       //     $MenuCategoryS->update();

       //  }
       //  //dd('dfdsf');
       //      MenuCategory::where("id",$request->category_id)->update(["category_position" => $toal_category]);

       // }
      // //End  change order coding  When Status Inactive ..........




        $categories = MenuCategory::where("id", $request->category_id)->first();
         BranchMenuCategory::where('menu_category_id', $request->category_id)->forceDelete();
        $categories->name_en = $request->name_en;
        $categories->name_ar = $request->name_ar;
        $categories->description_en = $request->description_en;
        $categories->description_ar = $request->description_ar;
        $categories->status = $request->status;
        //$categories->category_position = $request->category_position;

        $fileName = null;
        if ($request->has('thumbnail')) {
            $base64 = $request->get('thumbnail');
            if ($base64 != "") {

                $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "categories/thumbnail/";
                $folderPath = $path;

                $explodes = explode('base64,', $base64);
                $base_64 = $explodes[1];
                $extension = explode('/', $explodes[0])[1];
                $image_type = explode(';', $extension)[0];
                $image_base64 = base64_decode($base_64);
                $file = $folderPath . uniqid() . '.' . $image_type;
                // dd($file);

                file_put_contents($file, $image_base64);

                $fileName = explode($folderPath, $file)[1];

                $dataToUpdate['thumbnail'] = $fileName;

                $categories->image_name = $fileName;
            } else {
                $fileName = '';
            }
        }

        if ($request->file("thumbnail")) {
            $profile = $request->file("thumbnail");
            $fileName =rand() . time() . "." . $profile->getClientOriginalExtension();
            $profile->move("categories/thumbnail", $fileName);

            if ($categories->image_name != "") {
                if (
                    file_exists(
                        public_path() .
                            "/categories/thumbnail/" .
                            $categories->image_name
                    )
                ) {
                    unlink("categories/thumbnail/" . $categories->image_name);
                }
            }

            $categories->image_name = $fileName;
        }

        if ($categories->update()) {

            if (isset($request->branches)) {
                foreach ($request->branches as $key => $id) {
                    $branchmenuCategory = new BranchMenuCategory();
                    $branchmenuCategory->branch_id = $id;
                    $branchmenuCategory->menu_category_id = $categories->id;
                    $branchmenuCategory->status = 1;
                    $branchmenuCategory->save();
                }
            }

            return redirect()
                ->route("categories")
                ->with([
                    "success" => "Category has been Updated successfully !",
                ]);
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }
    }

    public function checkCategoryPosition(Request $request)
    {
       // $menucategory = MenuCategory::where('category_type', 'regular')->count();
         $menucategory = MenuCategory::count();

        if ($menucategory <= $request->category_position) {
            $res = 1;
            return response()->json(["msg" => $res]);
        } else {
            $res = 0;
            return response()->json(["msg" => $res]);
        }
    }

    public function viewCategory($id)
    {
        if (Auth::user()->can("view_category")) {
            $category = MenuCategory::find($id);
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view("menu-management.categories.view", compact("category", "status"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function deleteCategory(Request $request)
    {
        $deleteCategory = MenuCategory::where("id", $request->id)->each(
            function ($category) {
                MenuItem::where("cat_id", $category->id)->each(function (
                    $menuItem
                ) {
                    ChoiceGroup::where("menu_item_id", $menuItem->id)->each(
                        function ($choicegroup) {
                            Choice::where(
                                "choice_group_id",
                                $choicegroup->id
                            )->delete();
                            $choicegroup->delete();
                        }
                    );

                    BranchMenuItem::where("menu_item_id", $menuItem->id)->each(
                        function ($BranchMenuItem) {
                            $BranchMenuItem->delete();
                        }
                    );

                    $menuItem->delete();
                });


              //Delete Branch Category

             BranchMenuCategory::where('menu_category_id',$category->id)->delete();

                //start mk logic //
                $deleted_item = $category->id;
                ///   dump('deleted_item_id'.$deleted_item);
                $all_category = MenuCategory::where('category_type', 'regular')->orderBy(
                    "category_position",
                    "ASC"
                )->get();

                ///  dump($all_category);
                $final_key = "";
                foreach ($all_category as $key => $value) {
                    if ($deleted_item == $value->id) {
                        $final_key = $key;
                    }
                    // dump('key'.$key.'value_id'.$value->id);
                }
                //dd($final_key);

                for (
                    $i = (int) $final_key + 1;
                    $i < count($all_category);
                    $i++
                ) {
                    //  dump('key'.$key.'value_id'.$value->id);
                    //dump('key'.$i.'svalue_id'.$all_category[$i]->id);
                    $menuca = MenuCategory::where(
                        "id",
                        $all_category[$i]->id
                    )->first();
                    $menuca->category_position =
                    $all_category[$i]->category_position - 1;
                    $menuca->update();
                    //dump($all_category[$i]->category_position-1);
                }

                $category->category_position = null;
                $category->update();
                $category->delete();

                //END mk logic //
            }
        );

        if ($deleteCategory) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    public function deletedCategoryList()
    {

        if (Auth::user()->can("manage_recyle_menu_categories_tab")) {

            $CategoryList = MenuCategory::orderBY("id", "desc")
                ->onlyTrashed()
                ->get();

            return view(
                "menu-management.categories.deleted_categories_list",
                compact("CategoryList")
            );

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function restoreCategory(Request $request)
    {
        $deleteCategory = MenuCategory::withTrashed()
            ->where("id", $request->id)
            ->each(function ($category) {
                MenuItem::withTrashed()
                    ->where("cat_id", $category->id)
                    ->each(function ($menuItem) {
                        ChoiceGroup::withTrashed()
                            ->where("menu_item_id", $menuItem->id)
                            ->each(function ($choicegroup) {
                                Choice::withTrashed()
                                    ->where("choice_group_id", $choicegroup->id)
                                    ->restore();
                                $choicegroup->restore();
                            });

                        BranchMenuItem::withTrashed()
                            ->where("menu_item_id", $menuItem->id)
                            ->each(function ($BranchMenuItem) {
                                $BranchMenuItem->restore();
                            });

                        $menuItem->restore();
                    });
                        //Delete Branch Category

             BranchMenuCategory::where('menu_category_id',$category->id)->restore();

                $category_position = MenuCategory::where('category_type', 'regular')->count() + 1;
                $category->category_position = $category_position;
                $category->update();
                $category->restore();
            });

        return "success";
    }

    //Permanent Delete Category
    public function permanentDeleteCategory(Request $request)
    {
        $deleteCategory = MenuCategory::onlyTrashed()
            ->where("id", $request->id)
            ->each(function ($category) {
                MenuItem::onlyTrashed()
                    ->where("cat_id", $category->id)
                    ->each(function ($menuItem) {
                        ChoiceGroup::onlyTrashed()
                            ->where("menu_item_id", $menuItem->id)
                            ->each(function ($choicegroup) {
                                Choice::onlyTrashed()
                                    ->where("choice_group_id", $choicegroup->id)
                                    ->forceDelete();
                                $choicegroup->forceDelete();
                            });

                        BranchMenuItem::onlyTrashed()
                            ->where("menu_item_id", $menuItem->id)
                            ->each(function ($BranchMenuItem) {
                                $BranchMenuItem->forceDelete();
                            });

                        $menuItem->forceDelete();
                    });

                 BranchMenuCategory::where('menu_category_id',$category->id)->forceDelete();

                $category->forceDelete();
            });

        return "success";
    }

    //remove  thumbnail

    public function categoryThumbnailRemove(Request $request)
    {
        //$menu_categories = MenuCategory::where('category_type', 'regular')->where("id", $request->id)->first();
        $menu_categories = MenuCategory::where("id", $request->id)->first();
        $menu_categories->image_name = null;
        if ($menu_categories->update()) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    public function subCategories()
    {
        return view("menu-management.sub-categories.index");
    }

    public function addSubCategory()
    {
        return view("menu-management.sub-categories.add");
    }

    public function editSubCategory()
    {
        return view("menu-management.sub-categories.edit");
    }

    public function viewSubCategory()
    {
        return view("menu-management.sub-categories.view");
    }

    //Start Menu Items Coding......................

    public function menuItems()
    {
        if (Auth::user()->can("menuitem_management")) {
            //set session for category
            //  Session::put('session_cat_id', 'null');

            $menuItem = MenuItem::with("menuCategory:id,name_en,name_ar","mostselling_item","loyalty_item")->orderBy("orderedby", "ASC")->get();

            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            //dd();

            $menuCategory = MenuCategory::whereNotIn('category_type', MenuCategory::IGNORE_CAT)->where('status',1)->get();
            return view(
                "menu-management.items.index",
                compact("menuItem", "menuCategory", "status")
            );
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function changeMenuItemOrder(Request $request)
    {

        if (Auth::user()->can("edit_item")) {

            foreach ($request->position as $position) {

                MenuItem::where("id", $position["id"])->update([
                    "orderedby" => $position["position"],
                ]);
            }

            $menuItem = MenuItem::with("menuCategory:id,name_en,name_ar")
                ->orderBy("orderedby", "ASC")
                ->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            $menutable = view('menu-management.items.item-partial', compact('menuItem', 'status'))->render();

            return response()->json([
                'status' => 'success',
                'table' => $menutable,
            ]);
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function viewMenuItem($id)
    {
        if (Auth::user()->can("view_item")) {

            $menuItem = MenuItem::with(
                "menuCategory:id,name_en,name_ar",
                "ChoiceGroups",
                "ChoiceGroups.Choice"
            )
                ->where("id", $id)
                ->first();

            $current_offers = CurrentOffer::with('brachlist')->where('items_id', $id)->get();

            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $branchs = Branch::select('id', 'city_id', 'title_en')->where('status', '1')->get();

            return view("menu-management.items.view", compact("menuItem", "branchs", 'current_offers', 'offerType', 'status'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editMenuItem($id)
    {
        if (Auth::user()->can("edit_item")) {

            $menuItem = MenuItem::with(
                "menuCategory:id,name_en,name_ar",
                "ChoiceGroups",
                "ChoiceGroups.Choice",
                "mostselling_item"
            )
                ->where("id", $id)
                ->orderBy("created_at", "DESC")
                ->first();



            $menuCategories = MenuCategory::whereNotIn('category_type', MenuCategory::IGNORE_CAT)->where("status", "1")->get([
                "id",
                "name_en",
                "name_ar",
                "category_type",
            ]);

            $current_offers = CurrentOffer::with('brachlist')->where('items_id', $id)->get();

            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            $branchs = Branch::select('id', 'city_id', 'title_en')->where('status', '1')->get();

            return view(
                "menu-management.items.edit",
                compact("menuItem", "menuCategories", "current_offers", "branchs", "offerType", "status")
            );

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function updateMenuItem(Request $request)
    {

         $menuItem = MenuItem::where("id", $request->menu_item_id)->first();

        if ($request->cat_id == 'loyalty') {

            $loyalty=MenuCategory::where('category_type','loyality')->first();
            $menuItem->cat_id =$loyalty->id;
            $menuItem->item_type='loyalty';
          }else
          {
            $menuItem->cat_id =$request->cat_id;
            $menuItem->item_type='regular';
          }


        $menuItem->item_name_en = $request->item_name_en;
        $menuItem->item_name_ar = $request->item_name_ar;
        $menuItem->description_en = $request->description_en;
        $menuItem->description_ar = $request->description_ar;

        if ($request->loyalty_point) {
            $menuItem->price = $request->loyalty_point;
        } else {
            $menuItem->price = $request->price;
        }
        $menuItem->tagline = $request->tagline;
        $menuItem->status = $request->status;


        $fileName = null;
        if ($request->has('thumbnail')) {
            $base64 = $request->file('thumbnail');
            if ($base64 != "") {
                // $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "menuItem/thumbnail/";
                $folderPath = public_path('menuItem/thumbnail/');
                $fileName='mughal_mahal-'.rand().time().'.'.$base64->getClientOriginalExtension();
                if($base64->move($folderPath,$fileName))
                {
                     $menuItem->thumbnail = $fileName;
                }

            } else {
                $fileName = '';
            }
        }

        if ($menuItem->save()) {


            if ($request->loyality_item_points != null) {

                if ($request->loyalty_status == 1) {
                    $switch_status = 1;
                } else {
                    $switch_status = 0;
                }

                if (@$menuItem->loyalty_item->id) {

                    $loyality_item = LoyaltyItem::where('id', $menuItem->loyalty_item->id)->update(['loyalty_points' => $request->loyality_item_points, 'status' => $switch_status]);

                } else {
                    $loyality_item = new LoyaltyItem;
                    $loyality_item->menu_item_id = $menuItem->id;
                    $loyality_item->loyalty_points = $request->loyality_item_points;
                    $loyality_item->status = $switch_status;

                    $loyality_item->save();
                }
            }

            if(isset($request->mostselling_checkbox)){
                  MostSellingItem::where('menu_item_id',$menuItem->id)->forceDelete();
                  $MostSellingItem = new MostSellingItem;
                  $MostSellingItem->menu_item_id = $menuItem->id;
                  $MostSellingItem->save();
            }else{
                MostSellingItem::where('menu_item_id',$menuItem->id)->forceDelete();
            }

            return redirect()->route("menu.item.list")->with(["success" => "Menu Item updated successfully !"]);
        } else {

            return redirect()->back()->with("warning", "Something went wrong!");
        }
    }

    public function changeItemStatus(Request $request)
    {
        $menuItem = menuItem::where("id", $request->id)->first();
        $menuItem->status = $request->status;
        $menuItem->availabality = $request->hours;
        $menuItem->update();

        return response()->json([
            "success" => true,
            "status" => "true",
        ]);
    }

    public function addMenuItem()
    {

        if (Auth::user()->can("add_item")) {
            $menuCategories = MenuCategory::whereNotIn('category_type', MenuCategory::IGNORE_CAT)->where("status", "1")->get([
                "id",
                "name_en",
                "name_ar",
                "category_type",
            ]);
            $choicegroup = ChoiceGroup::with("Choice")
                ->where("menu_item_id", Session::get("menu_item_id"))
                ->orderBy('created_at', 'DESC')->get();
            $branchs = Branch::select('id', 'city_id', 'title_en')->where('status', '1')->get();

            $offerType = DB::table('md_dropdowns')->where('slug', 'offer_type')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view(
                "menu-management.items.add",
                compact("menuCategories", "choicegroup", "branchs", "offerType", "status")
            );

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function saveMenuItem(Request $request)
    {


        $fileName = null;
        if ($request->has('thumbnail')) {
            $base64 = $request->file('thumbnail');
            if ($base64 != "") {
                // $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "menuItem/thumbnail/";
                $folderPath = public_path('menuItem/thumbnail/');
                $fileName='mughal_mahal-'.rand().time().'.'.$base64->getClientOriginalExtension();
                if($base64->move($folderPath,$fileName))
                {
                    // $menuItem->thumbnail = $fileName;
                }

            } else {
                $fileName = '';
            }
        }

        // if ($request->has('thumbnail')) {
        //     $base64 = $request->get('thumbnail');
        //     if ($base64 != "") {

        //         $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "menuItem/thumbnail/";
        //         $folderPath = $path;

        //         $explodes = explode('base64,', $base64);
        //         $base_64 = $explodes[1];
        //         $extension = explode('/', $explodes[0])[1];
        //         $image_type = explode(';', $extension)[0];
        //         $image_base64 = base64_decode($base_64);
        //         $file = $folderPath . uniqid() . '.' . $image_type;
        //         // dd($file);

        //         file_put_contents($file, $image_base64);

        //         $fileName = explode($folderPath, $file)[1];

        //         $dataToUpdate['thumbnail'] = $fileName;
        //     } else {
        //         $fileName = '';
        //     }
        // }

        DB::beginTransaction();
        try {

            $orders = MenuItem::get()->pluck('orderedby', 'id');

            foreach ($orders as $key => $order) {
                MenuItem::where('id', $key)->update(['orderedby' => ($order + 1)]);
            }

            $menuItem = new MenuItem();

            if ($request->cat_id == 'loyalty') {

                $loyalty = MenuCategory::where('name_en', 'Loyalty')->first();
                $menuItem->cat_id = $loyalty->id;
                $menuItem->item_type = 'loyalty';
            } else {
                $menuItem->cat_id = $request->cat_id;
                $menuItem->item_type = 'regular';
            }

            $menuItem->item_name_en = $request->item_name_en;
            $menuItem->item_name_ar = $request->item_name_ar;
            $menuItem->description_en = $request->description_en;
            $menuItem->description_ar = $request->description_ar;

            if ($request->loyalty_point) {
                $menuItem->price = $request->loyalty_point;

            } else {
                $menuItem->price = $request->price;
            }

            $menuItem->thumbnail = $fileName;
            $menuItem->orderedby = 1;
            $menuItem->tagline = $request->tagline;
            $menuItem->status = $request->status;

            if ($menuItem->save()) {
                $branches = Branch::pluck("id")->toArray();
                foreach ($branches as $key => $id) {
                    $branchmenuItems = new BranchMenuItem();
                    $branchmenuItems->branch_id = $id;
                    $branchmenuItems->menu_item_id = $menuItem->id;
                    $branchmenuItems->status = 1;
                    $branchmenuItems->save();
                }

                $choicegroup = new ChoiceGroup();
                $choicegroup->menu_item_id = $menuItem->id;
                $choicegroup->name_en = "Your Choice of Taste";
                $choicegroup->name_ar = "اختيارك من الذوق";
                $choicegroup->mendatory_choice_count = "0";
                $choicegroup->total_choice_count = "4";

                if ($choicegroup->save()) {
                    $name_en = [
                        "Spicy",
                        "Non Spicy",
                        "Medium Spicy",
                        "Less Spicy",
                    ];
                    $name_ar = ["حار", "غير حار", "حار وسط", "أقل بهارات"];
                    $price = ["0", "0", "0", "0"];

                    for ($i = 0; $i < 4; $i++) {
                        Choice::create([
                            "name_en" => $name_en[$i],
                            "name_ar" => $name_ar[$i],
                            "price" => $price[$i],
                            "choice_group_id" => $choicegroup->id,
                            "imagefile" => "1656585997.png",
                        ]);
                    }
                }

                Session::put("menu_item_id", $menuItem->id);

                // Loyalty Item Save //

                if ($request->loyality_item_points != null) {

                    if ($request->loyalty_status == 1) {
                        $switch_status = 1;
                    } else {
                        $switch_status = 0;
                    }

                    $loyality_item = new LoyaltyItem;
                    $loyality_item->menu_item_id = $menuItem->id;
                    $loyality_item->loyalty_points = $request->loyality_item_points;
                    $loyality_item->status = $switch_status;
                    $loyality_item->save();

                }

                if(isset($request->mostselling_checkbox)) {

                    $MostSellingItem = new MostSellingItem;
                    $MostSellingItem->menu_item_id = $menuItem->id;
                    $MostSellingItem->save();
                }
                //  ---------- //
            }

            DB::commit();

            return redirect()
                ->route("menu.item.add.choice")
                ->with([
                    "success" =>
                    "Menu Item created Please create  choice group !",
                ]);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }
    }

    public function ChangemenuItemImages(Request $request)
    {
        //  dd($request->all());
        $fileName = null;
        if ($request->has('image_url')) {
            $base64 = $request->get('image_url');
            if ($base64 != "") {

                //$path = $_SERVER['DOCUMENT_ROOT']."/MMMission22/Super-Admin/public/menuItem/thumbnail/";

                $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "menuItem/thumbnail/";
                //  dd($path);
                $folderPath = $path;

                $explodes = explode('base64,', $base64);
                $base_64 = $explodes[1];
                $extension = explode('/', $explodes[0])[1];
                $image_type = explode(';', $extension)[0];
                $image_base64 = base64_decode($base_64);
                $file = $folderPath . uniqid() . '.' . $image_type;
                // dd($file);

                file_put_contents($file, $image_base64);

                $fileName = explode($folderPath, $file)[1];

                $dataToUpdate['thumbnail'] = $fileName;
            } else {
                $fileName = '';
            }
        }

        $menuItem = MenuItem::where("id", $request->menuItemId)->first();
        $menuItem->thumbnail = $fileName;
        $menuItem->update();

        return response()->json(['success' => true]);

    }

    public function deleteMenuItem(Request $request)
    {
        $deleteUser = MenuItem::where("id", $request->id)->delete();
        if ($deleteUser) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    public function deletedMenuItemList()
    {
        if (Auth::user()->can("manage_recyle_menu_item_tab")) {

            $itemsList = MenuItem::orderBY("id", "desc")
                ->onlyTrashed()
                ->get();

            return view(
                "menu-management.items.deleted_items_list",
                compact("itemsList")
            );

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function restoreMenuItem(Request $request)
    {
        $usersList = MenuItem::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    public function permanentDeleteMenuItem(Request $request)
    {
        $usersList = MenuItem::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

    public function saveItemsChoiceGroup(Request $request)
    {

        $choicegroup = new ChoiceGroup();
        $choicegroup->menu_item_id = Session::get("menu_item_id");
        $choicegroup->name_en = $request->name_en;
        $choicegroup->name_ar = $request->name_ar;
        $choicegroup->mendatory_choice_count = $request->mendatory_choice_count;
        $choicegroup->total_choice_count = $request->total_choice_count;
        $choicegroup->save();

        // $files = [];
        // if ($request->hasfile("imagefile")) {
        //     foreach ($request->file("imagefile") as $file) {
        //         $name =
        //             time() .
        //             rand(1, 100) .
        //             "." .
        //             $file->getClientOriginalExtension();
        //         $file->move(public_path("files"), $name);
        //         $files[] = $name;
        //     }
        // }

        //added choices of choice group
        for ($i = 0; $i < count($request->choice_name_en); $i++) {

            $checkmeni_item = MenuItem::where(['item_name_en' => $request->choice_name_en[$i], 'item_name_ar' => $request->choice_name_ar[$i]])->first();

            $addons = Addons::where(['title_en' => $request->choice_name_en[$i], 'title_ar' => $request->choice_name_ar[$i]])->first();

            if ($checkmeni_item) {
                $choice = new Choice();
                $choice->name_en = $request->choice_name_en[$i];
                $choice->name_ar = $request->choice_name_ar[$i];
                $choice->price = $request->choice_price[$i];
                $choice->choice_group_id = $choicegroup->id;
                //$choice->imagefile = $files[$i];
                $choice->type = 'regular_item';
                $choice->reference_id = $checkmeni_item->id;

                $choice->save();

            } else if ($addons) {
                $choice = new Choice();
                $choice->name_en = $request->choice_name_en[$i];
                $choice->name_ar = $request->choice_name_ar[$i];
                $choice->price = $request->choice_price[$i];
                $choice->choice_group_id = $choicegroup->id;
                //$choice->imagefile = $files[$i];
                $choice->type = 'addon';
                $choice->reference_id = $addons->id;
                $choice->save();

            } else {

                $Addons = new Addons();
                $Addons->title_en = $request->choice_name_en[$i];
                $Addons->title_ar = $request->choice_name_ar[$i];
                $Addons->price = $request->choice_price[$i];
                $Addons->save();

                $choice = new Choice();
                $choice->name_en = $request->choice_name_en[$i];
                $choice->name_ar = $request->choice_name_ar[$i];
                $choice->price = $request->choice_price[$i];
                $choice->choice_group_id = $choicegroup->id;
                $choice->save();

            }

        }

        return "success";
    }

    public function editSaveItemsChoiceGroup(Request $request)
    {

        $choicegroup = new ChoiceGroup();
        $choicegroup->menu_item_id = $request->menu_item_id;
        $choicegroup->name_en = $request->name_en;
        $choicegroup->name_ar = $request->name_ar;
        $choicegroup->mendatory_choice_count = $request->mendatory_choice_count;
        $choicegroup->total_choice_count = $request->total_choice_count;
        $choicegroup->save();

        // $files = [];
        // if ($request->hasfile("imagefile")) {
        //     foreach ($request->file("imagefile") as $file) {
        //         $name =
        //             time() .
        //             rand(1, 100) .
        //             "." .
        //             $file->getClientOriginalExtension();
        //         $file->move(public_path("files"), $name);
        //         $files[] = $name;
        //     }
        // }

        for ($i = 0; $i < count($request->choice_name_en); $i++) {

            $checkmeni_item = MenuItem::where(['item_name_en' => $request->choice_name_en[$i], 'item_name_ar' => $request->choice_name_ar[$i]])->first();

            $addons = Addons::where(['title_en' => $request->choice_name_en[$i], 'title_ar' => $request->choice_name_ar[$i]])->first();

            if ($checkmeni_item) {
                $choice = new Choice();
                $choice->name_en = $request->choice_name_en[$i];
                $choice->name_ar = $request->choice_name_ar[$i];
                $choice->price = $request->choice_price[$i];
                $choice->choice_group_id = $choicegroup->id;
                //$choice->imagefile = $files[$i];
                $choice->type = 'regular_item';
                $choice->reference_id = $checkmeni_item->id;

                $choice->save();

            } else if ($addons) {
                $choice = new Choice();
                $choice->name_en = $request->choice_name_en[$i];
                $choice->name_ar = $request->choice_name_ar[$i];
                $choice->price = $request->choice_price[$i];
                $choice->choice_group_id = $choicegroup->id;
                //$choice->imagefile = $files[$i];
                $choice->type = 'addon';
                $choice->reference_id = $addons->id;
                $choice->save();

            } else {

                $Addons = new Addons();
                $Addons->title_en = $request->choice_name_en[$i];
                $Addons->title_ar = $request->choice_name_ar[$i];
                $Addons->price = $request->choice_price[$i];
                $Addons->save();

                $choice = new Choice();
                $choice->name_en = $request->choice_name_en[$i];
                $choice->name_ar = $request->choice_name_ar[$i];
                $choice->price = $request->choice_price[$i];
                $choice->choice_group_id = $choicegroup->id;
                //$choice->imagefile = $files[$i];
                $choice->save();

            }

        }

        return "success";

    }

    public function getItemsChoiceGroupChoices(Request $request)
    {
        $current_choices = Choice::where(
            "choice_group_id",
            $request->id
        )->get();
        $group = ChoiceGroup::where("id", $request->id)->first();
        return response()->json([
            "success" => true,
            "group" => $group,
            "ct" => $current_choices,
        ]);
    }

    public function addUpdateItemsChoiceGroup(Request $request)
    {

        $choicegroups = ChoiceGroup::where(
            "id",
            $request->choice_group_id
        )->first();
        $choicegroups->name_en = $request->name_en;
        $choicegroups->name_ar = $request->name_ar;
        $choicegroups->mendatory_choice_count =
        $request->mendatory_choice_count;
        $choicegroups->total_choice_count = $request->total_choice_count;
        $choicegroups->save();

        // update choicegroup and choice
        $files = [];
        if ($request->hasfile("imagefile")) {
            foreach ($request->file("imagefile") as $key => $file) {
                $name =
                "edit" .
                time() .
                rand(1, 100) .
                "." .
                $file->getClientOriginalExtension();
                $file->move(public_path("files"), $name);
                $files[$key] = $name;
            }
        }

        for ($i = 0; $i < count($request->choiceid); $i++) {
            $choice = Choice::where("id", $request->choiceid[$i])->first();
            $choice->name_en = $request->choice_name_en[$i];
            $choice->name_ar = $request->choice_name_ar[$i];
            $choice->price = $request->choice_price[$i];
            foreach ($files as $key => $value) {
                if ($i == $key) {
                    $choice->imagefile = $files[$key];
                }
            }

            $choice->save();
        }

        $newfiles = [];
        if ($request->hasfile("editimagefile")) {
            foreach ($request->file("editimagefile") as $key => $file) {
                $name =
                "new" .
                time() .
                rand(1, 100) .
                "." .
                $file->getClientOriginalExtension();
                $file->move(public_path("files"), $name);
                $newfiles[$key] = $name;
            }
        }

        if ($request->editchoice_name_en != "") {
            for ($i = 0; $i < count($request->editchoice_name_en); $i++) {

                $checkmeni_item = MenuItem::where(['item_name_en' => $request->editchoice_name_en[$i], 'item_name_ar' => $request->editchoice_name_ar[$i]])->first();

                $addons = Addons::where(['title_en' => $request->editchoice_name_en[$i], 'title_ar' => $request->editchoice_name_ar[$i]])->first();

                if ($checkmeni_item) {
                    $choice = new Choice();
                    $choice->name_en = $request->editchoice_name_en[$i];
                    $choice->name_ar = $request->editchoice_name_ar[$i];
                    $choice->price = $request->editchoice_price[$i];
                    $choice->choice_group_id = $request->choice_group_id;
                    //$choice->imagefile = $files[$i];
                    $choice->type = 'regular_item';
                    $choice->reference_id = $checkmeni_item->id;

                    $choice->save();

                } else if ($addons) {
                    $choice = new Choice();
                    $choice->name_en = $request->editchoice_name_en[$i];
                    $choice->name_ar = $request->editchoice_name_ar[$i];
                    $choice->price = $request->editchoice_price[$i];
                    $choice->choice_group_id = $request->choice_group_id;
                    //$choice->imagefile = $files[$i];
                    $choice->type = 'addon';
                    $choice->reference_id = $addons->id;
                    $choice->save();

                } else {

                    $Addons = new Addons();
                    $Addons->title_en = $request->editchoice_name_en[$i];
                    $Addons->title_ar = $request->editchoice_name_ar[$i];
                    $Addons->price = $request->editchoice_price[$i];
                    $Addons->save();

                    $choice = new Choice();
                    $choice->name_en = $request->editchoice_name_en[$i];
                    $choice->name_ar = $request->editchoice_name_ar[$i];
                    $choice->price = $request->editchoice_price[$i];
                    $choice->choice_group_id = $request->choice_group_id;
                    // foreach ($newfiles as $key => $value) {
                    //     if ($i == $key) {
                    //         $choice->imagefile = $newfiles[$key];
                    //     }
                    // }
                    $choice->save();
                }
            }
        }

        $choicegroup = ChoiceGroup::with("Choice")
            ->where("menu_item_id", $choicegroups->menu_item_id)
            ->orderBy("created_at", "DESC")
            ->get();

        $table = view(
            "menu-management.items.add_partial",
            compact("choicegroup")
        )->render();

        return response()->json([
            "success" => true,
            "table" => $table,
            "data" => "success",
        ]);
    }

    public function UpdateItemsChoiceGroup(Request $request)
    {

        $choicegroups = ChoiceGroup::where(
            "id",
            $request->choice_group_id
        )->first();
        $choicegroups->name_en = $request->name_en;
        $choicegroups->name_ar = $request->name_ar;
        $choicegroups->mendatory_choice_count =
        $request->mendatory_choice_count;
        $choicegroups->total_choice_count = $request->total_choice_count;
        $choicegroups->save();

        // update choicegroup and choice
        $files = [];
        if ($request->hasfile("imagefile")) {
            foreach ($request->file("imagefile") as $key => $file) {
                $name =
                "edit" .
                time() .
                rand(1, 100) .
                "." .
                $file->getClientOriginalExtension();
                $file->move(public_path("files"), $name);
                $files[$key] = $name;
            }
        }

        for ($i = 0; $i < count($request->choiceid); $i++) {
            $choice = Choice::where("id", $request->choiceid[$i])->first();
            $choice->name_en = $request->choice_name_en[$i];
            $choice->name_ar = $request->choice_name_ar[$i];
            $choice->price = $request->choice_price[$i];
            foreach ($files as $key => $value) {
                if ($i == $key) {
                    $choice->imagefile = $files[$key];
                }
            }

            $choice->save();
        }

        $newfiles = [];
        if ($request->hasfile("editimagefile")) {
            foreach ($request->file("editimagefile") as $key => $file) {
                $name =
                "new" .
                time() .
                rand(1, 100) .
                "." .
                $file->getClientOriginalExtension();
                $file->move(public_path("files"), $name);
                $newfiles[$key] = $name;
            }
        }

        if ($request->editchoice_name_en != "") {
            for ($i = 0; $i < count($request->editchoice_name_en); $i++) {

                $checkmeni_item = MenuItem::where(['item_name_en' => $request->editchoice_name_en[$i], 'item_name_ar' => $request->editchoice_name_ar[$i]])->first();

                $addons = Addons::where(['title_en' => $request->editchoice_name_en[$i], 'title_ar' => $request->editchoice_name_ar[$i]])->first();

                if ($checkmeni_item) {
                    $choice = new Choice();
                    $choice->name_en = $request->editchoice_name_en[$i];
                    $choice->name_ar = $request->editchoice_name_ar[$i];
                    $choice->price = $request->editchoice_price[$i];
                    $choice->choice_group_id = $request->choice_group_id;
                    //$choice->imagefile = $files[$i];
                    $choice->type = 'regular_item';
                    $choice->reference_id = $checkmeni_item->id;

                    $choice->save();

                } else if ($addons) {
                    $choice = new Choice();
                    $choice->name_en = $request->editchoice_name_en[$i];
                    $choice->name_ar = $request->editchoice_name_ar[$i];
                    $choice->price = $request->editchoice_price[$i];
                    $choice->choice_group_id = $request->choice_group_id;
                    //$choice->imagefile = $files[$i];
                    $choice->type = 'addon';
                    $choice->reference_id = $addons->id;
                    $choice->save();

                } else {

                    $Addons = new Addons();
                    $Addons->title_en = $request->editchoice_name_en[$i];
                    $Addons->title_ar = $request->editchoice_name_ar[$i];
                    $Addons->price = $request->editchoice_price[$i];
                    $Addons->save();

                    $choice = new Choice();
                    $choice->name_en = $request->editchoice_name_en[$i];
                    $choice->name_ar = $request->editchoice_name_ar[$i];
                    $choice->price = $request->editchoice_price[$i];
                    $choice->choice_group_id = $request->choice_group_id;
                    // foreach ($newfiles as $key => $value) {
                    //     if ($i == $key) {
                    //         $choice->imagefile = $newfiles[$key];
                    //     }
                    // }
                    $choice->save();
                }
            }
        }

        $choicegroup = ChoiceGroup::with("Choice")
            ->where("menu_item_id", $choicegroups->menu_item_id)
            ->orderBy("created_at", "DESC")
            ->get();

        $table = view(
            "menu-management.items.partial",
            compact("choicegroup")
        )->render();

        return response()->json([
            "success" => true,
            "table" => $table,
            "data" => "success",
        ]);
    }

    public function deleteItemsChoiceGroup(Request $request)
    {
        $deleteGroup = ChoiceGroup::where("id", $request->id)->delete();
        if ($deleteGroup) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    public function deletedUsersList()
    {
        $usersList = User::where("role_id", "0")
            ->orderBY("id", "desc")
            ->onlyTrashed()
            ->get();
        //dd($usersList);
        return view("users/deleted_users_list", compact("usersList"));
    }

    //Restore User
    public function restoreUser(Request $request)
    {
        $usersList = User::withTrashed()
            ->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete User
    public function permanentDeleteUser(Request $request)
    {
        $usersList = User::onlyTrashed()
            ->find($request->id)
            ->forceDelete();
        return "success";
    }

    public function deleteChoiceData(Request $request)
    {
        $data = Choice::where("id", $request->id)->first(); //->forceDelete();

        $group = ChoiceGroup::where("id", $data->choice_group_id)->first();
        $group->total_choice_count = $group->total_choice_count - 1;
        if ($group->update()) {
            $data->delete();
        }

        return response()->json([
            "success" => true,
            "group" => $group,
        ]);
    }

    //get Choice Suggestions

    public function getChoiceSuggestions(Request $request)
    {
        //dd($request->all());

        if ($request->id == 1) {
            $getChoiceSuggestions = MenuItem::where('item_name_en', 'LIKE', $request->choice_key . '%')->pluck('item_name_en')->toArray();
            $title_en = Addons::where('title_en', 'LIKE', $request->choice_key . '%')->pluck('title_en')->toArray();
            $getChoiceSuggestions = array_merge($getChoiceSuggestions, $title_en);

            $getChoiceSuggestions_ar = MenuItem::where('item_name_en', 'LIKE', $request->choice_key . '%')->pluck('item_name_ar')->toArray();
            $title_ar = Addons::where('title_en', 'LIKE', $request->choice_key . '%')->pluck('title_ar')->toArray();

            $getChoiceSuggestions_price = MenuItem::where('item_name_en', 'LIKE', $request->choice_key . '%')->pluck('price')->toArray();
            $title_price = Addons::where('title_en', 'LIKE', $request->choice_key . '%')->pluck('price')->toArray();

            $getChoiceSuggestions_ar = array_merge($getChoiceSuggestions_ar, $title_ar);

            $getChoiceSuggestions_price = array_merge($getChoiceSuggestions_price, $title_price);

        } else {
            $getChoiceSuggestions = MenuItem::where('item_name_ar', 'LIKE', $request->choice_key . '%')->pluck('item_name_ar')->toArray();
            $title_en = Addons::where('title_en', 'LIKE', $request->choice_key . '%')->pluck('title_en')->toArray();
            $getChoiceSuggestions = array_merge($getChoiceSuggestions, $title_en);

            $getChoiceSuggestions_ar = null;
        }
        //dump($getChoiceSuggestions);
        //dd($request->all());

        if ($getChoiceSuggestions) {
            return response()->json([
                "success" => true,
                "data" => $getChoiceSuggestions,
                'data_ar' => $getChoiceSuggestions_ar,
                'data_price' => $getChoiceSuggestions_price,
            ]);
        } else {
            return response()->json([
                "success" => false,

            ]);
        }

    }

    //change choice group status

    public function changeChoiceGroupStatus(Request $request)
    {
        //dd($request->all());

        if ($request->status_value == 0) {
            $choiceGroupStatus = ChoiceGroup::where('id', $request->id)->update([
                'status' => '0',
            ]);
            return response()->json([
                'status' => 'group_inactive',
                'message' => "Choice Group Inactive",
            ]);
        } else {
            $choiceGroupStatus = ChoiceGroup::where('id', $request->id)->update([
                'status' => '1',
            ]);
            return response()->json([
                'status' => 'group_active',
                'message' => "Choice Group Active",
            ]);
        }

    }

    // Menu Item Availability

    public function menuItemsAvailability()
    {
          if (Auth::user()->can("menuitem_availability_management")) {
        $menuItem = MenuItem::with("menuCategory:id,name_en,name_ar")->orderBy("orderedby", "ASC")->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        $menu_item_availability = DB::table('md_dropdowns')->where('slug', 'menu_item_availability')->get()->toArray();
        $menuCategory = MenuCategory::where('status', 1)->get();
        $branches = Branch::select('id', 'title_en')->where('status', 1)->get();
        return view(
            "menu-management.items.items_availability",
            compact("menuItem", "menuCategory", "status", "menu_item_availability", "branches")
        );


        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }


    }

    public function changeBranchMenuItemStatus(Request $request)
    {
        // return dd($request->all());
        foreach ($request->branch_id as $key => $id) {
            $branch_info = BranchMenuItem::where('branch_id', $id)->where('menu_item_id', $request->menu_item_id)->first();
            //dump($branch_info);
            $branch_info->status = $request->status;
            $branch_info->availabality = $request->minutes;
            $branch_info->update();
        }

        return response()->json([
            'status' => true,
            'message' => "success",
        ]);

    }

    public function BranchMenuItemAvailabality(Request $request)
    {
        // dd($request->all());

        //$particularOrder = Order::with('user','branch','address','orderItems','orderItems.menuItems','orderItems.menuItems.menuCategory','orderItems.orderChoices.choice')->where('id',$request->id)->first();

        $all_menu_item = BranchMenuItem::where('menu_item_id', $request->id)->get()->toArray();
        $new_array = [];
        foreach ($all_menu_item as $key => $id) {
            $branch_name = Branch::where('id', $id['branch_id'])->pluck('title_en')->first();
            $id['branch_id'] = $branch_name;
            array_push($new_array, $id);
        }

        $menu_item_availability = DB::table('md_dropdowns')->where('slug', 'menu_item_availability')->get()->toArray();

        $result_view = view("menu-management.items.items_branch_availability_partial", [
            "particularOrder" => $new_array, "menu_item_availability" => $menu_item_availability,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function BranchMenuItemAvailabalityEach(Request $request)
    {
        return $branch_info = BranchMenuItem::where('branch_id', $request->branch_id)->where('menu_item_id', $request->menu_item_id)->first();
    }

    public function DeleteLoyaltyItem(Request $request)
    {

        if ($request->loyalty_id != null) {

            LoyaltyItem::where('id', $request->loyalty_id)->delete();

            return true;

        }

    }

    // Check If Choice Name Exist //

    public function checkChoiceNameExist(Request $request){

        $arabic_name = ChoiceGroup::select('name_ar')->where('name_en', $request->choice_name)->first();

        if($arabic_name != null){
            return json_encode([
                'status' => 'true',
                'arabic_name' => $arabic_name->name_ar
            ]);
        }else{
            return json_encode([
                'status' => 'false',
            ]);
        }

    }

    // -------------------- //

}
