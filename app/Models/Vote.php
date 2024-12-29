<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property VoteType $type
 */
class Vote extends Model
{
    use HasUuids;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo<Post|Comment, $this>
     */
    public function votable(): MorphTo
    {
        return $this->morphTo('votable', 'votable_type', 'votable_id');
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }
    protected function casts(): array
    {
        return [
            'type' => VoteType::class
        ];
    }
}
