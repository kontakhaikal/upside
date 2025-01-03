<?php

namespace App\Services;

use App\Dto\Comment\CommentData;
use App\Dto\Comment\RevokeVoteCommentRequest;
use App\Dto\Comment\VoteCommentRequest;
use App\Dto\CreateCommentRequest;
use App\Dto\CreateReplyRequest;
use App\Exceptions\CommentNotFoundException;
use App\Exceptions\MembershipNotFoundException;
use App\Exceptions\PostNotFoundException;
use App\Exceptions\VoteNotFoundException;
use App\Models\Comment;
use App\Models\Membership;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use App\Models\Vote;
use Spatie\LaravelData\DataCollection;

class CommentService
{
    public function createComment(User $user, CreateCommentRequest $request)
    {
        $post = Post::with('membership.side')
            ->where('id', $request->postId)
            ->firstOr(callback: fn() => throw new PostNotFoundException());

        $membership = Membership::whereBelongsTo($post->membership->side)
            ->whereBelongsTo($user)
            ->firstOr(callback: fn() => throw new MembershipNotFoundException());

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post()->associate($post);
        $comment->membership()->associate($membership);

        $comment->save();
    }

    public function getComments(?User $user): DataCollection
    {
        $comments = Comment::with('membership.user', 'post')
            ->orderByDesc('created_at')->get();
        return CommentData::collectFromCommentModel($comments, $user);
    }

    public function createReply(User $user, CreateReplyRequest $request)
    {

        $comment = Comment::where('id', $request->commentId)
            ->where('post_id', $request->postId)
            ->firstOr(callback: fn() => throw new CommentNotFoundException());

        $membership = Membership::whereBelongsTo($comment->membership->side)
            ->whereBelongsTo($user)
            ->firstOr(callback: fn() => throw new MembershipNotFoundException());

        $reply = new Reply();
        $reply->body = $request->body;
        $reply->reply_to = $request->replyTo;
        $reply->membership()->associate($membership);
        $reply->comment()->associate($comment);

        $reply->save();
    }

    public function voteComment(User $user, VoteCommentRequest $request)
    {
        $comment = Comment::where('id', $request->commentId)
            ->where('post_id', $request->postId)
            ->firstOr(callback: fn() => throw new CommentNotFoundException());

        $membership = Membership::whereBelongsTo($comment->membership->side)
            ->whereBelongsTo($user)
            ->firstOr(callback: fn() => throw new MembershipNotFoundException());

        /** @var Vote */
        $vote = Vote::whereBelongsTo($membership)
            ->whereMorphedTo('votable', $comment)
            ->first();

        $voteType = $request->voteType->toModel();

        if (is_null($vote)) {
            $vote = new Vote();
            $vote->type = $voteType;
            $vote->votable()->associate($comment);
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

    public function revokeCommentVote(User $user, RevokeVoteCommentRequest $request)
    {
        $comment = Comment::where('id', $request->commentId)
            ->where('post_id', $request->postId)
            ->firstOr(callback: fn() => throw new CommentNotFoundException());

        $membership = Membership::whereBelongsTo($comment->membership->side)
            ->whereBelongsTo($user)
            ->firstOr(callback: fn() => throw new MembershipNotFoundException());

        /** @var Vote */
        $vote = Vote::whereBelongsTo($membership)
            ->whereMorphedTo('votable', $comment)
            ->firstOr(callback: fn() => throw new VoteNotFoundException());

        $vote->delete();
    }
}
