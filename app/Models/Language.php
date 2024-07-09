<?php

namespace App\Models;

use App\Services\Sort\ChangeStatusStrategy;
use App\Services\Sort\ChangeStatusTrait;
use App\Services\Sort\SortModelTrait;
use App\Services\Sort\SortStrategy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model implements

    SortStrategy,
    ChangeStatusStrategy

{
    use HasFactory;
    use SortModelTrait;
    use ChangeStatusTrait;

    protected $fillable = [
        'name',
        'code',
        'sort',
        'is_show',
    ];
}
