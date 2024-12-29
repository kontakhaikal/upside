<?php

namespace App\Dto;

use \App\Models\VoteType as ModelVoteType;

enum VoteType: string
{
    case UPVOTE = 'upvote';
    case DOWNVOTE = 'downvote';

    public function toModel(): ModelVoteType
    {
        if ($this == VoteType::DOWNVOTE) {
            return ModelVoteType::DOWNVOTE;
        }
        return ModelVoteType::UPVOTE;
    }

    public static function fromModel(ModelVoteType $type): VoteType
    {
        if (self::DOWNVOTE->name == $type->name) {
            return VoteType::DOWNVOTE;
        }
        return VoteType::UPVOTE;
    }
}
