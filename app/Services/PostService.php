<?php

namespace App\Services;

use App\Dto\CreatePostRequest;
use App\Dto\PostData;
use App\Exceptions\MembershipNotFoundException;
use App\Exceptions\PostNotFoundException;
use App\Exceptions\SideNotFoundException;
use App\Models\Membership;
use App\Models\Post;
use App\Models\Side;
use App\Models\User;
use Spatie\LaravelData\DataCollection;

class PostService
{
    public function createPost(User $user, CreatePostRequest $request)
    {
        $side = Side::where('id', $request->sideId)
            ->firstOr(callback: fn() => throw new SideNotFoundException());

        $membership = Membership::whereBelongsTo($user)
            ->whereBelongsTo($side)
            ->firstOr(callback: fn() => throw new MembershipNotFoundException());

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;

        $post->membership()->associate($membership);

        $post->save();

        return $post->id;
    }
    public function getPostDetail(string $postId)
    {
        $post = Post::where('id', $postId)
            ->firstOr(callback: fn() => throw new PostNotFoundException());

        return PostData::from($post);
    }

    public function getPostList(): DataCollection
    {
        $posts = Post::all();
        return PostData::collect($posts, DataCollection::class);
    }
}
