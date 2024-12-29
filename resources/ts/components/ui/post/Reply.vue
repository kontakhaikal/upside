<script lang="ts">
export interface ReplyProps {
    id: string
    body: string
    commentId: string
    score: number
    replyTo: string
    author: { id: string; username: string }
}

export type ReplyRegistry = Map<string, ReplyProps>
</script>

<script setup lang="ts">
import {
    ChevronDownIcon,
    ChevronUpIcon,
    MessageCirclePlusIcon,
} from 'lucide-vue-next'
import { computed } from 'vue'
import { Avatar, AvatarFallback, AvatarImage } from '../avatar'
import { Button } from '../button'
import { Card } from '../card'
import WriteReplyDialog from './WriteReplyDialog.vue'

const props = defineProps<{
    postId: string
    reply: ReplyProps
    replyRegistry: ReplyRegistry
}>()

const replyTo = computed(() => props.replyRegistry.get(props.reply.replyTo))
</script>

<template>
    <Card :id="reply.id">
        <div class="flex items-center p-2 border-b gap-x-2">
            <Avatar>
                <AvatarImage src="s" />
                <AvatarFallback>
                    <div
                        class="grid font-semibold capitalize place-items-center">
                        <p>
                            {{ reply.author.username.charAt(0) }}
                        </p>
                    </div>
                </AvatarFallback>
            </Avatar>
            <p>{{ reply.author.username }}</p>
        </div>
        <div class="flex items-center p-2 gap-x-2">
            <a
                :href="`#${replyTo.id}`"
                v-if="replyTo"
                class="px-2 py-0 text-sm border rounded-md bg-secondary">
                {{ replyTo.author.username }}
            </a>
            <div>{{ reply.body }}</div>
        </div>
        <div class="flex items-center w-full py-3 border-b gap-x-4">
            <div class="flex items-center pl-3">
                <Button class="p-3" variant="ghost">
                    <ChevronUpIcon />
                </Button>
                <p class="p-3">{{ reply.score }}</p>
                <Button class="p-3" variant="ghost">
                    <ChevronDownIcon />
                </Button>
            </div>
            <WriteReplyDialog
                :commendable="reply"
                :post-id="postId"
                :reply-to="reply.id">
                <Button class="p-3" variant="ghost">
                    <MessageCirclePlusIcon />
                </Button>
            </WriteReplyDialog>
        </div>
    </Card>
</template>
