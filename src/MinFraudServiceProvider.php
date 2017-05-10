<?php

namespace IC\Laravel\MaxMindMinFraud;

use Illuminate\Support\ServiceProvider;

use MaxMind\MinFraud;

use IC\Laravel\MaxMindMinFraud\Middleware\MaxMindMinFraud;

class MinFraudServiceProvider extends ServiceProvider
{
    /**
     * The middleware aliases.
     *
     * @var array
     */
    protected $middlewareAliases = [
        'maxmind.minfraud' => MaxMindMinFraud::class,
    ];

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

        $this->app->singleton('maxmind.minfraud', function ($app) {
            $config = $app['config']['maxmind-minfraud'];

            return new MinFraud($config['user_id'], $config['license_key']);
        });

        $this->app->alias('maxmind.minfraud', MinFraud::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->aliasMiddleware();
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        $router = $this->app['router'];

        $method = method_exists($router, 'aliasMiddleware') ? 'aliasMiddleware' : 'middleware';
        foreach ($this->middlewareAliases as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['maxmind.minfraud'];
    }
}
