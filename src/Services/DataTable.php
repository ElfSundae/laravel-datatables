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
            'title' => $this->builder()->getQualifiedTitle($name),
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
     * Get render Closure for an <a> link.
     *
     * @param  string  $url  "/uri/to/{data}/{full.otherData}"
     * @param  string  $content  "{data} content"
     * @param  string  $class
     * @return Closure
     */
    protected function linkRender($url = '{data}', $content = '{data}', $class = '')
    {
        $url = $this->parseForEmbedJsString($url);
        $content = $this->parseForEmbedJsString($content);
        $class = $class ? ' class="'.$class.'"' : '';

        return function () use ($url, $content, $class) {
            return <<<JS
function (data, type, full, meta) {
    if (type === 'display' && data) {
        return '<a href=\"'+ {$url} +'\"{$class}>'+ {$content} +'</a>';
    }
    return data;
}
JS;
        };
    }

    /**
     * Parse the given string, return the emmbed Javascript string,
     * for JS string concat.
     *
     * @param  string  $string
     * @return string
     */
    protected function parseForEmbedJsString($string)
    {
        return "'".str_replace(['{', '}'], ["'+", "+'"], $string)."'";
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
