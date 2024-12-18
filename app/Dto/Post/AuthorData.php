<?php

namespace App\Dto\Post;

use Spatie\LaravelData\Data;

class AuthorData extends Data
{
    public function __construct(
        public string $id,
        public string $username
    ) {
    }
}
