<script setup lang="ts">
import { computed } from 'vue'
import Reply, { ReplyProps } from './Reply.vue'

const props = defineProps<{ postId: string; commentId: string }>()

const { replies } = await fetch(`/p/${props.postId}/c/${props.commentId}/r`, {
    credentials: 'include',
}).then((res) => res.json() as Promise<{ replies: ReplyProps[] }>)

const registry = computed(() => {
    const m: Map<string, ReplyProps> = new Map()
    replies.forEach((r) => m.set(r.id, r))
    return m
})
</script>

<template>
    <ul
        class="flex flex-col p-4 gap-y-2 bg-secondary dark:bg-primary-foreground rounded-b-md">
        <li v-for="reply in replies" :key="reply.id">
            <Reply :reply :post-id="postId" :reply-registry="registry" />
        </li>
    </ul>
</template>
