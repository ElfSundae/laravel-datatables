<?php

namespace ElfSundae\Laravel\Datatables;

use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables as BaseDatatables;

class Datatables extends BaseDatatables
{
    /**
     * Create an engine instance with configured class.
     *
     * @param  string  $type
     * @param  mixed  $source
     * @return \Yajra\Datatables\Engines\BaseEngine|null
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
            parent::collection($builder);
    }
}
