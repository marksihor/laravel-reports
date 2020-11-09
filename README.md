# laravel-reports
Laravel reports based on eloquent queries.

## Installing

```shell
composer require marksihor/laravel-reports -vvv
```

## Examples

```php
$report = (new Report($query))
            ->filterable()
            ->setSumColumn('total')
            ->setGroupColumn('status')
            ->withQuantity()
            ->make();

$report = (new Report($query))->filterable()->today()->count();
$report = (new Report($query))->filterable()->tomorrow()->count();
$report = (new Report($query))->filterable()->yesterday()->count();
$report = (new Report($query))->filterable()->thisWeek()->count();
$report = (new Report($query))->filterable()->thisMonth()->count();
$report = (new Report($query))->filterable()->thisYear()->count();
$report = (new Report($query))->filterable()->future()->count();
```

## License

MIT