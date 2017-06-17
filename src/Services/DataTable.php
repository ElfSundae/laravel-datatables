<?php

namespace ElfSundae\Laravel\Datatables\Services;

use Yajra\Datatables\Services\DataTable as BaseDataTable;

abstract class DataTable extends BaseDataTable
{
    /**
     * Get attributes for a "static" column that can not be
     * ordered, searched, or exported.
     *
     * @param  string  $name
     * @param  array  $attributes
     * @return $this
     */
    protected function staticColumn($name, array $attributes = [])
    {
        return array_merge([
            'data' => $name,
            'name' => $name,
            'title' => $this->html()->getQualifiedTitle($name),
            'defaultContent' => '',
            'render' => null,
            'orderable' => false,
            'searchable' => false,
            'exportable' => false,
            'printable' => true,
            'footer' => '',
        ], $attributes);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return preg_replace('#datatable$#i', '', class_basename($this)).'-'.date('YmdHis');
    }

    /**
     * Get default builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'order' => [[0, 'desc']],
        ];
    }
}
