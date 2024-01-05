<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class NewsPost extends Model
{
    use HasFactory;

    protected $table = 'news_posts';

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'date',
        'tags'         => 'array',
        'location'     => 'array',
        'data'         => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDescriptionAttribute()
    {
        return Str::limit($this->content, 100);
    }
}
