<?php

namespace App\Services\Sort;

interface ChangeStatusStrategy
{
    public function changeStatus(int $id): void;
}
