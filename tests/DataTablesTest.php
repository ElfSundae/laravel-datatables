<?php

namespace ElfSundae\DataTables\Test;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Collection;
use Yajra\DataTables\CollectionDataTable;
use ElfSundae\DataTables\DataTablesServiceProvider;

class DataTablesTest extends TestCase
{
    public function testMakeDataTableForArray()
    {
        $this->assertInstanceOf(CollectionDataTable::class, datatables([]));
    }

    public function testMakeDataTableUsingConfiguredClassName()
    {
        $this->app['config']->set([
            'datatables.builders.'.CustomCollection::class => CustomCollectionDataTable::class,
        ]);

        $this->assertInstanceOf(
            CustomCollectionDataTable::class,
            datatables(new CustomCollection)
        );
    }

    public function testMakeDataTableUsingConfiguredEngineAlias()
    {
        $this->app['config']->set([
            'datatables.builders.'.CustomCollection::class => 'custom_collection',
            'datatables.engines.custom_collection' => CustomCollectionDataTable::class,
        ]);

        $data = new CustomCollection([]);

        $this->assertInstanceOf(
            CustomCollectionDataTable::class,
            datatables($data)
        );

        $this->assertInstanceOf(
            CustomCollectionDataTable::class,
            datatables()->customCollection($data)
        );
    }

    protected function getPackageProviders($app)
    {
        return [DataTablesServiceProvider::class];
    }
}

class CustomCollectionDataTable extends CollectionDataTable
{
}

class CustomCollection extends Collection
{
}
