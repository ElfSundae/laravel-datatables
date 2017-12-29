<?php

namespace ElfSundae\DataTables;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class DataTables
{
    /**
     * Make a DataTable instance from source.
     *
     * @param mixed $source
     * @return mixed
     * @throws \Exception
     */
    public function make($source)
    {
        if (is_array($source)) {
            $source = new Collection($source);
        }

        if ($engine = $this->getEngineForSource($source)) {
            return $this->createDataTable($engine, $source);
        }

        throw new Exception('No available engine for '.get_class($source));
    }

    /**
     * Get the optimum engine for the given data source.
     *
     * @param  mixed  $source
     * @return string|null
     */
    protected function getEngineForSource($source)
    {
        $result = null;

        foreach (config('datatables.builders') as $type => $engine) {
            if ($source instanceof $type) {
                if (! isset($tmpType) || is_subclass_of($type, $tmpType)) {
                    $tmpType = $type;
                    $result = $engine;
                }
            }
        }

        return $result;
    }

    /**
     * Create a new DataTable instance.
     *
     * @param  string  $engine
     * @param  mixed  $source
     * @return mixed
     * @throws \Exception
     */
    protected function createDataTable($engine, $source)
    {
        if ($class = class_exists($engine) ? $engine : Arr::get(config('datatables.engines'), $engine)) {
            return new $class($source);
        }

        throw new Exception("Unsupported DataTable engine [$engine]");
    }

    /**
     * Make a DataTable instance by using method name as engine.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->createDataTable(Str::snake($method), ...$parameters);
    }
}
