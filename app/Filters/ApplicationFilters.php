<?php

namespace App\Filters;


class ApplicationFilters extends QueryFilter
{
    public function closed ($closed = false)
    {
        return $this->builder->where('closed', $closed);
    }

    public function answered ($answered = false)
    {
        return $this->builder->where('answered', $answered);
    }

    public function viewed ($viewed = false)
    {
        return $this->builder->where('viewed', $viewed);
    }
}