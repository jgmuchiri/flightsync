<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeIsPrivate(Builder $query): void
    {
        $query->where('is_private', true);
    }

    public function parentTopic(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childrenTopics(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, 'forum_users');
    }
}
