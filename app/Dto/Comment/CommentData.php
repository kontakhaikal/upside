<?php

namespace App\Dto\Comment;

use App\Dto\Author\AuthorData;
use App\Dto\Vote\VoteData;
use App\Dto\VoteType;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CommentData extends Data
{
    public function __construct(
        public string $id,
        public string $postId,
        public string $body,
        public AuthorData $author,
        public int $score,
        public ?VoteData $currentUserVote
    ) {
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $comments
     * @return \Spatie\LaravelData\DataCollection<self>
     */
    public static function collectFromCommentModel(Collection $comments, ?User $currentUser): DataCollection
    {

        $commentsData = $comments->map(
            function (Comment $comment) use ($currentUser) {
                $vote = $currentUser ? $comment->userVote($currentUser) : null;
                return new CommentData(
                    $comment->id,
                    $comment->post->id,
                    $comment->body,
                    new AuthorData(
                        $comment->membership->user->id,
                        $comment->membership->user->username,
                    ),
                    $comment->score,
                    $vote ? new VoteData(
                        $vote->id,
                        VoteType::fromModel($vote->type)
                    ) : null
                );
            }
        );
        return new DataCollection(self::class, $commentsData);
    }
}
