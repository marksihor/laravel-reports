<?php

namespace MarksIhor\LaravelReports;

use Illuminate\Database\Eloquent\Builder;
use MarksIhor\LaravelFiltering\Filterable;

class Report extends Filters
{
    use Filterable;

    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function filterable()
    {
        $this->query = $this->filter($this->query);

        return $this;
    }

    public function count()
    {
        return $this->query->count();
    }

    public function statistics()
    {
        // dodo
    }
}
