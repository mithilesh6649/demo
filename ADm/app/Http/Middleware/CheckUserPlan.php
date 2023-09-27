<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckUserPlan
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
        $controllerName = 'SpecializedDietPlanController';
        $methodName = 'dietPlan';

        /*********------------------------------------------------------------------
         * ******* Check if the user have opted Specialized plan or not ********** |
         * ******* If yes then assign this request a new controller ************** |
         * -------------------------------------------------------------------------
         */
        if ($request->diet_plan_id == config('common.models.diet_plan_subscriptions.specialized_plan_id')) {

            $route = $request->route();
            $namespace = $route->getAction()['namespace'];

            $routeAction = array_merge($route->getAction(), [
                'uses' => "$namespace\\$controllerName@$methodName",
                'controller' => "$namespace\\$controllerName@$methodName",
            ]);

            $route->setAction($routeAction);
            $route->controller = false;

            return $next($request);
        }

        return $next($request);
    }
}
