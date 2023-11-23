<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\GenerateURL;
use App\Models\Food;
use App\Services\EdamamService;
use App\Models\HealthLabel;
use App\Models\FoodHealthLabelMap;
use DB,Str,ZipArchive;


class FoodController extends Controller
{
    use GenerateURL;
    public function FoodList()
    {

        $allFoods = Food::get();
        return view('foods.list', ['allFoods' => $allFoods]);
    }

    public function addCustomFood()
    {
        //  return $allFoods = Food::limit(4)->get();
      $status = DB::table('md_dropdowns')->where('slug', 'status')->get(); 
     // $servingTypes = DB::table('md_dropdowns')->where('module', 'serving_type')->get();
      $foodUnits = DB::table('md_dropdowns')->where('slug', 'food_unit')->get();
      $healthLabels = HealthLabel::get();
      
      return view('foods.add_custom',compact('foodUnits','status','healthLabels'));
  }

  public function saveFood(Request $request)
  {

    // DB::beginTransaction();
    // try
    // {
          // dd($request->all());
    $edmam_food_id = 'food_custom_' . Str::random(25);
    $food_image = null;
    if ($request->file("thumbnail")) {
        $foodImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $foodImage->getClientOriginalExtension();
        $foodImage->move("images/food", $thumbnail);
        $food_image = env('IMAGE_BASE_URL') . '/images/food/' . $thumbnail;
    }

    $request->request->add(['edmam_food_id' => $edmam_food_id, 'image' => $food_image]);
        //dd($request->all());
    $savedFood = Food::create($request->all());

    //Store HealthLabelMap

    if ($request->health_label_id != "") {
        foreach ($request->health_label_id as $key => $id) {
            $FoodHealthLabelMap = new FoodHealthLabelMap();
            $FoodHealthLabelMap->food_id = $savedFood->id;
            $FoodHealthLabelMap->health_label_id = $id;
            $FoodHealthLabelMap->save();
        }
    }

    return redirect()->route('food.list')->with(['success' => 'Food  has been created successfully!']);

    //     DB::commit();
    // } catch (\Exception $e) {
    //     DB::rollback();
    //     return redirect()->route("food.list")
    //     ->with("error", "something went wrong");
    // }
}


public function updateFood(Request $request){
 //dd($request->all());
 $food_image = null;
 if ($request->file("thumbnail")) {
    $foodImage = $request->file("thumbnail");
    $thumbnail = time() . "." . $foodImage->getClientOriginalExtension();
    $foodImage->move("images/food", $thumbnail);
    $food_image = env('IMAGE_BASE_URL') . '/images/food/' . $thumbnail;
    Food::where('id',$request->food_id)->update(['image'=>$food_image]);
}

Food::where('id',$request->food_id)->update([
 'brand_name'=>$request->brand_name,
 'brand_description'=>$request->brand_description,
 'protein'=>$request->protein,
 'total_fat'=>$request->total_fat,
 'saturated_fat'=>$request->saturated_fat,
 'polyunsaturated_fat'=>$request->polyunsaturated_fat,
 'monounsaturated_fat'=>$request->monounsaturated_fat,
 'trans_fat'=>$request->trans_fat,
 'calories'=>$request->calories,
 'serving_size'=>$request->serving_size,
 'serving_type'=>$request->serving_type,
 'total_weight'=>$request->total_weight,
 'total_weight_unit'=>$request->total_weight_unit,
  // 'serving_size_in_gram'=>$request->serving_size_in_gram,
   //'serving_container'=>$request->serving_container,
 'cholesterol'=>$request->cholesterol,
 'sodium'=>$request->sodium,
 'potassium'=>$request->potassium,
 'total_carbohydrate'=>$request->total_carbohydrate,
 'sugar'=>$request->sugar,
 'added_sugar'=>$request->added_sugar,
 'sugar_alcohol'=>$request->sugar_alcohol,
 'vitamin_a'=>$request->vitamin_a,
 'vitamin_b_6'=>$request->vitamin_b_6,
 'vitamin_b_12'=>$request->vitamin_b_12,
 'vitamin_c'=>$request->vitamin_c,
 'vitamin_d'=>$request->vitamin_d,
 'calcium'=>$request->calcium,
 'iron'=>$request->iron,

 'total_fat_unit'=>$request->fat_unit,
 'saturated_fat_unit'=>$request->saturated_fat_unit,
 'polyunsaturated_fat_unit'=>$request->polyunsaturated_fat_unit,
 'monounsaturated_fat_unit'=>$request->monounsaturated_fat_unit,
 'trans_fat_unit'=>$request->trans_fat_unit,
 'cholesterol_unit'=>$request->cholesterol_unit,
 'sodium_unit'=>$request->sodium_unit,
 'potassium_unit'=>$request->potassium_unit,
 'total_carbohydrate_unit'=>$request->total_carbohydrate_unit,
 'sugar_unit'=>$request->sugar_unit,
 'added_sugar_unit'=>$request->added_sugar_unit,
 'sugar_alcohol_unit'=>$request->sugar_alcohol_unit,
 'protein_unit'=>$request->protein_unit,
 'vitamin_a_unit'=>$request->vitamin_a_unit,
 'vitamin_b_6_unit'=>$request->vitamin_b_6_unit,
 'vitamin_b_12_unit'=>$request->vitamin_b_12_unit,
 'vitamin_c_unit'=>$request->vitamin_c_unit,
 'vitamin_d_unit'=>$request->vitamin_d_unit,
 'calcium_unit'=>$request->calcium_unit,
 'iron_unit'=>$request->iron_unit,
 'dietary_fibre'=>$request->dietary_fibre,
 'dietary_fibre_unit'=>$request->dietary_fibre_unit,
 'magnesium'=>$request->magnesium,
 'magnesium_unit'=>$request->magnesium_unit,
 'zinc'=>$request->zinc,
 'zinc_unit'=>$request->zinc_unit,
 'phosphorus'=>$request->phosphorus,
 'phosphorus_unit'=>$request->phosphorus_unit,
 'thiamin'=>$request->thiamin,
 'thiamin_unit'=>$request->thiamin_unit,
 'riboflavin'=>$request->riboflavin,
 'riboflavin_unit'=>$request->riboflavin_unit,
 'niacin'=>$request->niacin,
 'niacin_unit'=>$request->niacin_unit,
 'folate_dfe'=>$request->folate_dfe,
 'folate_dfe_unit'=>$request->folate_dfe_unit,
 'folate_food'=>$request->folate_food,
 'folate_food_unit'=>$request->folate_food_unit,
 'folic'=>$request->folic,
 'folic_unit'=>$request->folic_unit,
 'vitamin_k'=>$request->vitamin_k,
 'vitamin_k_unit'=>$request->vitamin_k_unit,
 'water'=>$request->water,
 'water_unit'=>$request->water_unit,
 'fiber'=>$request->fiber,
 'fiber_unit'=>$request->fiber_unit,
]);


      //Store HealthLabelMap
FoodHealthLabelMap::where('food_id',$request->food_id)->forceDelete();
if ($request->health_label_id != "") {
    foreach ($request->health_label_id as $key => $id) {
        $FoodHealthLabelMap = new FoodHealthLabelMap();
        $FoodHealthLabelMap->food_id = $request->food_id;
        $FoodHealthLabelMap->health_label_id = $id;
        $FoodHealthLabelMap->save();
    }
}
return redirect()->route('food.list')->with(['success' => 'Food  has been updated successfully!']);
}

public function addEdamamFood()
{
        //  return $allFoods = Food::limit(4)->get();
    return view('foods.add_edamam');
}

public function addEdamamFoodById(Request $request)
{
    //dd($request->all());
    $foodId = $request->food_id;
    $foodImg = $request->food_image;
    
      $url = $this->generateEdamamURL('nutrients');
        $postData['ingredients'][] = [
            'quantity' => (int) $request->servingSize,
            'measureURI'=>$request->servingType,
            'foodId' => $foodId,
        ];

        $foodNutrients = EdamamService::callEdamamFoodNutrients($url, json_encode($postData)); 

    if ($foodNutrients) {

        $saveFoodData = new Food;
        // $foodAdditionalData = ['food_id' => $foodId, 'food_image' => $foodImg];
        // $savedFoodInfo = $saveFoodData->saveFood($foodNutrients, $foodAdditionalData);

        $foodAdditionalData = ['food_id'=>$foodId,'food_image'=>$foodImg, 'servingSize' =>(int) $request->servingSize,'servingType'=>$foodNutrients['ingredients'][0]['parsed'][0]['measure']];
       // dd($foodAdditionalData);
        $savedFoodInfo = $saveFoodData->saveFood($foodNutrients,$foodAdditionalData);

            //Store Health Labels... 
        $saveFoodData->updateHealthLabels($savedFoodInfo->id,$foodNutrients);
        return $savedFoodInfo->id;

    }
}

