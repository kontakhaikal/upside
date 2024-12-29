<?php

namespace App\Http\Controllers;

use App\Dto\CreateSideRequest;
use App\Services\SideService;
use Illuminate\Http\Request;

class SideController extends Controller
{
    public function __construct(private SideService $sideService)
    {
    }

    public function showCreateSidePostPage(string $sideId, Request $request)
    {

        return inertia()->render('Side/CreateSidePost', ['sideId' => $sideId]);
    }

    public function showCreateSidePage(Request $request)
    {
        return inertia()->render('Side/CreateSide');
    }

    public function showSidePage(string $sideId, Request $request)
    {
        $side = $this->sideService->getSideDetail($sideId);
        return inertia()->render('Side/SideDetail', ['side' => $side]);
    }

    public function processCreateSide(Request $request, CreateSideRequest $createSideRequest)
    {
        $sideId = $this->sideService->createSide($request->user(), $createSideRequest);
        return redirect()->route('side.show', parameters: ['sideId' => $sideId]);
    }

    public function processJoinSide(string $sideId, Request $request)
    {
        $sideId = $this->sideService->joinSide($request->user(), $sideId);
        return redirect()->back();
    }
}

