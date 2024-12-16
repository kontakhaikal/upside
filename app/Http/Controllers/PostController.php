<?php

namespace App\Http\Controllers;

use App\Dto\CreatePostRequest;
use App\Models\User;
use App\Services\PostService;
use App\Services\SideService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostService $postService, private SideService $sideService)
    {
    }

    public function showCreatePostPage(Request $request)
    {
        $joinedSides = $this->sideService->getJoinedSides($request->user());
        return inertia()->render('Post/CreatePost', ['joinedSides' => $joinedSides]);
    }

    public function processCreatePost(Request $request, CreatePostRequest $createPostRequest)
    {
        $postId = $this->postService->createPost($request->user(), $createPostRequest);
        return redirect()->route('post.show', ['postId' => $postId]);
    }
}
