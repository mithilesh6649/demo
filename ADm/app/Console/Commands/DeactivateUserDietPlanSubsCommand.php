<?php

namespace App\Console\Commands;

use App\Jobs\SendDietPlanExpiredNotificationToUserJob;
use App\Models\UserDietPlanSubscription;
use Illuminate\Console\Command;


class DeactivateUserDietPlanSubsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactive:plan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will deactivate the user diet plan subscription after exceeding expiry time';

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
        \Log::info('************* I am from deactivate user diet plan *************  ASDAS ************');
        $userIds = UserDietPlanSubscription::select('users.device_token', 'user_diet_plan_subscriptions.user_id')
            ->join('users', 'users.id', '=', 'user_diet_plan_subscriptions.user_id')
            ->whereDate('user_diet_plan_subscriptions.expire_at', '<=', now())
            ->get();

        if (count($userIds) != 0) {

            $fcmTokens = $userIds->pluck('device_token')->toArray();
            $userIds = $userIds->pluck('user_id')->toArray();
            dispatch(new SendDietPlanExpiredNotificationToUserJob($userIds, $fcmTokens));
        }

        UserDietPlanSubscription::whereDate('expire_at', '<', now())->update(['status' => 0]);
    }
}
