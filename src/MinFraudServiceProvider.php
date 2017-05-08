<?php

namespace IC\Laravel\MaxMindMinFraud;

use Illuminate\Support\ServiceProvider;

use MaxMind\MinFraud;

class MinFraudServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/maxmind-minfraud.php';
        $this->mergeConfigFrom($configPath, 'maxmind-minfraud');
        $this->publishes([$configPath => config_path('maxmind-minfraud.php')], 'config');

        $this->app->singleton(MinFraud::class, function ($app) {
            return new MinFraud();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @param  \Illuminate\Routing\Router  $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Connection::class];
    }
}
