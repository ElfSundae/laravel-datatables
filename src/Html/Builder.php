<?php

namespace ElfSundae\Laravel\DataTables\Html;

use Illuminate\Support\Arr;
use Yajra\DataTables\Html\Builder as BaseBuilder;

class Builder extends BaseBuilder
{
    /**
     * Setup "ajax" parameter with POST method.
     *
     * @param  string|array  $attributes
     * @return $this
     */
    public function postAjax($attributes = [])
    {
        if (! is_array($attributes)) {
            $attributes = ['url' => (string) $attributes];
        }

        if (app()->bound('session') && $token = app('session')->token()) {
            $attributes = Arr::add($attributes, 'headers.X-CSRF-TOKEN', $token);
        }

        return $this->ajax(array_merge(
            Arr::except($attributes, 'method'),
            ['type' => 'POST']
        ));
    }
}
