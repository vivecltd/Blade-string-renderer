<?php
namespace BladeStringRenderer;

use Illuminate\Support\ServiceProvider;

class BladeStringRendererProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register blade string factory
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BladeStringFactory::class, function ($app) {

            $resolver = $app['view.engine.resolver'];

            $finder = $app['view.finder'];

            $eventsDispatcher = $app['events'];

            return new BladeStringFactory($resolver, $finder, $eventsDispatcher);
        });
    }
}
