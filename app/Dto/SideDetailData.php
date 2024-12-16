<?php

namespace App\Dto;


use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\LoadRelation;
use Spatie\LaravelData\Data;

class SideDetailData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        #[DataCollectionOf(PostData::class)]
        #[LoadRelation]
        public array $posts,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {

    }
}
