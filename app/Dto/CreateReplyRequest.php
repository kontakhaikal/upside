<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;

class CreateReplyRequest extends Data
{
    public function __construct(
        #[FromRouteParameter('postId', false)]
        public string $postId,
        #[FromRouteParameter('commentId', false)]
        public string $commentId,
        #[Uuid()]
        public ?string $replyTo,
        public string $body,
    ) {
    }
}
