<?php

namespace App\Http\Controllers;

use App\Services\SideService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private SideService $sideService
    ) {
    }
    public function showHomePage(Request $request)
    {
        $user = $request->user();
        $popularSides = $this->sideService->getPopularSides($user);
        $joinedSides = $user ? $this->sideService->getJoinedSides($user) : [];
        return inertia()->render('Home', [
            'popularSides' => $popularSides,
            'joinedSides' => $joinedSides,
            'posts' => [],
        ]);
    }
}
