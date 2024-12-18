<?php

namespace App\Dto\Side;

use Spatie\LaravelData\Data;

class PopularSideData extends Data
{
    public function __construct(
        public string $id,
        public bool $isMember = false,
    ) {
    }
}
