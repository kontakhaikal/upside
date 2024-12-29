<?php

namespace App\Dto\Reply;

use App\Dto\Author\AuthorData;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ReplyData extends Data
{
    public function __construct(
        public string $id,
        public string $body,
        public AuthorData $author,
        public string $commentId,
        public int $score,
        public ?string $replyTo
    ) {
    }

    /**
     * @param Collection<Reply> $replies
     * @return \Spatie\LaravelData\DataCollection<self>
     */
    public static function collectFromReplyModel(Collection $replies): DataCollection
    {
        $repliesData = $replies->map(
            fn(Reply $reply) =>
            new ReplyData(
                $reply->id,
                $reply->body,
                new AuthorData(
                    $reply->membership->user->id,
                    $reply->membership->user->username
                ),
                $reply->comment->id,
                $reply->score,
                $reply->reply_to
            )
        );
        return new DataCollection(self::class, $repliesData);
    }
}
