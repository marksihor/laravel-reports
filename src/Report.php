<?php

namespace MarksIhor\LaravelReports;

use Illuminate\Database\Eloquent\Builder;
use MarksIhor\LaravelFiltering\Filterable;

class Report extends Filters
{
    use Filterable;

    protected $query;
    protected ?string $sumColumn = null;
    protected ?string $groupColumn = null;
    protected bool $withQuantity = false;
    protected bool $withSum = false;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function filterable(): self
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

    public function setSumColumn(string $column): self
    {
        $this->sumColumn = $column;

        return $this;
    }

    public function withQuantity(): self
    {
        $this->withQuantity = true;

        return $this;
    }

    public function setGroupColumn(string $column): self
    {
        $this->groupColumn = $column;

        return $this;
    }

    public function make()
    {
        if ($this->groupColumn) {
            $this->query->select($this->groupColumn)->groupBy($this->groupColumn);
        }

        if ($this->sumColumn) {
            $this->query->selectRaw('sum(' . $this->sumColumn . ') as sum');
        }

        if ($this->withQuantity) {
            $this->query->selectRaw('count(*) as quantity');
        }

        return $this->query->get();
    }

    public function sum()
    {
        return $this->query->sum($this->sumColumn);
    }
}
