<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property Role $role
 * @property User $user
 * @property Side $side
 */
class Membership extends Model
{
    use HasUuids;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id',
            'user'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Side, $this>
     */
    public function side(): BelongsTo
    {
        return $this->belongsTo(
            Side::class,
            'side_id',
            'id',
            'side'
        );
    }
}
