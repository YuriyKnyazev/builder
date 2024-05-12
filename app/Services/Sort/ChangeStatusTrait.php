<?php

namespace App\Services\Sort;

trait ChangeStatusTrait
{
    public function changeStatus(int $id): void
    {
        /* @var SortStrategy $model */
        $model = self::query()->find($id);
        $model->update(['is_show' => !$model->is_show]);
    }
}
