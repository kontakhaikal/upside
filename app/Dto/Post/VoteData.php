<?php

namespace App\Dto\Post;

use App\Dto\VoteType;
use Spatie\LaravelData\Data;

class VoteData extends Data
{
    public function __construct(
        public string $id,
        public VoteType $type
    ) {
    }
}
