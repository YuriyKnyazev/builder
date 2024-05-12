<?php

namespace App\Services\Sort;

use Illuminate\Database\Eloquent\Model;

class ModelFactory
{
    public function getModel(string $modelName): Model|SortStrategy|ChangeStatusStrategy
    {
        $className = 'App\\Models\\' . $modelName;
        return new $className();
    }
}
