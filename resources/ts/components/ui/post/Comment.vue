<script lang="ts">
export interface CommentProps {
    id: string
    body: string
    author: {
        id: string
        username: string
    }
    score: number
    replies: ReplyProps[]
    currentUserVote?: {
        id: string
        type: 'upvote' | 'downvote'
    }
}
</script>

<script lang="ts" setup>
import Vote from '@/components/Vote.vue'
import { router } from '@inertiajs/vue3'
import { MessageCircleMoreIcon, MessageCirclePlusIcon } from 'lucide-vue-next'
import { ref } from 'vue'
import { Avatar, AvatarFallback, AvatarImage } from '../avatar'
import { Button } from '../button'
import { Card, CardContent, CardFooter, CardHeader } from '../card'
import { ReplyProps } from './Reply.vue'
import ReplyManager from './ReplyManager.vue'
import WriteReplyDialog from './WriteReplyDialog.vue'

const props = defineProps<{ postId: string; comment: CommentProps }>()

const showedReply = ref(false)
const showReply = () => {
    showedReply.value = true
}
const toggleShowedReply = () => {
    showedReply.value = !showedReply.value
}

const processing = ref(false)

const upVoteComment = () => {
    router.post(`/p/${props.postId}/c/${props.comment.id}/_upvote`, undefined, {
        onStart: () => (processing.value = true),
        onFinish: () => (processing.value = false),
        preserveScroll: true,
    })
}

const downVoteComment = () => {
    router.post(
        `/p/${props.postId}/c/${props.comment.id}/_downvote`,
        undefined,
        {
            onStart: () => (processing.value = true),
            onFinish: () => (processing.value = false),
            preserveScroll: true,
        }
    )
}

const revokeVoteComment = () => {
    router.post(
        `/p/${props.postId}/c/${props.comment.id}/_revoke-vote`,
        undefined,
        {
            onStart: () => (processing.value = true),
            onFinish: () => (processing.value = false),
            preserveScroll: true,
        }
    )
}
</script>

<template>
    <Card :id="props.comment.id">
        <CardHeader class="p-3 border-b">
            <div class="flex items-center gap-x-2">
                <Avatar>
                    <AvatarImage src="s" />
                    <AvatarFallback>
                        <div
                            class="grid font-semibold capitalize place-items-center">
                            <p>
                                {{ comment.author.username.charAt(0) }}
                            </p>
                        </div>
                    </AvatarFallback>
                </Avatar>
                <p>{{ comment.author.username }}</p>
            </div>
        </CardHeader>
        <CardContent class="p-3">{{ comment.body }} </CardContent>
        <CardFooter class="block p-0">
            <div class="flex items-center w-full py-3 border-b gap-x-4">
                <Vote
                    class="pl-3"
                    :current-vote="comment.currentUserVote?.type"
                    :down-vote="downVoteComment"
                    :up-vote="upVoteComment"
                    :score="comment.score"
                    :processing
                    :revoke-vote="revokeVoteComment" />

                <Button class="p-3" variant="ghost" @click="toggleShowedReply">
                    <MessageCircleMoreIcon />
                </Button>

                <WriteReplyDialog
                    :on-replied="showReply"
                    :commendable="{ ...comment, commentId: comment.id }"
                    :post-id="postId">
                    <Button class="p-3" variant="ghost">
                        <MessageCirclePlusIcon />
                    </Button>
                </WriteReplyDialog>
            </div>
            <ReplyManager
                :comment-id="comment.id"
                :post-id="postId"
                v-if="showedReply" />
        </CardFooter>
    </Card>
</template>
