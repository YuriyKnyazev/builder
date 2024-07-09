<?php

namespace App\Models;

use App\Services\Sort\ChangeStatusStrategy;
use App\Services\Sort\ChangeStatusTrait;
use App\Services\Sort\SortModelTrait;
use App\Services\Sort\SortStrategy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'template_type',
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
}

