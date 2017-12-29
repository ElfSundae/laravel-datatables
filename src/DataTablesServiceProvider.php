<?php

namespace ElfSundae\DataTables;

use Illuminate\Support\ServiceProvider;

class DataTablesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Yajra\DataTables\DataTablesServiceProvider::class);
        $this->app->register(\Yajra\DataTables\ButtonsServiceProvider::class);

        $this->replaceBindings();

        $this->configureDataTables();
    }

    /**
     * Replace the original DataTables bindings.
     *
     * @return void
     */
    protected function replaceBindings()
    {
        $this->app->alias('datatables', DataTables::class);
        $this->app->singleton('datatables', function () {
            return new DataTables;
        });

        $this->app->bind('datatables.html', Html\Builder::class);
    }

    /**
     * Configure DataTables.
     *
     * - Restore the default "builders" configuration, see https://github.com/yajra/laravel-datatables/pull/1462/commits/afdbe6bce9ade9b19d66034ace3d8a2c24da8a56
     * - Configure our custom DataTable service stub for "datatables:make" command
     *
     * @return void
     */
    protected function configureDataTables()
    {
        $this->mergeConfig('datatables.builders', [
            \Illuminate\Database\Eloquent\Builder::class => 'eloquent',
            \Illuminate\Database\Eloquent\Relations\Relation::class => 'eloquent',
            \Illuminate\Database\Query\Builder::class => 'query',
            \Illuminate\Support\Collection::class => 'collection',
        ]);

        $this->mergeConfig('datatables-buttons', [
            'stub' => '/vendor/elfsundae/laravel-datatables/src/stubs',
        ]);
    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string  $key
     * @param  array  $config
     * @return void
     */
    protected function mergeConfig($key, array $config)
    {
        $current = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge($config, $current));
    }
}
