<?php

namespace App\Models;

use App\Enums\EventTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string title
 * @property string link
 * @property array old_values
 * @property array new_values
 * @property int user_id
 * @property int type
 * @property Carbon created_at
 *
 */

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'link',
        'old_values',
        'new_values',
        'user_id',
        'type',
    ];
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'type' => EventTypeEnum::class
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
