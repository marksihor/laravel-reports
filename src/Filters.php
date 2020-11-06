<?php

namespace MarksIhor\LaravelReports;

use Carbon\Carbon;

abstract class Filters
{
    public function today(?string $column = 'created_at'): self
    {
        $this->query->whereDate($column, Carbon::today());

        return $this;
    }

    public function yesterday(?string $column = 'created_at'): self
    {
        $this->query->whereDate($column, Carbon::yesterday());

        return $this;
    }

    public function thisWeek(?string $column = 'created_at'): self
    {
        $this->query->whereBetween($column, [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);

        return $this;
    }

    public function thisMonth(?string $column = 'created_at'): self
    {
        $this->query->whereYear($column, date('Y'))
            ->whereMonth('created_at', date('m'));

        return $this;
    }

    public function thisYear(?string $column = 'created_at'): self
    {
        $this->query = $this->query->whereYear($column, date('Y'));

        return $this;
    }
}
