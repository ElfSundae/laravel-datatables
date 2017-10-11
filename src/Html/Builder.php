<?php

namespace ElfSundae\Laravel\DataTables\Html;

use Illuminate\Support\Arr;
use Yajra\DataTables\Html\Builder as BaseBuilder;

class Builder extends BaseBuilder
{
    /**
     * Sets HTML table "id" attribute.
     *
     * @param string $id
     * @return $this
     */
    public function setTableId($id)
    {
        return $this->setTableAttribute('id', $id);
    }

    /**
     * Add class names to the "class" attribute of HTML table.
     *
     * @param string|array $class
     * @return $this
     */
    public function addTableClass($class)
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = preg_split('#\s+#', $currentClass.' '.$class, null, PREG_SPLIT_NO_EMPTY);
        $class = implode(' ', array_unique($classes));

        return $this->setTableAttribute('class', $class);
    }

    /**
     * Remove class names from the "class" attribute of HTML table.
     *
     * @param string|array $class
     * @return $this
     */
    public function removeTableClass($class)
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = array_diff(
            preg_split('#\s+#', $currentClass, null, PREG_SPLIT_NO_EMPTY),
            preg_split('#\s+#', $class, null, PREG_SPLIT_NO_EMPTY)
        );
        $class = implode(' ', array_unique($classes));

        return $this->setTableAttribute('class', $class);
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