  public function getMeasureNutrition(Request $request){
         //dd($request->all()); 
        $url = $this->generateEdamamURL('nutrients');
        $postData['ingredients'][] = [
            'quantity' => (int) $request->quantity,
            'measureURI'=>$request->measureURI,
            'foodId' => $request->foodId,
        ];

        $foodNutrients = EdamamService::callEdamamFoodNutrients($url, json_encode($postData)); 
       // dd(  @$foodNutrients ) ;
      
          return response()->json([
              'calorie' => round(@$foodNutrients['totalNutrients']['ENERC_KCAL']['quantity'],2),
              'protein' => round(@$foodNutrients['totalNutrients']['PROCNT']['quantity'],2),  
              'fat' => round(@$foodNutrients['totalNutrients']['FAT']['quantity'],2),  
              'carbohydrate' => round(@$foodNutrients['totalNutrients']['CHOCDF']['quantity'],2),  
              'fiber' => round(@$foodNutrients['totalNutrients']['FIBTG']['quantity'],2),    
          ]);
 
    }

public function editFood($id)
{
   $data = Food::with('foodHealthLabelMap')->where('id', $id)->first();
   $foodUnits = DB::table('md_dropdowns')->where('slug', 'food_unit')->get(); 
   $healthLabels = HealthLabel::get();
   $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
   return view('foods.edit', compact('status', 'data','foodUnits','healthLabels')); 
}

public function viewFood($id)
{
    $data = Food::with('foodHealthLabelMap')->where('id', $id)->first();
    $foodUnits = DB::table('md_dropdowns')->where('slug', 'food_unit')->get();
    $healthLabels = HealthLabel::get();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('foods.view', compact('status', 'data','foodUnits','healthLabels'));
}

public function getEdamamFood(Request $request)
{

    $nextURL = '';

    $allFoodIds = Food::pluck('edmam_food_id')->toArray();

    if ($request->next_page_url) {
                //TODO: FEtch foods from edamam when we have next page url
        $url = $request->next_page_url;

    }else{ 
        $url = config('common.edamam.base_url') . config('common.edamam.food_parser_endpoint');
        $url .= "app_id=" . config('common.edamam.food_api_app_id');
        $url .= "&app_key=" . config('common.edamam.food_app_key');
        if ($request['ingr']) {

            $url .= '&ingr=' . rawurlencode($request['ingr']);
        }
        $url .= '&nutrition-type=cooking';
        $url .= '&generic-meals';
    }

    $foodList = EdamamService::callEdamamFood($url);
    if (count($foodList) != 0) {
        $foods = $foodList['hints'];
        $nextURL = isset($foodList['_links']['next']['href']) ? $foodList['_links']['next']['href'] : '' ;
        $html = view('foods.food_list', compact('foods', 'allFoodIds'))->render();
    }


    return json_encode(['html' => $html, 'status' => true,'next_page_url' => $nextURL]);
        // dd($html);
}


public function foodImport(){
   return view('foods.import_food');
}

public function foodUploadsss(Request $request){
    //dd($request->all());
//dd(storage_path('app/public/uploads'));
        // Retrieve the uploaded file
    $file = $request->file('file');

        // Extract the contents of the zip file
    $zip = new ZipArchive();
    $zip->open($file);
    $zip->extractTo(storage_path('app/public/uploads'));
    $zip->close();

        // Read each file and apply condition
       // $files = glob(storage_path('app/public/uploads/*'));

    $foodPath = storage_path('app/public/uploads/food');
    //$imageFiles = glob($foodPath . '/*.jpg');
    $xlFiles = glob($foodPath . '/*.xlsx');
    //First Index Excel file..
   // dd($xlFiles[0]);
    $data = Excel::toArray([], $xlFiles[0])[0];

    dd($data);

}



public function foodUpload(Request $request){

        // Validate the request
    $request->validate([
        'file' => 'required|mimes:zip|max:2048'
    ],[
        'file.required' => 'You have to choose the file!',
        'type.required' => 'You have to choose type of the file!'
    ]);  

    try {
    // Load the data from the Excel file


  //Upload Zip and Extract....
       $file = $request->file('file');

  // Extract the contents of the zip file
       $zip = new ZipArchive();
       $zip->open($file);
       $zip->extractTo(storage_path('app/public/uploads'));
       $zip->close();

       $foodPath = storage_path('app/public/uploads/food');
    //$imageFiles = glob($foodPath . '/*.jpg');
       $xlFiles = glob($foodPath . '/*.xlsx');
    //First Index Excel file...
       if(count($xlFiles)){
         $data = Excel::toArray([], $xlFiles[0])[0]; 
     }else{
         return redirect()->back()->with(['success' =>'The folder must be named "food".']);
     }

    // $data = Excel::toArray([], $request->file('file'))[0];

     $data = array_slice($data, 2);
   //dd($data);
     $foods_array = []; 


     foreach ($data as $row) {

       $brand_name = null;
       $brand_description = null;
       $image = null;
       $serving_size = null;
       $serving_type = null;
       $total_weight= null;
       $total_weight_unit= null;
       $health_labels= [];
       $calories= null;
       $total_fat= null;
       $total_fat_unit= null;
       $saturated_fat= null; 
       $saturated_fat_unit= null;
       $polyunsaturated_fat= null;
       $polyunsaturated_fat_unit= null;
       $monounsaturated_fat= null;
       $monounsaturated_fat_unit= null;
       $trans_fat= null;
       $trans_fat_unit= null;
       $cholesterol= null;
       $cholesterol_unit= null;
       $sodium= null;
       $sodium_unit= null;
       $potassium= null;
       $potassium_unit= null;
       $total_carbohydrate= null;
       $total_carbohydrate_unit= null;
       $sugar= null;
       $sugar_unit= null;
       $added_sugar= null;
       $added_sugar_unit= null;
       $sugar_alcohol= null;
       $sugar_alcohol_unit= null;
       $protein= null;
       $protein_unit= null;
       $vitamin_a= null;
       $vitamin_a_unit= null;
       $vitamin_b_6= null;
       $vitamin_b_6_unit= null;
       $vitamin_b_12= null;
       $vitamin_b_12_unit= null;
       $vitamin_c= null;
       $vitamin_c_unit= null;
       $vitamin_d= null;
       $vitamin_d_unit= null;
       $calcium= null;
       $calcium_unit= null;
       $iron= null;
       $iron_unit= null;
       $dietary_fibre= null;
       $dietary_fibre_unit= null;
       $magnesium= null;
       $magnesium_unit= null;
       $zinc= null;
       $zinc_unit= null;
       $phosphorus= null;
       $phosphorus_unit = null;
       $thiamin = null;
       $thiamin_unit = null;
       $riboflavin = null;
       $niacin_unit = null;
       $folate_dfe = null;
       $folate_dfe_unit = null;
       $folate_food = null;
       $folate_food_unit = null;
       $folic = null;
       $folic_unit = null;
       $vitamin_k = null;
       $vitamin_k_unit = null;
       $water = null;
       $water_unit = null;
       $fiber = null;
       $fiber_unit = null;
       $riboflavin_unit = null;
       $niacin = null;
       $valuesWithUnit = null;

       $row = array_filter($row, function($value) {
        return !is_null($value);
    });

       if(count($row) && isset($row[0])){
        //dump($row);
        $getFoodByName = Food::where('brand_name',$row[0])->first();
        if(!$getFoodByName){

            foreach($row as $key=>$value){
    // 0 For food Name
             if($key == 0){
                 $brand_name = $value;
             }

     // 1 For food Description
             if($key == 1){
                 $brand_description = $value;
             }

     // 1 For Food Image
             if($key == 2){
                 $image = $value == null ? null : asset('storage/uploads/food/' . $value);
             } 

         // 3 For serving_size
             if($key == 3){
                 $serving_size = $value;
             }

          // 4 For serving_type
             if($key == 4){
                 $serving_type = $value;
             }

         // 5 For Total Weight( with unit )  //serving_size_in_gram
             if($key == 5){
                  // $serving_size_in_gram = $value;
                 
              $valuesWithUnit =  $this->splitUnit($value);
              if(is_array($valuesWithUnit)){
                $total_weight = $valuesWithUnit[1]; 
                $total_weight_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $total_weight = $valuesWithUnit;
                $total_weight_unit = null; 
            }
         
        }

            // 6 For HealthLabel --serving_size_in_gram
        if($key == 6){
          $health_labels =  $this->splitHealthLable($value);
      }

             // 7 For calories
      if($key == 7)
      {
        $caloriesWithUnit =  $this->splitUnit($value);
        if(is_array($caloriesWithUnit)){
                    $calories =  $caloriesWithUnit[1]; //dd($caloriesWithUnit);
                }
                else{
                   $calories = $caloriesWithUnit;
               }
           }

              // 8 For total_fat
           if($key == 8)
           {
            $totalFatWithUnit =  $this->splitUnit($value);
            if(is_array($totalFatWithUnit)){
                $total_fat = $totalFatWithUnit[1]; 
                $total_fat_unit = $totalFatWithUnit[2] == 'per' ? '%':$totalFatWithUnit[2];
            }
            else{
                $total_fat = $totalFatWithUnit;
                $total_fat_unit = null;
            }
        }

              // 9 For saturated_fat
        if($key == 9)
        {
            $saturatedFatWithUnit =  $this->splitUnit($value);
            if(is_array($saturatedFatWithUnit)){
                $saturated_fat = $saturatedFatWithUnit[1]; 
                $saturated_fat_unit = $saturatedFatWithUnit[2] == 'per' ? '%':$saturatedFatWithUnit[2];
            }
            else{
                $saturated_fat = $saturatedFatWithUnit;
                $saturated_fat_unit = null;
            }
        }


              // 10 For polyunsaturated_fat
        if($key == 10)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $polyunsaturated_fat = $valuesWithUnit[1]; 
                $polyunsaturated_fat_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $polyunsaturated_fat = $valuesWithUnit;
                $polyunsaturated_fat_unit = null;
            }
        }

                 // 11 For monounsaturated_fat
        if($key == 11)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $monounsaturated_fat = $valuesWithUnit[1]; 
                $monounsaturated_fat_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $monounsaturated_fat = $valuesWithUnit;
                $monounsaturated_fat_unit = null;
            }
        }


                 // 12 For trans_fat
        if($key == 12)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $trans_fat = $valuesWithUnit[1]; 
                $trans_fat_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $trans_fat = $valuesWithUnit;
                $trans_fat_unit = null;
            }
        }

