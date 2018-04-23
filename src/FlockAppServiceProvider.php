<?php
namespace SwapnilSarwe\LaravelFlockClient;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class FlockAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'flock-app');
        $this->loadMigrationsFrom(__DIR__ . '/database');
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/flock-app'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        include __DIR__ . '/routes.php';
        $this->app->make('SwapnilSarwe\LaravelFlockClient\Controllers\FlockAppController');

        App::bind('flockappservice', function () {
            return new \SwapnilSarwe\LaravelFlockClient\Services\FlockAppService();
        });
    }
}
