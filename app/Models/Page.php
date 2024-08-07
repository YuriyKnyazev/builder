<?php

namespace App\Models;

use App\Services\Sort\ChangeStatusStrategy;
use App\Services\Sort\ChangeStatusTrait;
use App\Services\Sort\SortStrategy;
use App\Services\Sort\SortModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * @property string name
 * @property string path
 * @property string cover
 * @property int sort
 * @property boolean is_show
 *
 * @property Collection|Block[] blocks
 */
class Page extends Model implements
    SortStrategy,
    ChangeStatusStrategy
{
    use HasFactory;
    use SortModelTrait;
    use ChangeStatusTrait;

    protected $fillable = [
        'name',
        'path',
        'cover',
        'sort',
        'is_show',
    ];
    public function blocks(): MorphMany
    {
        return $this->morphMany(Block::class, 'block')
            ->orderBy('sort');
    }
}
