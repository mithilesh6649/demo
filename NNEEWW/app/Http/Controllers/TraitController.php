<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TraitCategory;
use App\Models\TraitList;
use App\Models\TraitMap;
use App\Models\TraitsPrice;
use DB;
class TraitController extends Controller
{
    public function TraitCategoriesList()
    {
        // Insert Trait Categries;
         // $data = [
        //     "Nutritional",
        //     "Exercise",
        //     "Addiction",
        //     "Dermatology",
        //     "Hormonal",
        //     "Lifestyle",
        //     "Neurology",
        //     "Ophthalmology",
        //     "Personality",
        //     "Renal",
        //     "Gastrointestinal",
        //     "Immunology",
        //     "Allergy",
        //     "Dental",
        //     "IVF & Pregnancy Loss*",
        //     "Pulmonary",
        //     "Circadian Rhythm",
        //     "Vaccinomics",
        //     "Cardiology",
        //     "Bone Health & Disorders",
        //     "Hematological",
        //     "Infectious Diseases",
        // ];

        // foreach ($data as $key => $value) {
        //     $traitCategory = new TraitCategory();
        //     $traitCategory->title = $value;
        //     $traitCategory->save();
        // }

        // Staff::truncate();
         // branchStaffs::truncate();
        // NOTE:: Circadian Rhythm Tak ka data insert ho gya hai......
        // if (($handle = fopen(public_path() . '/traits.csv', 'r')) !== false) {
        //     while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        //         $trait_category_id = 17;
        //         $data_title = $data[$trait_category_id-1];
        //         if($data_title){
        //             $traitList = TraitList::create([
        //                 'trait_category_id' => $trait_category_id,
        //                 'title' =>  $data_title,
        //             ]);

        //             $lastInsertedId = $traitList->id;

        //             TraitMap::create([
        //                 'trait_category_id' => $trait_category_id,
        //                 'trait_list_id' => $lastInsertedId,
        //             ]);
        //         }

        //     }
        //     fclose($handle);

        //     return 'Data imported Successfully';
        // }

        $TraitCategory = TraitCategory::all();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('traits_categories.list', ['RecipeCategories' => $TraitCategory, 'status' => $status]);

    }


    public function addTraitCategory(){
       $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
       return view('traits_categories.add', ['status' => $status]); 
   }

   public function saveTraitCategory(Request $request){
     $traitCategories = TraitCategory::create($request->all());
     if ($traitCategories) {
        return redirect()->route('trait.category.list')->with(['success' => 'Trait Category has been created successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }


}

public function editTraitCategory($id){
    $data = TraitCategory::where('id', $id)->first();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('traits_categories.edit', compact('status', 'data'));
}

public function updateTraitCategory(Request $request){
    $traitCategories = TraitCategory::where('id',$request->trait_category_id)->update(['title'=>$request->title,'status'=>$request->status]);
    if ($traitCategories) {
        return redirect()->route('trait.category.list')->with(['success' => 'Trait Category has been updated successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }
}


public function viewTraitCategory($id){
    $data = TraitCategory::where('id', $id)->first();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('traits_categories.view', compact('status', 'data'));
}

public function deleteTraitCategory(Request $request)
{

    $RecipeCategory = TraitCategory::where('id', $request->id)->first();
    if ($RecipeCategory) {
        $RecipeCategory->delete();
        return response()->json([
            'success' => 1,
        ]);
    } else {
        return response()->json([
            'success' => 0,
        ]);
    }
}


public function TraitsList(){
    $traits = DB::table('trait_lists')->select('trait_lists.*','trait_categories.title as category_title')->join('trait_categories','trait_lists.trait_category_id','=','trait_categories.id')->get();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('traits.list', ['traits' => $traits, 'status' => $status]);
}


public function addTrait(){
   $all_active_traits_category = TraitCategory::ACTIVE_TRAITS_CATEGORY();
   $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
   return view('traits.add', ['all_active_traits_categories' => $all_active_traits_category, 'status' => $status]);
}

public function saveTrait(Request $request){
    $trait = TraitList::create($request->all());
    if($trait) {
        return redirect()->route('trait.list')->with(['success' => 'Trait Category has been created successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }
}

public function editTrait($id)
{
    $data = TraitList::where('id', $id)->first();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      $all_active_traits_categories = TraitCategory::ACTIVE_TRAITS_CATEGORY();
    return view('traits.edit', compact('status', 'data', 'all_active_traits_categories'));
}


public function updateTrait(Request $request){
    
    $TraitList = TraitList::where('id',$request->trait_id)->update(['title'=>$request->title,'status'=>$request->status,'trait_category_id'=>$request->trait_category_id]);
    if ($TraitList) {
        return redirect()->route('trait.list')->with(['success' => 'Trait has been updated successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }
}

public function viewTrait($id)
{
    $data = TraitList::where('id', $id)->first();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
      $all_active_traits_categories = TraitCategory::ACTIVE_TRAITS_CATEGORY();
    return view('traits.view', compact('status', 'data', 'all_active_traits_categories'));
}

  public function deleteTrait(Request $request ){

        $TraitList = TraitList::where('id', $request->id)->first();
        if ($TraitList) {
            $TraitList->delete();
            return response()->json([
                'success' => 1,
            ]);
        } else {
            return response()->json([
                'success' => 0,
            ]);
        }

    }


    public function traitAdditionalDiscountList(){
        $allAdditionalTests = TraitsPrice::all();
        return view('traits.additional_discount.list',compact('allAdditionalTests'));
    }

    public function traitAdditionalDiscountEdit($id){
         $PreventiveGeneticTestCount = TraitsPrice::get();
        $data =  TraitsPrice::where('id',$id)->first();
          return view('traits.additional_discount.edit',compact('data','PreventiveGeneticTestCount'));
    } 

    public function traitAdditionalDiscountView($id){
          $PreventiveGeneticTestCount = TraitsPrice::get();
          $data =  TraitsPrice::where('id',$id)->first();
          return view('traits.additional_discount.view',compact('data','PreventiveGeneticTestCount'));
    }
    

    public function traitAdditionalDiscountUpdate(Request $request){
         
          if($request->data_slug == 'one')
             {
               TraitsPrice::where('id',$request->additional_test_id)->update(['price'=>$request->price]);
             }
          else if($request->data_slug == 'any_two')
             {
               TraitsPrice::where('id',$request->additional_test_id)->update(['price'=>$request->price]);
             }
         else
             {
               TraitsPrice::where('id',$request->additional_test_id)->update(['price'=>$request->price]);
              } 

           return redirect()->route('additional_trait_discount')->with(['success' => 'Additional Traits Discount  has been updated successfully!']);      

    }
}

