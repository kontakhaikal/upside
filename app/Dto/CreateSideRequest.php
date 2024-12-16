<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\Validation\AlphaNumeric;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class CreateSideRequest extends Data
{
    public function __construct(
        #[AlphaNumeric]
        #[Min(6)]
        #[Max(24)]
        #[Unique(table: 'sides', column: 'id')]
        public string $id,

        #[Unique(table: 'sides', column: 'name')]
        public string $name,

        #[Max(1_000)]
        public string $description
    ) {

    }
}
