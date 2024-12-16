<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class CreatePostRequest extends Data
{
    public function __construct(
        public string $title,
        public string $body,
        #[FromRouteParameter('sideId', false)]
        #[Exists(table: 'sides', column: 'id')]
        public string $sideId
    ) {
    }
}
