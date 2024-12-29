<?php

namespace App\Dto\Post;

use App\Dto\VoteType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PostData extends Data
{
    public function __construct(
        public string $id,
        public string $title,
        public string $body,
        public int $score,
        public SideData $side,
        public AuthorData $author,
        public int $createdAt,
        public int $updatedAt,
        public ?VoteData $currentUserVote,
    ) {
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection<\App\Models\Post> $posts
     * @return \Spatie\LaravelData\DataCollection<self>
     */
    public static function collectFromPostModel(Collection $posts, User|null $currentUser): DataCollection
    {
        $postsData = $posts->map(function (Post $post) use ($currentUser) {

            $currentUserVote = $currentUser ? $post->userVote($currentUser) : null;

            return new PostData(
                $post->id,
                $post->title,
                $post->body,
                $post->score,
                new SideData(
                    $post->membership->side->id
                ),
                new AuthorData(
                    $post->membership->user->id,
                    $post->membership->user->username
                ),
                1,
                1,
                $currentUserVote ? new VoteData(
                    $currentUserVote->id,
                    VoteType::fromModel($currentUserVote->type),
                ) : null
            );
        });
        return new DataCollection(self::class, $postsData);
    }

    public static function fromModel(Post $post, User|null $currentUser): self
    {
        $currentUserVote = $currentUser ? $post->userVote($currentUser) : null;

        return new PostData(
            $post->id,
            $post->title,
            $post->body,
            $post->score,
            new SideData(
                $post->membership->side->id
            ),
            new AuthorData(
                $post->membership->user->id,
                $post->membership->user->username
            ),
            1,
            1,
            $currentUserVote ? new VoteData(
                $currentUserVote->id,
                VoteType::fromModel($currentUserVote->type),
            ) : null
        );
    }
}
