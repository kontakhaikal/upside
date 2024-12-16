<script lang="ts">
export interface SideProps {
    id: string
    avatar: string
}

export interface UserProps {
    id: string
    username: string
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
import HomeCard from '@/components/HomeCard.vue'
import HomeMenu from '@/components/HomeMenu.vue'
import Navbar from '@/components/Navbar.vue'
import { Button } from '@/components/ui/button'
import { Post } from '@/components/ui/post'
import {
    JoinedSideProps,
    JoinedSides,
    PopularSideProps,
    PopularSides,
} from '@/components/ui/side'
import { useAuth } from '@/lib/hooks'
import {
    BellIcon,
    FlameIcon,
    TextSelectIcon,
    TrendingUpIcon,
} from 'lucide-vue-next'

const props = defineProps<{
    popularSides: PopularSideProps[]
    joinedSides: JoinedSideProps[]
    posts: PostProps[]
}>()

const user = useAuth()
</script>

<template>
    <Navbar />
    <main class="container grid lg:grid-cols-12 gap-x-2 dark:bg-secondary">
        <div
            class="sticky flex-col hidden h-screen col-span-3 pr-4 mt-4 overflow-y-scroll lg:flex top-4 gap-y-4">
            <JoinedSides v-if="user" :sides="joinedSides" />
            <PopularSides :sides="popularSides" />
        </div>
        <div class="mt-4 lg:col-span-6">
            <ul class="grid gap-y-4">
                <div class="flex justify-between">
                    <div class="flex border rounded-md shadow-sm w-min bg-card">
                        <Button variant="ghost" class="rounded-r-none">
                            <FlameIcon />
                            <p class="hidden md:block">Latest</p>
                        </Button>
                        <Button variant="ghost" class="rounded-none border-x">
                            <TrendingUpIcon />
                            <p class="hidden md:block">Trending</p>
                        </Button>
                        <Button
                            variant="ghost"
                            class="rounded-l-none dark:rounded-none">
                            <BellIcon />
                            <p class="hidden md:block">Subscribed</p>
                        </Button>
                    </div>
                    <div class="lg:hidden">
                        <HomeMenu
                            :joined-sides="joinedSides"
                            :popular-sides="popularSides" />
                    </div>
                </div>
                <li v-if="posts.length > 0" v-for="post in posts">
                    <Post :post />
                </li>
                <div
                    v-else
                    class="border border-dashed rounded-md min-h-[12rem] grid place-items-center text-muted-foreground dark:border-muted-foreground">
                    <div class="grid place-items-center">
                        <TextSelectIcon :size="56" />
                        <p class="mt-2 text-lg text-center">No posts</p>
                    </div>
                </div>
            </ul>
        </div>
        <div
            style="direction: rtl"
            class="sticky hidden h-screen col-span-3 pl-4 mt-4 overflow-y-scroll lg:block top-4">
            <div class="flex flex-col gap-y-4" style="direction: ltr">
                <HomeCard />
            </div>
        </div>
    </main>
</template>
