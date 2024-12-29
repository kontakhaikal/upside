<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $body
 * @property string $reply_to
 * @property int $score
 */
class Reply extends Model
{
    use HasUuids, Votable;

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
