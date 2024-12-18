<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $title
 * @property string $body
 * @property int $score
 * @property Membership $membership
 */
class Post extends Model
{
    use HasUuids;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Membership, $this>
     */
    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class, relation: 'membership');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function getScoreAttribute()
    {
        return $this->votes()->sum('type');
    }

}
