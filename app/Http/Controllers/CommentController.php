<?php

namespace App\Http\Controllers;

use App\Dto\Comment\RevokeVoteCommentRequest;
use App\Dto\Comment\VoteCommentRequest;
use App\Dto\VoteType;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(
        private CommentService $commentService
    ) {
    }
    public function processUpvoteComment(Request $request, string $postId, string $commentId)
    {
        $this->commentService->voteComment(
            $request->user(),
            new VoteCommentRequest(
                $postId,
                $commentId,
                VoteType::UPVOTE
            )
        );
        return back();
    }

    public function processDownvoteComment(Request $request, string $postId, string $commentId)
    {
        $this->commentService->voteComment(
            $request->user(),
            new VoteCommentRequest(
                $postId,
                $commentId,
                VoteType::DOWNVOTE
            )
        );
        return back();
    }

    public function processRevokeCommentVote(
        Request $request,
        RevokeVoteCommentRequest $revokeVoteCommentRequest
    ) {
        $this->commentService
            ->revokeCommentVote($request->user(), $revokeVoteCommentRequest);
        return back();
    }

}
