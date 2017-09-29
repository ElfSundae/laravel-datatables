<?php

namespace ElfSundae\Laravel\DataTables;

use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables as BaseDataTables;

class DataTables extends BaseDataTables
{
    /**
     * Create an engine instance with configured class.
     *
     * @param  string  $type
     * @param  mixed  $source
     * @return \Yajra\DataTables\Engines\BaseEngine|null
     */
    protected function createEngineForType($type, $source)
    {
        if ($class = $this->getConfiguredEngineClass($type)) {
            return new $class($source, $this->request);
        }
    }

    /**
     * Get the configured engine class.
     *
     * @param  string  $type
     * @return string
     */
    protected function getConfiguredEngineClass($type)
    {
        return app('config')->get('datatables.engines.'.$type);
    }

    /**
     * {@inheritdoc}
     */
    public function queryBuilder($builder)
    {
        return $this->createEngineForType('query', $builder) ?:
            parent::queryBuilder($builder);
    }

    /**
     * {@inheritdoc}
     */
    public function eloquent($builder)
    {
        return $this->createEngineForType('eloquent', $builder) ?:
            parent::eloquent($builder);
    }

    /**
     * {@inheritdoc}
     */
    public function collection($collection)
    {
        if (is_array($collection)) {
            $collection = new Collection($collection);
        }

        return $this->createEngineForType('collection', $collection) ?:
            parent::collection($collection);
    }
}
