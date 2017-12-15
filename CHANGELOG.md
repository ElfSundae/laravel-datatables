# Release Notes

## 2.4.0 (2017-12-16)

- Updated `yajra/laravel-datatables-html` to `~3.3`

## 2.3.0 (2017-11-27)

- Removed custom `EloquentDataTable`
- Removed custom `Html\Builder`
- Refactored `DataTables` factory

## 2.2.1 (2017-11-26)

- Change selected columns to `['*']` for `make` stub [20e3843](https://github.com/ElfSundae/laravel-datatables/commit/20e3843cc258b182155daf5cc1267ab34ba95267)
- Remove "action" column for `make` stub [f793d02](https://github.com/ElfSundae/laravel-datatables/commit/f793d02e643f915528fcae68dc16b5dbc32c4382)

## 2.2.0 (2017-10-13)

- Update `yajra/laravel-datatables-html` to `~3.2`
- Remove methods that have already merged into the original yajra packages
- Remove methods `stripedTable`, `hoveredTable` from Html Builder
- Remove `addColumns` from `EloquentDataTable` since the original class has added https://github.com/yajra/laravel-datatables/pull/1416
- Change default filename for exporting to "classname_Ymd_His"

## 2.1.0 (2017-10-07)

- Automatic configure `datatables.engines.eloquent` and `datatables-buttons.stub`

## 2.0.0 (2017-09-29)

- Update `yajra/laravel-datatables-oracle` to v8.x
- Rename namespace From `ElfSundae\Laravel\Datatables` to `ElfSundae\Laravel\DataTables`
- Remove `ElfSundae\Laravel\Datatables\Datatables`
- Rename `ElfSundae\Laravel\Datatables\Engines\EloquentEngine` to `ElfSundae\Laravel\DataTables\EloquentDataTable`
- Remove `addColumn()` and add `addColumns()` to `EloquentDataTable`
- Update `datatables.stub`

## 1.0.0 (2017-06-18)

- Initial release
