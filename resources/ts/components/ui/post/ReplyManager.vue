<script setup lang="ts">
import { useQuery } from '@tanstack/vue-query'
import { onMounted, ref } from 'vue'
import Reply, { ReplyProps } from './Reply.vue'

const props = defineProps<{ commentId: string; postId: string }>()

const registry = ref<Map<string, ReplyProps>>(new Map())

const { data, suspense } = useQuery<{
    replies: ReplyProps[]
}>({
    queryKey: [`replies-${props.commentId}`],
    queryFn: async () =>
        fetch(`/p/${props.postId}/c/${props.commentId}/r`)
            .then((r) => r.json() as Promise<{ replies: ReplyProps[] }>)
            .then((r) => {
                r.replies.forEach((reply) =>
                    registry.value.set(reply.id, reply)
                )
                return r
            }),
})

onMounted(async () => {
    const result = await suspense()
    if (result.isSuccess) {
        window.location.replace(`#${props.commentId}`)
    }
})
</script>

<template>
    <ul
        v-if="data"
        class="flex flex-col p-4 gap-y-2 bg-secondary dark:bg-primary-foreground rounded-b-md">
        <li v-for="reply in data.replies" :key="reply.id">
            <Reply :reply :post-id="postId" :reply-registry="registry" />
        </li>
    </ul>
</template>
