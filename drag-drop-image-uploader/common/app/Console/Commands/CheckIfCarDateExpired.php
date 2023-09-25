<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cars;
use App\Models\Ownership;
use App\Models\Driver;
class CheckIfCarDateExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiry:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' Mail for cars expiry ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 


          // $all_cars = Cars::with(
        //     "owner:id,ownership_name",
        //     "driver:id,drivers_name",
        //     "carBranch:car_id,branch_id",
        //     "carBranch.Branch"
        // )
        //     ->orderBy("expiry_date", "ASC")
        //     ->get();
        // foreach ($all_cars as $car) {
        //     $strtotime = strtotime($car->expiry_date);
        //     $one_month_back = date("Y-m-d", strtotime("-1 month", $strtotime));
        //     $current_month = date("Y-m-d");
        //     if ($one_month_back <= $current_month) {
        //         $data = ["car_details" => $car];
        //         \Mail::send(["html" => "mail"], $data, function ($message) {
        //             $message
        //                 ->to(
        //                     "mithilesh_kumar@rvtechnologies.com",
        //                     "Mugal Mahal Hr"
        //                 )
        //                 ->subject("Mughal Mahal Car Expiry Notification");
        //             $message->from(
        //                 "mithileshkumar6649@gmail.com",
        //                 "Mugal Mahal Admin "
        //             );
        //         });
        //         //dd($car);
        //     }
        // }


        // --------------------------------------------
        // MK Working

        $all_cars = Cars::with('owner:id,ownership_name', 'driver:id,drivers_name', 'carBranch:car_id,branch_id', 'carBranch.Branch')->orderBy('expiry_date', 'ASC')->get();
        $one_month_back = "";
        $_15_days_back = "";

        foreach ($all_cars as $car) {
            $strtotime = strtotime($car->expiry_date);
            $one_month_back = date("Y-m-d", strtotime("-1 month", $strtotime));
            $_15_days_back = date("Y-m-d", strtotime("-15 day", $strtotime));
            $current_month_day = date("Y-m-d");
            if ($one_month_back <= $current_month_day) {
                //For One Months Before Expiry
                if ($car->expiry_before_one_months == 0) {
                    $data = array('car_details' => $car);
                    \Mail::send(['html' => 'mail'], $data, function ($message) {
                        $message->to('hr@mughalmahal.com', 'Mugal Mahal Hr')->subject('Mughal Mahal Car Expiry Notification');
                        $message->from('mithileshkumar6649@gmail.com', 'Mugal Mahal Admin ');
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
                                $message->to('hr@mughalmahal.com', 'Mugal Mahal Hr')->subject('Mughal Mahal Car Expiry Notification');
                                $message->from('mithileshkumar6649@gmail.com', 'Mugal Mahal Admin ');
                            });
                            $car->expiry_before_15_days = 1;
                            $car->update();
                        }
                    }
                }
            }
        }
        // MK Working

          
          \Log::info("Mail Sent !");
      //  return 0;
    }
}
