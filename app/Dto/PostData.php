<?php
namespace App\Dto;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\LoadRelation;
use Spatie\LaravelData\Data;

class PostData extends Data
{
    public function __construct(
        public string $id,
        public string $title,
        public string $body,
        public int $score,
        #[LoadRelation]
        public SideData $side,
        #[LoadRelation]
        public AuthorData $author,
        public CarbonImmutable $createdAt,
        public CarbonImmutable $updatedAt,
    ) {
    }
}
