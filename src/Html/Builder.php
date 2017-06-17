<?php

namespace ElfSundae\Laravel\Datatables\Html;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Yajra\Datatables\Html\Builder as BaseBuilder;

class Builder extends BaseBuilder
{
    /**
     * Table attributes.
     *
     * @var array
     */
    protected $tableAttributes = [
        'id' => 'dataTable',
        'class' => 'table table-bordered table-hover dt-responsive',
        'width' => '100%',
    ];

    /**
     * Set table "id" attribute.
     *
     * @param  string  $id
     * @return $this
     */
    public function setTableId($id)
    {
        return $this->setTableAttribute('id', $id);
    }

    /**
     * Add classes to table "class" attribute.
     *
     * @param  string  ...$classes
     * @return $this
     */
    public function addTableClass(...$classes)
    {
        $value = Arr::get($this->tableAttributes, 'class', '');

        foreach ($classes as $class) {
            if (! Str::contains($value, $class)) {
                $value .= ' '.$class;
            }
        }

        return $this->setTableAttribute('class', trim($value));
    }

    /**
     * Remove classes to table "class" attribute.
     *
     * @param  string  ...$classes
     * @return $this
     */
    public function removeTableClass(...$classes)
    {
        if ($value = Arr::get($this->tableAttributes, 'class')) {
            foreach ($classes as $class) {
                if (Str::contains($value, $class)) {
                    $value = str_replace($class, '', $value);
                }
            }

            $this->setTableAttribute('class', trim($value));
        }

        return $this;
    }

    /**
     * Change table style to striped.
     *
     * @return $this
     */
    public function stripedTable()
    {
        $this->removeTableClass('table-hover');

        return $this->addTableClass('table-striped');
    }

    /**
     * Change table style to hovered.
     *
     * @return $this
     */
    public function hoveredTable()
    {
        $this->removeTableClass('table-striped');

        return $this->addTableClass('table-hover');
    }
}
