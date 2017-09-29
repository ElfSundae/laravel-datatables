<?php

namespace ElfSundae\Laravel\DataTables;

use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables as BaseDataTables;

class DataTables extends BaseDataTables
{
    /**
     * {@inheritdoc}
     */
    public function queryBuilder($builder)
    {
        return static::make($builder);
    }

    /**
     * {@inheritdoc}
     */
    public function eloquent($builder)
    {
        return static::make($builder);
    }

    /**
     * {@inheritdoc}
     */
    public function collection($collection)
    {
        return static::make($collection);
    }
}
