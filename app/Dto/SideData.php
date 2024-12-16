<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class SideData extends Data
{
    public function __construct(
        public string $id,
        public string $avatar
    ) {
    }
}
