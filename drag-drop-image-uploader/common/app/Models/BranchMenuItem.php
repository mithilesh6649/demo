<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchMenuItem extends Model 
{
    use HasFactory , SoftDeletes ;
   
    public function  menuItems(){
        return $this->hasMany(MenuItem::class,'id','menu_item_id');
    }
   


    public function getCreatedAtAttribute()
    {

         if($this->availabality == 0){  
               return '';
         }  


          if($this->availabality == 1){
              return '';
         }  

        // 60 means 1 hrs
        if($this->availabality == 60){
        
        $updated_at =strtotime($this->updated_at);
        $now = \Carbon\Carbon::now();
        $n=strtotime($now);
        //$mins=  round(abs($updated_at - $n) / 60,2)." minute";
        $sec =   ($n-$updated_at);   
        
         if($sec>=0){
             //  return  round(abs(3600-$sec) /60,2)." Minutes are left" ;
                  $time_in_m = round(abs(3600-$sec) /60,2);
               
                $minutes = $time_in_m % 60;

                $hours = intval($time_in_m / 60); 

               // return $minutes."dsfd".$hours;
                
                return $hours."hrs and ".$minutes."min are left";
                   }
         else{
               return "0 Minutes are left"; 
         }          
        }


         // 120 means 1 hrs
        if($this->availabality == 120){
        
        $updated_at =strtotime($this->updated_at);
        $now = \Carbon\Carbon::now();
        $n=strtotime($now);
        //$mins=  round(abs($updated_at - $n) / 60,2)." minute";
        $sec =   ($n-$updated_at);   
        
         if($sec>=0){
              // return  round(abs(3600*2-$sec) /60,2)." Minutes are left" ;
                
                      $time_in_m = round(abs(3600*2-$sec) /60,2);
               
                $minutes = $time_in_m % 60;

                $hours = intval($time_in_m / 60); 

               // return $minutes."dsfd".$hours;
                
                return $hours."hrs and ".$minutes."min are left";


                   }
         else{
               return "0 Minutes are left"; 
         }          
        }


              // 240 means 1 hrs
        if($this->availabality == 240){
        
        $updated_at =strtotime($this->updated_at);
        $now = \Carbon\Carbon::now();
        $n=strtotime($now);
        //$mins=  round(abs($updated_at - $n) / 60,2)." minute";
        $sec =   ($n-$updated_at);   
        
         if($sec>=0){
               //return  round(abs(3600*4-$sec) /60,2)." Minutes are left" ;
                       $time_in_m = round(abs(3600*4-$sec) /60,2);
               
                $minutes = $time_in_m % 60;

                $hours = intval($time_in_m / 60); 

               // return $minutes."dsfd".$hours;
                
                return $hours."hrs and ".$minutes."min are left";

                   }
         else{
               return "0 Minutes are left"; 
         }          
        }


              // 240 means 1 hrs
        if($this->availabality == 1440){
        
        $updated_at =strtotime($this->updated_at);
        $now = \Carbon\Carbon::now();
        $n=strtotime($now);
        //$mins=  round(abs($updated_at - $n) / 60,2)." minute";
        $sec =   ($n-$updated_at);   
        
         if($sec>=0){
               
               //return  round(abs(3600*24-$sec) /60/60,2)." Minutes are left" ;
               $time_in_m = round(abs(3600*24-$sec) /60,2);
               
                $minutes = $time_in_m % 60;

                $hours = intval($time_in_m / 60); 

               // return $minutes."dsfd".$hours;
                
                return $hours."hrs and ".$minutes."min are left";
                   }
         else{
               return "0 Minutes are left"; 
         }          
        }




    }

}
