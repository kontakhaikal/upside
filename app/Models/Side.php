<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 */
class Side extends Model
{
    public $incrementing = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Membership, $this>
     */
    public function members(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(
            Post::class,
            Membership::class,
            'side_id',
            'membership_id'
        );
    }

    /**
     * @param string $userId
     * @return Collection<$this>
     */
    public static function joinedSides(string $userId): Collection
    {
        return self::whereRelation('members', 'user_id', $userId)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<$this>
     */
    public static function popularSides(): Collection
    {
        return self::has('members')
            ->withCount('members')
            ->take(5)
            ->orderBy('member_count', 'desc')
            ->get();
    }

    public function isUserMembership(string $userId): bool
    {
        return $this->members()->where('user_id', $userId)->exists();
    }
}