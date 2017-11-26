<?php

namespace ElfSundae\Laravel\DataTables\Test;

use Orchestra\Testbench\TestCase;
use ElfSundae\Laravel\DataTables\DataTables;
use Yajra\DataTables\ButtonsServiceProvider;
use ElfSundae\Laravel\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\Facades\DataTables as DataTablesFacade;

class DataTablesServiceProviderTest extends TestCase
{
    public function testRegisterredBindings()
    {
        $this->app->register(DataTablesServiceProvider::class);

        $this->assertInstanceOf(DataTables::class, $this->app['datatables']);
        $this->assertSame($this->app['datatables'], DataTablesFacade::getFacadeRoot());
    }

    public function testConfiguredButtonsStub()
    {
        $this->app->register(DataTablesServiceProvider::class);
        $this->assertSame(
            '/vendor/elfsundae/laravel-datatables/src/stubs',
            $this->app['config']->get('datatables-buttons.stub')
        );
    }

    public function testDoNotOverwriteUsersButtonsStub()
    {
        $this->app->register(ButtonsServiceProvider::class);
        $this->app['config']->set('datatables-buttons.stub', '/foo/bar.stub');

        $this->app->register(DataTablesServiceProvider::class);
        $this->assertSame(
            '/foo/bar.stub',
            $this->app['config']->get('datatables-buttons.stub')
        );
    }
}
