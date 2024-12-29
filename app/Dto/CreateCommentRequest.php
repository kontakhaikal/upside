<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Data;

class CreateCommentRequest extends Data
{
    public function __construct(
        #[FromRouteParameter('postId', false)]
        public string $postId,
        public string $body,
    ) {
    }
}
