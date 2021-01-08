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
    public const HOME = '/admin';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * The Version of application api.
     *
     * @var string
     */
    public const API_PREFIX = 'api/v1';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        $this->mapModulesRoutes();

        $this->mapSPARoutes();
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

    /**
     * Define the "modules" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapModulesRoutes()
    {
        $modulesFolder = app_path('Modules');
        $modules = $this->getModulesList($modulesFolder);

        foreach ($modules as $module) {
            $routesPath = $modulesFolder . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'routes_api.php';

            if (file_exists($routesPath)) {
                Route::prefix(self::API_PREFIX)
                    ->middleware('api')
                    ->namespace("\\App\\Modules\\$module\Controllers")
                    ->group($routesPath);
            }
        }
    }

    /**
     * @param string $modules_folder
     * @return array
     */
    private function getModulesList(string $modules_folder): array
    {
        return
            array_values(
                array_filter(
                    scandir($modules_folder),
                    function ($item) use($modules_folder) {
                        return is_dir($modules_folder . DIRECTORY_SEPARATOR . $item) && !in_array($item, [".",".."]);
                    }
                )
            );
    }

    /**
     * All non matchable resources we will show standard Vue page,
     *
     * and redirect it through VueRoutes on client side
     *
     * @return void
     */
    protected function mapSPARoutes()
    {
        Route::namespace($this->namespace)
            ->middleware('web')
            ->group(function () {
                Route::view('/{any}', 'spa')
                    ->where('any', '.*');
            });
    }
}
