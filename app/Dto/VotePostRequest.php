<?php

namespace App\Dto;

use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Data;

class VotePostRequest extends Data
{
    public function __construct(
        #[FromRouteParameter('sideId', false)]
        public string $postId,

        #[Enum(VoteType::class)]
        public VoteType $voteType,
    ) {
    }

}
