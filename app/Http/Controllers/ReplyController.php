<?php

namespace App\Http\Controllers;

use App\Dto\Reply\GetRepliesRequest;
use App\Services\ReplyService;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct(
        private ReplyService $replyService
    ) {
    }

    public function getReplies(Request $request, GetRepliesRequest $getRepliesRequest)
    {
        $replies = $this->replyService->getReplies($request->user(), $getRepliesRequest);
        return response()->json(['replies' => $replies]);
    }
}
