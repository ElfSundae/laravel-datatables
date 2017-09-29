<?php

namespace ElfSundae\Laravel\DataTables\Services;

use Illuminate\Support\Str;
use Yajra\DataTables\Services\DataTable as BaseDataTable;

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
            'title' => $this->getQualifiedTitle($name),
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
     * Convert string into a readable title.
     *
     * @param  string  $title
     * @return string
     */
    protected function getQualifiedTitle($title)
    {
        return Str::title(str_replace(['.', '_'], ' ', Str::snake($title)));
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
        $url = $this->getRenderedJsString($url);
        $content = $this->getRenderedJsString($content);
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
     * Convert PHP string value to a rendered JavaScript string.
     *
     * @param  string  $string
     * @return string
     */
    protected function getRenderedJsString($string)
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
}
