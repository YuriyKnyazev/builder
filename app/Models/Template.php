<?php

namespace App\Models;

use App\Observers\TemplateObserver;
use App\Services\Sort\ChangeStatusStrategy;
use App\Services\Sort\ChangeStatusTrait;
use App\Services\Sort\SortModelTrait;
use App\Services\Sort\SortStrategy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @property string name
 * @property string image
 * @property int sort
 * @property boolean is_show
 * @property int type
 * @property int template_id
 *
 *@property Collection|Field[] fields
 */

#[ObservedBy([TemplateObserver::class])]
class Template extends Model implements

    SortStrategy,
    ChangeStatusStrategy

{
    use HasFactory;
    use SortModelTrait;
    use ChangeStatusTrait;

    protected $fillable = [
        'name',
        'image',
        'sort',
        'is_show',
        'type',
        'template_id'
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class)->orderBy('sort');
    }

    public function template(): HasOne
    {
        return $this->hasOne(Template::class)
            ->with('fields.fieldType');
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }
}

