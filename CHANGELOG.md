# Release Notes

## Unreleased

- Update `yajra/laravel-datatables-html` to `~3.2`
- Remove methods that have already merged into the original yajra packages
- Remove methods `stripedTable`, `hoveredTable` from Html Builder

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
