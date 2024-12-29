<script lang="ts">
export interface UserProps {
    id: string
    avatar: string
    username: string
}

export interface SideProps {
    id: string
    avatar: string
}

export interface PostProps {
    id: string
    title: string
    body: string
    side: SideProps
    author: UserProps
    score: number
    createdAt: number
    updatedAt: number
    currentUserVote?: {
        id: string
        type: 'upvote' | 'downvote'
    }
}
</script>

<script setup lang="ts">
import { abbreviate, since } from '@/lib/utils'
import { Link, router } from '@inertiajs/vue3'
import {
    ChevronDownIcon,
    ChevronUpIcon,
    MessageCircleIcon,
} from 'lucide-vue-next'
import { computed, ref } from 'vue'
import { Avatar, AvatarFallback, AvatarImage } from '../avatar'
import { Button } from '../button'
import { Card, CardContent, CardFooter, CardHeader } from '../card'

const props = defineProps<{ post: PostProps; refreshKey?: string[] }>()

const currentVote = computed(() => props.post.currentUserVote?.type)

const processing = ref(false)

const upVote = () => {
    router.post(`/p/${props.post.id}/_upvote`, undefined, {
        onStart: () => (processing.value = true),
        onFinish: () => (processing.value = false),
        only: ['filteredPost', 'post'],
    })
}

const downVote = () => {
    router.post(`/p/${props.post.id}/_downvote`, undefined, {
        onStart: () => (processing.value = true),
        onFinish: () => (processing.value = false),
        only: ['filteredPost', 'post'],
    })
}

const revokeVote = () => {
    router.post(`/p/${props.post.id}/_revoke-vote`, undefined, {
        onStart: () => (processing.value = true),
        onFinish: () => (processing.value = false),
        only: ['filteredPost', 'post'],
    })
}
</script>

<template>
    <Card>
        <CardHeader class="p-2 border-b md:p-4">
            <div>
                <div class="flex items-center gap-x-4">
                    <div class="mt-1">
                        <Avatar>
                            <AvatarImage :src="post.side.avatar" />
                            <AvatarFallback>
                                <div
                                    class="grid font-semibold capitalize place-items-center">
                                    <p>
                                        {{ post.author.username.charAt(0) }}
                                    </p>
                                </div>
                            </AvatarFallback>
                        </Avatar>
                    </div>
                    <div class="flex flex-col justify-between">
                        <div class="flex items-center text-sm gap-x-2">
                            <p>
                                u/<span class="font-semibold">{{
                                    post.author.username
                                }}</span>
                            </p>

                            <p class="text-sm text-muted-foreground">
                                {{ since(post.createdAt) }}
                            </p>
                        </div>
                        <p class="text-sm text-muted-foreground">
                            <span>Posted on </span>
                            <span>s/</span
                            ><Link
                                :href="'/s/' + post.side.id"
                                class="font-semibold underline text-primary"
                                >{{ post.side.id }}</Link
                            >
                        </p>
                    </div>
                </div>
            </div>
        </CardHeader>
        <CardContent class="p-4">
            <p>{{ post.body }}</p>
        </CardContent>
        <CardFooter class="px-2 py-2 gap-x-4 md:px-4">
            <div class="flex items-center">
                <Button
                    variant="ghost"
                    class="p-3"
                    :class="{
                        'bg-secondary': currentVote == 'upvote',
                    }"
                    @click="
                        () => {
                            if (currentVote == 'upvote') {
                                revokeVote()
                                return
                            }
                            upVote()
                        }
                    "
                    :disabled="processing">
                    <ChevronUpIcon />
                </Button>
                <span class="p-3">{{ abbreviate(post.score) }}</span>
                <Button
                    variant="ghost"
                    class="p-3"
                    :class="{
                        'bg-secondary': currentVote == 'downvote',
                    }"
                    @click="
                        () => {
                            if (currentVote == 'downvote') {
                                revokeVote()
                                return
                            }
                            downVote()
                        }
                    "
                    :disabled="processing">
                    <ChevronDownIcon />
                </Button>
            </div>
            <Link :href="`/p/${post.id}`">
                <Button variant="ghost" class="p-3">
                    <MessageCircleIcon />
                </Button>
            </Link>
        </CardFooter>
    </Card>
</template>
