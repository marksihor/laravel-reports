<?php

namespace MarksIhor\LaravelReports;

use Carbon\Carbon;

abstract class Filters
{
    public static array $periods = ['all', 'yesterday', 'today', 'tomorrow', 'thisWeek', 'thisMonth', 'thisYear', 'future'];

    public function today(?string $column = null): self
    {
        $this->query->whereDate($column ?: 'created_at', Carbon::today());

        return $this;
    }

    public function yesterday(?string $column = null): self
    {
        $this->query->whereDate($column ?: 'created_at', Carbon::yesterday());

        return $this;
    }

    public function tomorrow(?string $column = null): self
    {
        $this->query->whereDate($column ?: 'created_at', Carbon::tomorrow());

        return $this;
    }

    public function thisWeek(?string $column = null): self
    {
        $this->query->whereBetween($column ?: 'created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);

        return $this;
    }

    public function thisMonth(?string $column = null): self
    {
        $this->query->whereYear($column ?: 'created_at', date('Y'))
            ->whereMonth($column ?: 'created_at', date('m'));

        return $this;
    }

    public function thisYear(?string $column = null): self
    {
        $this->query = $this->query->whereYear($column ?: 'created_at', date('Y'));

        return $this;
    }

    public function future(?string $column = null): self
    {
        $this->query->whereDate($column ?: 'created_at', '>', Carbon::now());

        return $this;
    }
}
