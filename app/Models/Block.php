<?php

namespace App\Models;

use App\Services\Sort\ChangeStatusStrategy;
use App\Services\Sort\ChangeStatusTrait;
use App\Services\Sort\SortModelTrait;
use App\Services\Sort\SortStrategy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Block extends Model implements
    SortStrategy,
    ChangeStatusStrategy
{
    use HasFactory;
    use SortModelTrait;
    use ChangeStatusTrait;

    protected $fillable = [
        'sort',
        'is_show',
        'template_id',
        'block_id',
        'block_type'

    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function fieldContents(): HasMany
    {
      return $this->hasMany(FieldContent::class);
    }
    public function blocks(): MorphMany
    {
        return $this->morphMany(Block::class, 'block')
            ->orderBy('sort');
    }
}