              // 13 For cholesterol
        if($key == 13)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $cholesterol = $valuesWithUnit[1]; 
                $cholesterol_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $cholesterol = $valuesWithUnit;
                $cholesterol_unit = null;
            }
        }

                 // 14 For sodium
        if($key == 14)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $sodium = $valuesWithUnit[1]; 
                $sodium_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $sodium = $valuesWithUnit;
                $sodium_unit = null;
            }
        }


             // 15 For potassium
        if($key == 15)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $potassium = $valuesWithUnit[1]; 
                $potassium_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $potassium = $valuesWithUnit;
                $potassium_unit = null;
            }
        }

              // 16 For total_carbohydrate
        if($key == 16)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $total_carbohydrate = $valuesWithUnit[1]; 
                $total_carbohydrate_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $total_carbohydrate = $valuesWithUnit;
                $total_carbohydrate_unit = null;
            }
        }


                  // 17 For sugar
        if($key == 17)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $sugar = $valuesWithUnit[1]; 
                $sugar_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $sugar = $valuesWithUnit;
                $sugar_unit = null;
            }
        }

                   // 18 For added_sugar
        if($key == 18)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $added_sugar = $valuesWithUnit[1]; 
                $added_sugar_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $added_sugar = $valuesWithUnit;
                $added_sugar_unit = null;
            }
        }


                   // 19 For sugar_alcohol
        if($key == 19)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $sugar_alcohol = $valuesWithUnit[1]; 
                $sugar_alcohol_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $sugar_alcohol = $valuesWithUnit;
                $sugar_alcohol_unit = null;
            }
        }


                   // 20 For protein
        if($key == 20)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $protein = $valuesWithUnit[1]; 
                $protein_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $protein = $valuesWithUnit;
                $protein_unit = null;
            }
        }


                   // 21 For vitamin_a
        if($key == 21)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $vitamin_a = $valuesWithUnit[1]; 
                $vitamin_a_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $vitamin_a = $valuesWithUnit;
                $vitamin_a_unit = null;
            }
        }


                   // 22 For vitamin_b_6
        if($key == 22)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $vitamin_b_6 = $valuesWithUnit[1]; 
                $vitamin_b_6_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $vitamin_b_6 = $valuesWithUnit;
                $vitamin_b_6_unit = null;
            }
        }


                   // 23 For vitamin_b_12
        if($key == 23)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $vitamin_b_12 = $valuesWithUnit[1]; 
                $vitamin_b_12_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $vitamin_b_12 = $valuesWithUnit;
                $vitamin_b_12_unit = null;
            }
        }



                   // 24 For vitamin_c
        if($key == 24)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $vitamin_c = $valuesWithUnit[1]; 
                $vitamin_c_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $vitamin_c = $valuesWithUnit;
                $vitamin_c_unit = null;
            }
        }


            // 25 For vitamin_d
        if($key == 25)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $vitamin_d = $valuesWithUnit[1]; 
                $vitamin_d_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $vitamin_d = $valuesWithUnit;
                $vitamin_d_unit = null;
            }
        }


         // 26 For calcium
        if($key == 26)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $calcium = $valuesWithUnit[1]; 
                $calcium_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $calcium = $valuesWithUnit;
                $calcium_unit = null;
            }
        }


         // 27 For iron
        if($key == 27)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $iron = $valuesWithUnit[1]; 
                $iron_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $iron = $valuesWithUnit;
                $iron_unit = null;
            }
        }


         // 28 For dietary_fibre
        if($key == 28)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $dietary_fibre = $valuesWithUnit[1]; 
                $dietary_fibre_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $dietary_fibre = $valuesWithUnit;
                $dietary_fibre_unit = null;
            }
        }


         // 29 For magnesium
        if($key == 29)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $magnesium = $valuesWithUnit[1]; 
                $magnesium_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $magnesium = $valuesWithUnit;
                $magnesium_unit = null;
            }
        }

         // 30 For zinc
        if($key == 30)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $zinc = $valuesWithUnit[1]; 
                $zinc_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $zinc = $valuesWithUnit;
                $zinc_unit = null;
            }
        }

          // 31 For phosphorus
        if($key == 31)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $phosphorus = $valuesWithUnit[1]; 
                $phosphorus_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $phosphorus = $valuesWithUnit;
                $phosphorus_unit = null;
            }
        }


            // 32 For thiamin
        if($key == 32)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $thiamin = $valuesWithUnit[1]; 
                $thiamin_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $thiamin = $valuesWithUnit;
                $thiamin_unit = null;
            }
        }


          // 33 For riboflavin
        if($key == 33)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $riboflavin = $valuesWithUnit[1]; 
                $riboflavin_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $riboflavin = $valuesWithUnit;
                $riboflavin_unit = null;
            }
        }


          // 34 For FolateDfe $folate_dfe
        if($key == 34)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $folate_dfe = $valuesWithUnit[1]; 
                $folate_dfe_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $folate_dfe = $valuesWithUnit;
                $folate_dfe_unit = null;
            }
        }


         // 35 For FolateFood $folate_food
        if($key == 35)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $folate_food = $valuesWithUnit[1]; 
                $folate_food_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $folate_food = $valuesWithUnit;
                $folate_food_unit = null;
            }
        }



         // 36 For FolateFood $folic
        if($key == 36)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $folic = $valuesWithUnit[1]; 
                $folic_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $folic = $valuesWithUnit;
                $folic_unit = null;
            }
        }


        // 37 For vitamin_k $vitamin_k
        if($key == 37)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $vitamin_k = $valuesWithUnit[1]; 
                $vitamin_k_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $vitamin_k = $valuesWithUnit;
                $vitamin_k_unit = null;
            }
        }


         // 38 For   $water
        if($key == 38)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $water = $valuesWithUnit[1]; 
                $water_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $water = $valuesWithUnit;
                $water_unit = null;
            }
        }


         // 39 For   $fiber
        if($key == 39)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $fiber = $valuesWithUnit[1]; 
                $fiber_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $fiber = $valuesWithUnit;
                $fiber_unit = null;
            }
        }


        // 40 For   $niacin
        if($key == 40)
        {
            $valuesWithUnit =  $this->splitUnit($value);
            if(is_array($valuesWithUnit)){
                $niacin = $valuesWithUnit[1]; 
                $niacin_unit = $valuesWithUnit[2] == 'per' ? '%':$valuesWithUnit[2];
            }
            else{
                $niacin = $valuesWithUnit;
                $niacin_unit = null;
            }
        }




    }

    $foods_array = [
        'edmam_food_id' => 'food_custom_' . Str::random(25),
        'brand_name'=>$brand_name,
        'brand_description'=>$brand_description,
        'image'=>$image,
        'is_edamam_food_added' => 0,
        'serving_size' =>$serving_size,
        'serving_type' =>$serving_type,
        'total_weight' =>$total_weight,
        'total_weight_unit' =>$total_weight_unit,
       // 'serving_container' =>(int) $serving_container,
        'calories'=>$calories,
        'total_fat'=>$total_fat,
        'total_fat_unit'=>$total_fat_unit,
        'saturated_fat'=>$saturated_fat,
        'saturated_fat_unit'=>$saturated_fat_unit,
        'polyunsaturated_fat'=>$polyunsaturated_fat,
        'polyunsaturated_fat_unit'=>$polyunsaturated_fat_unit,
        'monounsaturated_fat'=>$monounsaturated_fat,
        'monounsaturated_fat_unit'=>$monounsaturated_fat_unit,
        'trans_fat'=>$trans_fat,
        'trans_fat_unit'=>$trans_fat_unit,
        'cholesterol'=>$cholesterol,
        'cholesterol_unit'=>$cholesterol_unit,
        'sodium'=>$sodium,
        'sodium_unit'=>$sodium_unit,
        'potassium'=>$potassium,
        'potassium_unit'=>$potassium_unit,
        'total_carbohydrate'=>$total_carbohydrate,
        'total_carbohydrate_unit'=>$total_carbohydrate_unit,
        'sugar'=>$sugar,
        'sugar_unit'=>$sugar_unit,
        'added_sugar'=>$added_sugar,
        'added_sugar_unit'=>$added_sugar_unit,
        'sugar_alcohol'=>$sugar_alcohol,
        'sugar_alcohol_unit'=>$sugar_alcohol_unit,
        'protein'=>$protein,
        'protein_unit'=>$protein_unit,
        'vitamin_a'=>$vitamin_a,
        'vitamin_a_unit'=>$vitamin_a_unit,
        'vitamin_b_6'=>$vitamin_b_6,
        'vitamin_b_6_unit'=>$vitamin_b_6_unit,
        'vitamin_b_12'=>$vitamin_b_12,
        'vitamin_b_12_unit'=>$vitamin_b_12_unit,
        'vitamin_c'=>$vitamin_c,
        'vitamin_c_unit'=>$vitamin_c_unit,
        'vitamin_d'=>$vitamin_d,
        'vitamin_d_unit'=>$vitamin_d_unit,
        'calcium'=>$calcium,
        'calcium_unit'=>$calcium_unit,
        'iron'=>$iron,
        'iron_unit'=>$iron_unit,
        'dietary_fibre'=>$dietary_fibre,
        'dietary_fibre_unit'=>$dietary_fibre_unit,
        'magnesium'=>$magnesium,
        'magnesium_unit'=>$magnesium_unit,
        'zinc'=>$zinc,
        'zinc_unit'=>$zinc_unit,
        'phosphorus'=>$phosphorus,
        'phosphorus_unit'=>$phosphorus_unit ,
        'thiamin'=>$thiamin ,
        'thiamin_unit'=>$thiamin_unit ,
        'riboflavin'=>$riboflavin ,
        'riboflavin_unit'=>$riboflavin_unit,
        'folate_dfe'=>$folate_dfe,
        'folate_dfe_unit'=>$folate_dfe_unit,
        'folate_food'=>$folate_food,
        'folate_food_unit'=>$folate_food_unit,
        'folic'=>$folic,
        'folic_unit'=>$folic_unit,
        'vitamin_k'=>$vitamin_k ,
        'vitamin_k_unit'=>$vitamin_k_unit ,
        'water'=>$water ,
        'water_unit'=>$water_unit ,
        'fiber'=>$fiber ,
        'fiber_unit'=>$fiber_unit ,
        'riboflavin_unit'=>$riboflavin_unit ,
        'niacin'=>$niacin,
        'niacin_unit'=>$niacin_unit

    ]; 

      //dd($foods_array,$health_labels);
    $latestFoodId = Food::create($foods_array);

    if ($health_labels != "") {
        foreach ($health_labels as $key => $id) {
            $FoodHealthLabelMap = new FoodHealthLabelMap();
            $FoodHealthLabelMap->food_id = $latestFoodId->id;
            $FoodHealthLabelMap->health_label_id = $id;
            $FoodHealthLabelMap->save();
        }
    }

} 


} 

}


