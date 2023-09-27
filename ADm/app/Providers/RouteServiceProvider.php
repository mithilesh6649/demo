<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';
    protected $apiNamespace = 'App\\Http\\Controllers\\Api';

    protected $paymentNamespace = 'App\\Http\\Controllers\\Payment';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            Route::middleware('web')
                ->namespace($this->apiNamespace)
                ->group(base_path('routes/web.php'));

            Route::group([
                'middleware' => ['api', 'api_version:v1'],
                'namespace'  => "{$this->apiNamespace}\V1",
                'prefix'     => 'api/v1/auth',
            ], function ($router) {
                require base_path('routes/Api/V1/auth.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v1'],
                'namespace'  => "{$this->apiNamespace}\V1",
                'prefix'     => 'api/v1/user',
            ], function ($router) {
                require base_path('routes/Api/V1/user.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v1'],
                'namespace'  => "{$this->apiNamespace}\V1",
                'prefix'     => 'api/v1/misc',
            ], function ($router) {
                require base_path('routes/Api/V1/misc.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v2'],
                'namespace'  => "{$this->apiNamespace}\V2",
                'prefix'     => 'api/v2',
            ], function ($router) {
                require base_path('routes/Api/V2/auth.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v1'],
                'namespace' => "{$this->apiNamespace}\V1",
                'prefix' => 'api/v1/consultant',
            ], function ($router) {
                require base_path('routes/Api/V1/consultant.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v1'],
                'namespace' => "{$this->apiNamespace}\V1\Trackers",
                'prefix' => 'api/v1/tracker',
            ], function ($router) {
                require base_path('routes/Api/V1/tracker.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v1'],
                'namespace' => "{$this->apiNamespace}\V1",
                'prefix' => 'api/v1/notification',
            ], function ($router) {
                require base_path('routes/Api/V1/notification.php');
            });

            Route::group([
                // 'middleware' => ['api', 'api_version:v1', 'auth:api', 'check_user_plan_expired'],
                'middleware' => ['api', 'api_version:v1', 'auth:api'],
                'namespace' => "{$this->apiNamespace}\V1\Diet",
                'prefix' => 'api/v1/diet',
            ], function ($router) {
                require base_path('routes/Api/V1/diet.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v1'],
                'namespace' => "{$this->apiNamespace}\V1\Exercise",
                'prefix' => 'api/v1/exercise',
            ], function ($router) {
                require base_path('routes/Api/V1/exercise.php');
            });

            Route::group([
                'namespace' => "{$this->apiNamespace}\V1",
            ], function ($router) {
                require base_path('routes/web.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v1', 'auth:api'],
                'namespace' => "{$this->apiNamespace}\V1\Plan",
                'prefix' => 'api/v1/plan',
            ], function ($router) {
                require base_path('routes/Api/V1/plan.php');
            });

            Route::group([
                'middleware' => ['api', 'api_version:v1', 'auth:api'],
                'namespace'  => "{$this->apiNamespace}\V1",
                'prefix'     => 'api/v1/test',
            ], function ($router) {
                require base_path('routes/Api/V1/test.php');
            });

            Route::group([
                'namespace' => "{$this->paymentNamespace}\Razorpay",
                'prefix' => 'razorpay',
            ], function ($router) {
                require base_path('routes/Payment/razorpay.php');
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
