<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class JoinedSideData extends Data
{
    public function __construct(
        public string $id,
    ) {
    }
}
