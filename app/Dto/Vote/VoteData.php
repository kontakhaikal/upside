<?php

namespace App\Dto\Vote;

use App\Dto\VoteType;

class VoteData
{
    public function __construct(
        public string $id,
        public VoteType $type
    ) {
    }
}
