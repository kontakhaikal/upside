<?php

namespace App\Http\Controllers;

use App\Dto\CreateCommentRequest;
use App\Dto\CreatePostRequest;
use App\Dto\CreateReplyRequest;
use App\Dto\VotePostRequest;
use App\Dto\VoteType;
use App\Models\User;
use App\Services\CommentService;
use App\Services\PostService;
use App\Services\SideService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private CommentService $commentService,
        private PostService $postService,
        private SideService $sideService
    ) {
    }

    public function showPostDetailPage(string $postId, Request $request)
    {
        $post = $this->postService->getPostDetail($request->user(), $postId);
        $comments = $this->commentService->getComments();
        return inertia()->render('Post/PostDetail', [
            'post' => $post,
            'comments' => fn() => $comments,
        ]);
    }

    public function showCreatePostPage(Request $request)
    {
        $joinedSides = $this->sideService->getJoinedSides($request->user());
        return inertia()->render(
            'Post/CreatePost',
            ['joinedSides' => $joinedSides]
        );
    }

    public function processCreatePost(Request $request, CreatePostRequest $createPostRequest)
    {
        $postId = $this->postService
            ->createPost($request->user(), $createPostRequest);
        return redirect()->route('post.show', ['postId' => $postId]);
    }

    public function processUpvotePost(string $sideId, Request $request)
    {
        $this->postService->votePost(
            $request->user(),
            new VotePostRequest(
                $sideId,
                VoteType::UPVOTE
            )
        );
    }

    public function processDownvotePost(string $sideId, Request $request)
    {
        $this->postService->votePost(
            $request->user(),
            new VotePostRequest(
                $sideId,
                VoteType::DOWNVOTE
            )
        );
        return back();
    }

    public function processRevokeVotePost(string $sideId, Request $request)
    {
        $this->postService->revokePost($request->user(), $sideId);
        return back();
    }

    public function processCreateComment(
        Request $request,
        CreateCommentRequest $createCommentRequest
    ) {
        $this->commentService->createComment($request->user(), $createCommentRequest);
        return back();
    }

    public function processCreateReply(
        Request $request,
        CreateReplyRequest $createReplyRequest
    ) {
        $this->commentService->createReply($request->user(), $createReplyRequest);
        return back();
    }
}
