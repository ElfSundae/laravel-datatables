<?php

namespace ElfSundae\Laravel\Datatables;

use Illuminate\Support\ServiceProvider;

class DatatablesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the service provider.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-datatables.php', 'laravel-datatables');

        if ($this->app->runningInConsole()) {
            $this->registerForConsole();
        }
    }

    /**
     * Register for console.
     *
     * @return void
     */
    protected function registerForConsole()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-datatables.php' => config_path('laravel-datatables.php'),
        ], 'laravel-datatables');
    }

    /**
     * Create alias for the facade.
     *
     * @param  string  $facade
     * @param  string  $class
     * @return void
     */
    protected function aliasFacade($facade, $class)
    {
        if (class_exists('Illuminate\Foundation\AliasLoader')) {
            \Illuminate\Foundation\AliasLoader::getInstance()->alias($facade, $class);
        } else {
            class_alias($class, $facade);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [];
    }
}
