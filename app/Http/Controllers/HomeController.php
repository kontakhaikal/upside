<?php

namespace App\Http\Controllers;

use App\Dto\Post\PostType;
use App\Services\PostService;
use App\Services\SideService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private SideService $sideService,
        private PostService $postService,
    ) {
    }
    public function showHomePage(Request $request)
    {
        $filter = PostType::tryFrom($request->query('posts', PostType::default()));

        if (is_null($filter)) {
            return redirect()->to('/?posts=' . PostType::default());
        }
        $user = $request->user();
        return inertia()->render('Home', [
            'popularSides' => fn() => $this->sideService->getPopularSides($user),
            'joinedSides' => fn() => $user ? $this->sideService->getJoinedSides($user) : [],
            'filteredPost' => fn() => $this->postService->getFilteredPostList($user, $filter),
        ]);
    }
}
