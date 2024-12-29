<?php

namespace App\Dto\Author;

class AuthorData
{
    public function __construct(
        public string $id,
        public string $username
    ) {
    }
}
