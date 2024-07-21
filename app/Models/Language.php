<?php

namespace App\Models;

use App\Observers\LanguageObserver;
use App\Services\Sort\ChangeStatusStrategy;
use App\Services\Sort\ChangeStatusTrait;
use App\Services\Sort\SortModelTrait;
use App\Services\Sort\SortStrategy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string code
 * @property int sort
 * @property boolean is_show
 *
 */
#[ObservedBy([LanguageObserver::class])]
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
