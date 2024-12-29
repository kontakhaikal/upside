<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $id
 * @property string $body
 * @property Membership $membership
 * @property Post $post
 * @property int $score
 * @property \Illuminate\Database\Eloquent\Collection<Reply> $replies
 */
class Comment extends Model
{
    use HasUuids, Votable;

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class)->orderByDesc('created_at');
    }
}
