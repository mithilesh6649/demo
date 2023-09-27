<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ChangeMedicineReminderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change_medicine_reminder:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will change the status of the water reminder to 0 at once in a day. This will be the check condition for the cron that particular cron already runs.';

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
        \DB::table('medicine_reminders')->update(array('cron_run' => 0));
    }
}
