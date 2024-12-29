<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Votable
{
    public function votes(): MorphMany
    {
        return $this->morphMany(
            Vote::class,
            'votable',
            'votable_type',
            'votable_id'
        );
    }

    public function getScoreAttribute()
    {
        return $this->votes()->sum('type');
    }
}
