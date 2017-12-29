<?php

namespace ElfSundae\DataTables\Test;

use Orchestra\Testbench\TestCase;
use ElfSundae\DataTables\DataTables;
use Yajra\DataTables\ButtonsServiceProvider;
use ElfSundae\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\Facades\DataTables as DataTablesFacade;
use Yajra\DataTables\DataTablesServiceProvider as YajraDataTablesServiceProvider;

class DataTablesServiceProviderTest extends TestCase
{
    public function testRegisteredBindings()
    {
        $this->app->register(DataTablesServiceProvider::class);

        $this->assertInstanceOf(DataTables::class, $this->app['datatables']);
        $this->assertSame($this->app['datatables'], DataTablesFacade::getFacadeRoot());
    }

    public function testMergedConfiguration()
    {
        $this->app->register(DataTablesServiceProvider::class);

        $this->assertEquals(
            ['eloquent', 'query', 'collection'],
            array_keys(array_flip($this->app['config']->get('datatables.builders')))
        );

        $this->assertSame(
            '/vendor/elfsundae/laravel-datatables/src/stubs',
            $this->app['config']->get('datatables-buttons.stub')
        );
    }

    public function testDoNotOverwriteUsersBuildersConfig()
    {
        $this->app->register(YajraDataTablesServiceProvider::class);
        $this->app['config']->set('datatables.builders', ['foo' => 'bar']);

        $this->app->register(DataTablesServiceProvider::class);
        $this->assertEquals(
            ['eloquent', 'query', 'collection', 'bar'],
            array_keys(array_flip($this->app['config']->get('datatables.builders')))
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
