<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ChangeWeightReminderCronTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:cron_time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $date = now()->format('Y-m-d');

        \App\Models\WeightReminder::where(['status' => 1])
        ->whereDate('cron_time', '<', now())
        ->where(function($qr) use ($date) {
            $qr->where('type', 1)->update(['cron_time' => now()->parse("$date 9:58:00")->addWeek()]);
        })
        ->where(function($qr) {
            DB::statement('UPDATE `weight_reminders`
            SET `cron_time` = DATE_ADD(`cron_time`, INTERVAL +1 MONTH)
            WHERE `type` = "2"');
        });
    }
}
