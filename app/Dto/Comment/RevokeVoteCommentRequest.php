<?php

namespace App\Dto\Comment;

use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Data;

class RevokeVoteCommentRequest extends Data
{
    public function __construct(
        #[FromRouteParameter('postId')]
        public string $postId,
        #[FromRouteParameter('commentId')]
        public string $commentId,
    ) {
    }
}
