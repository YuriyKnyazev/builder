<?php

namespace App\Services\Sort;

interface SortStrategy
{
    public function sort(array $sortIds): void;
}
