<?php

namespace App\Dto\Post;

use Spatie\LaravelData\Data;

class SideData extends Data
{
    public function __construct(
        public string $id
    ) {
    }
}
