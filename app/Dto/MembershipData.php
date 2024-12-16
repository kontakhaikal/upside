<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class MembershipData extends Data
{
    public function __construct(
        public string $role,
        public bool $pinned
    ) {
    }
}
