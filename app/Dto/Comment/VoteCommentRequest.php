<?php

namespace App\Dto\Comment;

use App\Dto\VoteType;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Data;

class VoteCommentRequest extends Data
{
    public function __construct(
        public string $postId,
        public string $commentId,
        public VoteType $voteType,
    ) {
    }
}
