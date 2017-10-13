# Laravel DataTables

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elfsundae/laravel-datatables.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-datatables)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/ElfSundae/laravel-datatables/master.svg?style=flat-square)](https://travis-ci.org/ElfSundae/laravel-datatables)
[![StyleCI](https://styleci.io/repos/94647284/shield)](https://styleci.io/repos/94647284)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/6fe19cb9-8907-46f6-9f06-644c8bfb5f94.svg?style=flat-square)](https://insight.sensiolabs.com/projects/6fe19cb9-8907-46f6-9f06-644c8bfb5f94)
[![Quality Score](https://img.shields.io/scrutinizer/g/ElfSundae/laravel-datatables.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/laravel-datatables)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ElfSundae/laravel-datatables/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/ElfSundae/laravel-datatables/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/elfsundae/laravel-datatables.svg?style=flat-square)](https://packagist.org/packages/elfsundae/laravel-datatables)

This package is an extended package based on [yajra/laravel-datatables](https://github.com/yajra/laravel-datatables).

## Installation

```sh
$ composer require elfsundae/laravel-datatables
```

Then register the service provider in `config/app.php` or `AppServiceProvider`:

```php
'providers' => [
    // ...
    ElfSundae\Laravel\DataTables\DataTablesServiceProvider::class,
]
```

Or:

```php
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->isAdminSite()) {
            $this->app->register(\ElfSundae\Laravel\DataTables\DataTablesServiceProvider::class);
        }
    }
}
```

## Usage

Before getting started, make sure you have read the original [Laravel DataTables Documentation](https://yajrabox.com/docs/laravel-datatables).

## Testing

```sh
$ composer test
```

## License

This package is open-sourced software licensed under the [MIT License](LICENSE.md).
