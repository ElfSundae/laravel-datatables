# laravel-datatables

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elfsundae/laravel-datatables.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-datatables)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/ElfSundae/laravel-datatables/master.svg?style=flat-square)](https://travis-ci.org/ElfSundae/laravel-datatables)
[![StyleCI](https://styleci.io/repos/94647284/shield)](https://styleci.io/repos/94647284)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/6fe19cb9-8907-46f6-9f06-644c8bfb5f94.svg?style=flat-square)](https://insight.sensiolabs.com/projects/6fe19cb9-8907-46f6-9f06-644c8bfb5f94)
[![Quality Score](https://img.shields.io/scrutinizer/g/ElfSundae/laravel-datatables.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/laravel-datatables)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ElfSundae/laravel-datatables/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/laravel-datatables/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/elfsundae/laravel-datatables.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-datatables)

## Installation

You can install this package via the [Composer](https://getcomposer.org) manager:

```sh
$ composer require elfsundae/laravel-datatables
```

Then register the service provider by adding the following to the `providers` array in `config/app.php`:

```php
ElfSundae\Laravel\Datatables\DatatablesServiceProvider::class,
```

## Configuration

- To use our eloquent engine, you need config it in `config/datatables.php`:

    ```php
    /*
     * Datatables list of available engines.
     * This is where you can register your custom datatables engine.
     */
    'engines'        => [
        'eloquent'   => ElfSundae\Laravel\Datatables\Engines\EloquentEngine::class,
        // ...
    ],
    ```

    Then make sure you use the factory way `Datatables::of(...)` to create eloquent engine.

    ```php
    class UserDataTable extends DataTable
    {
        /**
         * Build DataTable class.
         *
         * @return \Yajra\Datatables\Engines\BaseEngine
         */
        public function dataTable()
        {
            return $this->datatables
                ->of($this->query());
        }
    ```

## Testing

```sh
$ composer test
```

## License

This package is open-sourced software licensed under the [MIT License](LICENSE.md).
