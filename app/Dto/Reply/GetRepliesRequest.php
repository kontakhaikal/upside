<?php

namespace App\Dto\Reply;

use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Data;

class GetRepliesRequest extends Data
{
    public function __construct(
        #[FromRouteParameter('postId', false)]
        public string $postId,
        #[FromRouteParameter('commentId', false)]
        public string $commentId
    ) {

    }
}
