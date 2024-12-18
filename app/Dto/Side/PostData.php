<?php

namespace App\Dto\Side;


use Spatie\LaravelData\Data;

class PostData extends Data
{
    public function __construct(
        public string $id,
        public string $title,
        public string $body,
        public int $score,
        public AuthorData $author,
        public int $createdAt,
        public int $updatedAt,
    ) {
    }
}
