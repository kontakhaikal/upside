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
}
</script>

<script setup lang="ts">
import { abbreviate, since } from '@/lib/utils'
import { Link } from '@inertiajs/vue3'
import {
    ChevronDownIcon,
    ChevronUpIcon,
    MessageCircleIcon,
} from 'lucide-vue-next'
import { Avatar, AvatarFallback, AvatarImage } from '../avatar'
import { Button } from '../button'
import { Card, CardContent, CardFooter, CardHeader } from '../card'

defineProps<{ post: PostProps }>()
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
                <Button variant="ghost" class="px-2 py-1">
                    <ChevronUpIcon />
                </Button>
                <span class="px-2">{{ abbreviate(post.score) }}</span>
                <Button variant="ghost" class="px-2 py-1">
                    <ChevronDownIcon />
                </Button>
            </div>
            <Button variant="ghost">
                <MessageCircleIcon />
            </Button>
        </CardFooter>
    </Card>
</template>
