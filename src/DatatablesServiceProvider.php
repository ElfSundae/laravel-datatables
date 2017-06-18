<?php

namespace ElfSundae\Laravel\Datatables;

use Yajra\Datatables\Request;
use Illuminate\Support\ServiceProvider;

class DatatablesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Yajra\Datatables\DatatablesServiceProvider::class);
        $this->app->register(\Yajra\Datatables\HtmlServiceProvider::class);
        $this->app->register(\Yajra\Datatables\ButtonsServiceProvider::class);

        // Replace Datatables
        $this->app->singleton('datatables', function ($app) {
            return new Datatables(new Request($app->make('request')));
        });
        $this->app->alias('datatables', Datatables::class);

        // Replace html builder binding.
        $this->app->bind('datatables.html', Html\Builder::class);
    }
}
