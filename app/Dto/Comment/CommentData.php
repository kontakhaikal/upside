<?php

namespace App\Dto\Comment;

use App\Dto\Author\AuthorData;
use App\Models\Comment;
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
    ) {
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $comments
     * @return \Spatie\LaravelData\DataCollection<self>
     */
    public static function collectFromCommentModel(Collection $comments): DataCollection
    {
        $commentsData = $comments->map(
            fn(Comment $comment) =>
            new CommentData(
                $comment->id,
                $comment->post->id,
                $comment->body,
                new AuthorData(
                    $comment->membership->user->id,
                    $comment->membership->user->username,
                ),
                $comment->score,
            )
        );
        return new DataCollection(self::class, $commentsData);
    }
}
