<?php

namespace App\Services\Sort;

use Illuminate\Support\Facades\DB;

trait SortModelTrait
{
    public function sort(array $sortIds): void
    {
        DB::transaction(function () use ($sortIds) {
            for ($i = 0; $i < count($sortIds); $i++) {
                self::query()
                    ->where('id', $sortIds[$i])
                    ->update(['sort' => $i]);
            }
        });
    }
}