//DB::table('foods')->insert($foods_array);
return redirect()->route('food.list')->with(['success' => 'Food  has been uploaded successfully!']);

} catch (\Exception $e) {
    $errorMessage = $e->getMessage();
    $errorCode = $e->getCode();
    return redirect()->back()->with(['success' => $e->getMessage()]);
    // Handle the exception
}

}





// public function splitUnit($value){
//     $units = ['mg','ml', 'g', 'µg', 'kcal', '%','per'];
//     if (is_string($value) && preg_match('/([\d.]+)(\w+)/', $value, $matches)) {
//        return $matches;
//    }

//     // Check if the value is a number and greater than zero
//    if (is_numeric($value) && $value > 0) {
//     return $value;
// }
// }


public function splitUnit($value) {
    $units = ['mg', 'ml', 'g', 'µg', 'kcal', '%', 'per'];

    if (is_string($value) && preg_match('/([\d.]+)(\w+)/u', $value, $matches)) {
        return $matches;
    }

    // Check if the value is a number and greater than zero
    if (is_numeric($value) && $value > 0) {
        return $value;
    }
}


public function splitHealthLable($value){
    if(!is_null($value)){
        $tagsArray = explode(',', $value);
        $tagIds = [];
        foreach ($tagsArray as $tagName) {
            $slug = Str::slug($tagName, '-');
            $value = Str::upper(str_replace('-', '_', $slug));
            $tag = HealthLabel::firstOrCreate(
                ['title' => trim($tagName)],
                ['slug' => $slug,'value' => $value]
            );
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }


}

}


