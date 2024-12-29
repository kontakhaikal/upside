<?php

namespace App\Dto\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class FilteredPostData extends Data
{
    public function __construct(
        public PostType $filter,
        #[DataCollectionOf(PostData::class)]
        public DataCollection $posts,
    ) {
    }

    public static function fromPostModel(PostType $filter, Collection $posts, User|null $currentUser): self
    {
        return new FilteredPostData(
            $filter,
            PostData::collectFromPostModel($posts, $currentUser)
        );
    }
}
