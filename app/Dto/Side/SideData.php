<?php

namespace App\Dto\Side;

use App\Models\Post;
use App\Models\Side;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class SideData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        #[DataCollectionOf(PostData::class)]
        public DataCollection $posts,
    ) {
    }

    public static function fromSideModel(Side $side): self
    {
        $posts = $side->posts->map(function (Post $post) {
            return new PostData(
                $post->id,
                $post->title,
                $post->body,
                $post->score,
                new AuthorData(
                    $post->membership->id,
                    $post->membership->user->username
                ),
                1,
                1
            );
        });
        return new SideData(
            $side->id,
            $side->name,
            $side->description,
            PostData::collect($posts, DataCollection::class)
        );
    }
}
