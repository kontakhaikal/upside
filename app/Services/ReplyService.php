<?php

namespace App\Services;

use App\Dto\Reply\GetRepliesRequest;
use App\Dto\Reply\ReplyData;
use App\Models\Reply;
use App\Models\User;
use Spatie\LaravelData\DataCollection;

class ReplyService
{
    /**
     * @param \App\Models\User|null $user
     * @param \App\Dto\Reply\GetRepliesRequest $request
     * @return \Spatie\LaravelData\DataCollection<ReplyData>
     */
    public function getReplies(User|null $user, GetRepliesRequest $request): DataCollection
    {
        $replies = Reply::where('comment_id', $request->commentId)
            ->orderByDesc('created_at')
            ->get();
        return ReplyData::collectFromReplyModel($replies);
    }


}
