<?php

namespace ElfSundae\Laravel\DataTables\Html;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Builder as BaseBuilder;

class Builder extends BaseBuilder
{
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
        $classes = array_merge($this->getTableClasses(), $classes);

        return $this->setTableAttribute('class', implode(' ', $classes));
    }

    /**
     * Remove classes from table "class" attribute.
     *
     * @param  string  ...$classes
     * @return $this
     */
    public function removeTableClass(...$classes)
    {
        $classes = array_diff($this->getTableClasses(), $classes);

        return $this->setTableAttribute('class', implode(' ', $classes));
    }

    /**
     * Get table "class" attribute as array.
     *
     * @return array
     */
    public function getTableClasses()
    {
        return array_filter(explode(' ', Arr::get($this->getTableAttributes(), 'class', '')));
    }

    /**
     * Change table style to striped.
     *
     * @return $this
     */
    public function stripedTable()
    {
        return $this->removeTableClass('table-hover')->addTableClass('table-striped');
    }

    /**
     * Change table style to hovered.
     *
     * @return $this
     */
    public function hoveredTable()
    {
        return $this->removeTableClass('table-striped')->addTableClass('table-hover');
    }
}
