<?php

namespace ElfSundae\Laravel\DataTables;

use Yajra\DataTables\EloquentDataTable as BaseEloquentDataTable;

class EloquentDataTable extends BaseEloquentDataTable
{
    /**
     * Add columns in collection.
     *
     * @param  array  $names
     * @param  bool|int  $order
     * @return $this
     */
    public function addColumns(array $names, $order = false)
    {
        foreach ($names as $name => $attribute) {
            if (is_int($name)) {
                $name = $attribute;
            }

            $this->addColumn($name, function ($model) use ($attribute) {
                return $model->getAttribute($attribute);
            }, is_int($order) ? $order++ : $order);
        }

        return $this;
    }
}
