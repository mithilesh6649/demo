<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserPlanExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentTime = now();
        $message = '';

        if ($request->diet_plan_id && $request->diet_plan_id != config('common.models.diet_plan_subscriptions.specialized_plan_id')) {

            $dietPlan = auth()->user()->dietPlan($request->diet_plan_id)->first();

            if ($dietPlan) {

                $expiredTime = \Carbon\Carbon::parse($dietPlan->expire_at);

                if ($currentTime->gt($expiredTime)) {

                    return response()->json(['status' => 400, 'success' => false, 'message' => 'Your plan has been expired', 'error' => true], 400);
                }
            } else {

                return response()->json(['status' => 400, 'success' => false, 'message' => 'You don\'t have any active plan', 'error' => true], 400);
            }
        }

        return $next($request);
    }
}
