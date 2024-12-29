<?php
namespace App\Models;

enum VoteType: int
{
    case UPVOTE = 1;
    case DOWNVOTE = -1;

}
