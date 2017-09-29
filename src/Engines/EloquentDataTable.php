<?php

namespace ElfSundae\Laravel\DataTables\Engines;

use Yajra\DataTables\EloquentDataTable as BaseEloquentDataTable;

class EloquentDataTable extends BaseEloquentDataTable
{
    /**
     * Add column in collection.
     *
     * @param  string|string[]  $name
     * @param  string|callable|bool|int|null  $content
     * @param  bool|int  $order
     * @return $this
     */
    public function addColumn($name, $content = null, $order = false)
    {
        if (is_bool($content) || is_int($content)) {
            $order = $content;
            $content = null;
        }

        if (is_null($content) && is_string($name)) {
            $content = function ($model) use ($name) {
                return $model->{$name};
            };
        }

        if (is_array($name)) {
            foreach ($name as $n) {
                $this->addColumn($n, $content, $order);
            }

            return $this;
        }

        return parent::addColumn($name, $content, $order);
    }
}