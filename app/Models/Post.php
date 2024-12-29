<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $id
 * @property string $title
 * @property string $body
 * @property int $score
 * @property Membership $membership
 */
class Post extends Model
{
    use HasUuids, Votable;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Membership, $this>
     */
    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class, relation: 'membership');
    }


    public function userVote(User $user): Vote|null
    {
        return $this->votes()
            ->whereHas(
                'membership',
                fn(Builder $query) =>
                $query->where('user_id', $user->id)
            )->first();
    }
}
