<?php

namespace App\Models;

use App\Services\Sort\ChangeStatusStrategy;
use App\Services\Sort\ChangeStatusTrait;
use App\Services\Sort\SortModelTrait;
use App\Services\Sort\SortStrategy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Menu extends Model implements
    SortStrategy,
    ChangeStatusStrategy
{
    use HasFactory;
    use SortModelTrait;
    use ChangeStatusTrait;

    protected $fillable = [
        'name',
        'sort',
        'is_show'
    ];
    public function block(): MorphOne
    {
        return $this->morphOne(Block::class, 'block');
    }
}
