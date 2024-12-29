<?php

namespace App\Services;


use App\Dto\CreatePostRequest;
use App\Dto\Post\FilteredPostData;
use App\Dto\Post\PostType;
use App\Dto\VotePostRequest;
use App\Exceptions\MembershipNotFoundException;
use App\Exceptions\PostNotFoundException;
use App\Exceptions\SideNotFoundException;
use App\Exceptions\VoteNotFoundException;
use App\Models\Membership;
use App\Models\Post;
use App\Models\Side;
use App\Models\User;
use App\Models\Vote;
use \App\Dto\Post\PostData;

class PostService
{
    public function getPostDetail(User|null $user, string $postId): PostData
    {
        $post = Post::where('id', $postId)
            ->firstOr(fn() => throw new PostNotFoundException());
        return PostData::fromModel($post, $user);
    }

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


    public function getFilteredPostList(User|null $user, PostType $filter)
    {
        $posts = Post::with(['membership' => ['user', 'side']])->get();
        return FilteredPostData::fromPostModel($filter, $posts, $user);
    }

    public function votePost(User $user, VotePostRequest $request)
    {
        $post = Post::find($request->postId)
            ->firstOr(fn() => throw new PostNotFoundException());

        $membership = Membership::whereBelongsTo($post->membership->side)
            ->whereBelongsTo($user)
            ->firstOr(fn() => throw new MembershipNotFoundException());

        /** @var Vote */
        $vote = Vote::whereBelongsTo($membership)
            ->whereMorphedTo('votable', $post)
            ->first();

        $voteType = $request->voteType->toModel();

        if (is_null($vote)) {
            $vote = new Vote();
            $vote->type = $voteType;
            $vote->votable()->associate($post);
            $vote->membership()->associate($membership);
            $vote->save();
            return;
        }

        if ($vote->type == $voteType) {
            return;
        }

        $vote->type = $voteType;
        $vote->save();
    }

    public function revokePost(User $user, string $postId)
    {
        $post = Post::find($postId)
            ->firstOr(fn() => throw new PostNotFoundException());

        $membership = Membership::whereBelongsTo($post->membership->side)
            ->whereBelongsTo($user)
            ->firstOr(fn() => throw new MembershipNotFoundException());

        /** @var Vote */
        $vote = Vote::whereBelongsTo($membership)
            ->whereBelongsTo($post)
            ->firstOr(fn() => throw new VoteNotFoundException());

        $vote->delete();
    }
}
