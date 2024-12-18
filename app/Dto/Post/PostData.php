<?php

namespace App\Dto\Post;

use App\Models\Post;
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
    ) {
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection<\App\Models\Post> $posts
     * @return \Spatie\LaravelData\DataCollection<self>
     */
    public static function collectFromPostModel(Collection $posts): DataCollection
    {
        return self::collect($posts->map(function (Post $post) {
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
                1
            );
        }), DataCollection::class);
    }
}
