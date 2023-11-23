<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;
class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
      \DB::table('exercises')->truncate();

       $allExrcises =  [

 
'Aerobics, high impact '=>'573',
'Aerobics, low impact '=>'365',
'Archery '=>'246',
'Backpacking '=>'511',
'Badminton '=>'365',
'Ballet '=>'365',
'Baseball '=>'365',
'Basketball '=>'584',
'Beach Volleyball '=>'364',
'Bicycling, leisurely pace (<10 mph)  '=>' 292',
'Bicycling, moderate pace (10-12 mph)  '=>' 438',
'Bicycling, vigorous pace (13-16 mph) '=>' 584',
'Bicycling, racing (>16 mph)  '=>' 876',
'Billiards  '=>' 164',
'Bowling  '=>' 164',
'Boxing, sparring  '=>' 584',
'Calisthenics, moderate  '=>' 365',
'Calisthenics, vigorous  '=>' 438',
'Canoeing  '=>' 292',
'Cardio kickboxing  '=>' 584',
'Circuit training  '=>' 584',
'Cleaning, light  '=>' 164',
'Cleaning, heavy  '=>' 292',
'Climbing stairs  '=>' 657',
'Climbing, rock  '=>' 657',
'Cross-country skiing  '=>' 584',
'Curling   '=>'246',
'Dancing, ballroom   '=>'266',
'Dancing, modern   '=>'365',
'Disc golf   '=>'292',
'Downhill skiing   '=>'365',
'Elliptical trainer   '=>'438',
'Fencing   '=>'438',
'Fishing   '=>'219',
'Football   '=>'657',
'Frisbee   '=>'292',
'Gardening   '=>'219',
'Golfing, carrying clubs   '=>'329',
'Golfing, using cart   '=>'219',
'Gymnastics   '=>'365',
'Handball   '=>'657',
'Hiking   '=>'438',
'Hockey, field   '=>'584',
'Hockey, ice   '=>'657',
'Horseback riding, walking   '=>'219',
'Horseback riding, trotting   '=>'365',
'Horseback riding, galloping   '=>'438',
'Hula hooping   '=>'292',
'Ice skating  '=>'438',
'Inline skating  '=>'657',
'Jai alai  '=>'657',
'Judo  '=>'657',
'Jumping jacks  '=>'657',
'Jumping rope  '=>'730',
'Karate  '=>'657',
'Kayaking  '=>'438',
'Kickball  '=>'438',
'Kickboxing  '=>'657',
'Lacrosse  '=>'657',
'Laundry, ironing  '=>'164',
'Laundry, washing and drying   '=>'219',
'Lawn mowing   '=>'329',
'Line dancing   '=>'292',
'Martial arts   '=>'584',
'Miniature golfing   '=>'164',
'Nordic walking   '=>'438',
'Orienteering   '=>'584',
'Paddleboarding   '=>'422',
'Paintball   '=>'438',
'Parkour   '=>'657',
'Pilates   '=>'219',
'Ping-pong (table tennis)  '=>' 219',
'Playing a musical instrument, standing  '=>' 146',
'Playing drums, standing  '=>' 292',
'Playing guitar, standing  '=>' 146',
'Polo  '=>' 584',
'Pole dancing  '=>' 292',
'Polo cross  '=>' 584',
'Power yoga  '=>' 438',
'Pull-ups  '=>' 292',
'Push-ups  '=>' 292',
'P90X  '=>' 657',
'Paragliding  '=>' 292',
'Pickleball  '=>' 365',
'Physical therapy exercises  '=>' 219',
'Pole vaulting  '=>' 657',
'Prancercise  '=>' 292',
'Racquetball  '=>' 657',
'Raking leaves  '=>' 292',
'Rappelling  '=>' 438',
'Rebounding  '=>' 438',
'Resistance band exercises  '=>' 219',
'Riding a horse  '=>' 292',
'River rafting  '=>' 422',
'Rock climbing  '=>' 657',
'Roller skating  '=>' 438',
'Rope jumping  '=>' 657',
'Rowing, moderate pace  '=>' 584',
'Rowing, vigorous pace  '=>' 876',
'Rugby  '=>' 657',
'Running, 5 mph (12 min/mile)  '=>'584',
'Running, 6 mph (10 min/mile)  '=>'657',
'Running, 7 mph (8.5 min/mile)  '=>'738',
'Running, 8 mph (7.5 min/mile)  '=>'819',
'Running, 9 mph (6.5 min/mile)  '=>'984',
'Running, 10 mph (6 min/mile)  '=>'1163',  

    //     [
    //         "name"=>"Cycling, mountain bike, bmx",
    //         "calories_per_hour"=> 617,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 617
    //     ],
    //     [
    //         "name"=> "Cycling, >20 mph, racing",
    //         "calories_per_hour"=> 1162,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 1162
    //     ],
    //     [
    //         "name"=> "Cycling, 12-13.9 mph, moderate",
    //         "calories_per_hour"=> 581,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 581
    //     ],
    //     [
    //         "name"=> "Cycling, 16-19 mph, very fast, racing",
    //         "calories_per_hour"=> 871,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 871
    //     ],
    //     [
    //         "name"=> "Stationary cycling, very light",
    //         "calories_per_hour"=> 217,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 217
    //     ],
    //     [
    //         "name"=> "Stationary cycling, light",
    //         "calories_per_hour"=> 399,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 399
    //     ],
    //     [
    //         "name"=> "Stationary cycling, moderate",
    //         "calories_per_hour"=> 508,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 508
    //     ],
    //     [
    //         "name"=> "Stationary cycling, vigorous",
    //         "calories_per_hour"=> 762,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 762
    //     ],
    //     [
    //         "name"=> "Stationary cycling, very vigorous",
    //         "calories_per_hour"=> 908,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 908
    //     ],
    //     [
    //         "name"=> "Calisthenics, vigorous, pushups, situps…",
    //         "calories_per_hour"=> 581,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 581
    //     ],


    //     [
    //         "name"=> "Weight lifting, body building, vigorous",
    //         "calories_per_hour"=> 435,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 435
    //     ],
    //     [
    //         "name"=> "Health club exercise",
    //         "calories_per_hour"=> 399,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 399
    //     ],
    //     [
    //         "name"=> "Aerobics, low impact",
    //         "calories_per_hour"=> 363,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 363
    //     ],
    //     [
    //         "name"=> "Aerobics, high impact",
    //         "calories_per_hour"=> 508,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 508
    //     ],
    //     [
    //         "name"=> "Aerobics, step aerobics",
    //         "calories_per_hour"=> 617,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 617
    //     ],
    //     [
    //         "name"=> "Aerobics, general",
    //         "calories_per_hour"=> 472,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 472
    //     ],
    //     [
    //         "name"=> "Instructing aerobic class",
    //         "calories_per_hour"=> 435,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 435
    //     ],
    //     [
    //         "name"=> "Water aerobics",
    //         "calories_per_hour"=> 290,
    //         "duration_minutes"=> 60,
    //         "total_calories"=> 290
    //     ]

     ];




    foreach($allExrcises as $keys => $exrcise){

      Exercise::create([
       'title' =>$keys,
       'calories_burnt' => $exrcise ,
       'duration_in_minutes' => 60,
       'status' =>1
   ]);
  }
}
}
