<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Customerreview extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        \DB::table('reviews')->truncate();
        \DB::table('reviews')->insert([
                          [
                            'name'=> "luke zhu",
                            'message'=>"道还可以；我最喜欢的玛莎拉不错；
                                        我评鉴一家印度餐厅的标准就是玛莎拉，而且是chicken的，😂😂😂" ,
                            'rating'=> "5",
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                          ],
                           [
                            'name'=> "Ahmed Murtagi",
                            'message'=>"Excellent restaurant..
                                        Delicious dishes
                                        Fantastic service" ,
                            'rating'=> "5",
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                          ],
                           [
                            'name'=> "Akbar Hussain",
                            'message'=>"Great experience thanks to entire staff specifically ouder takeing & serve department is really good and we are all enjoying his hospitality all items are good specially starter items is too good" ,
                            'rating'=> "5",
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                          ],
                           [
                            'name'=> "Mohamed AL Debaawy",
                            'message'=>"One of the best Indian fine-dining in Kuwait.
                                Excellent customer service, delicious food with big variety of Indian & Chinese dishes!
                                You should try it if you like Indian food 👌🏻" ,
                            'rating'=> "5",
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                          ],
                          


        ]);
    } 
}
