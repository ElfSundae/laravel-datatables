<?php

namespace ElfSundae\Laravel\DataTables;

use Illuminate\Foundation\AliasLoader;
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
        $this->registerOriginalDataTables();

        $this->replaceDataTablesBindings();

        $this->configureDataTables();
    }

    /**
     * Register the original DataTables service providers.
     *
     * @return void
     */
    protected function registerOriginalDataTables()
    {
        $this->app->register(\Yajra\DataTables\DataTablesServiceProvider::class);
        AliasLoader::getInstance()->alias('DataTables', \Yajra\DataTables\Facades\DataTables::class);

        $this->app->register(\Yajra\DataTables\ButtonsServiceProvider::class);
    }

    /**
     * Replace the original DataTables bindings.
     *
     * @return void
     */
    protected function replaceDataTablesBindings()
    {
        // $this->app->bind('datatables.html', Html\Builder::class);
    }

    /**
     * Configure DataTables.
     *
     * @return void
     */
    protected function configureDataTables()
    {
        // $this->app['config']->set([
        //     'datatables.engines.eloquent' => EloquentDataTable::class,
        // ]);

        if (! $this->app['config']->has('datatables-buttons.stub')) {
            $this->app['config']->set([
                'datatables-buttons.stub' => '/vendor/elfsundae/laravel-datatables/src/stubs',
            ]);
        }
    }
}
