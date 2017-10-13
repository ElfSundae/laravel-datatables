<?php

namespace ElfSundae\Laravel\DataTables\Html;

use Yajra\DataTables\Html\Builder as BaseBuilder;

class Builder extends BaseBuilder
{
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
