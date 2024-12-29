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

export interface FilteredPostProps {
    readonly filter: Filter
    readonly posts: PostProps[]
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
import { Post } from '@/components/ui/post'
import PostFilter, { Filter } from '@/components/ui/post/PostFilter.vue'
import {
    JoinedSideProps,
    JoinedSides,
    PopularSideProps,
    PopularSides,
} from '@/components/ui/side'
import { useAuth } from '@/lib/hooks'
import { router } from '@inertiajs/vue3'
import { TextSelectIcon } from 'lucide-vue-next'

defineProps<{
    popularSides: PopularSideProps[]
    joinedSides: JoinedSideProps[]
    filteredPost: FilteredPostProps
}>()

const user = useAuth()
</script>

<template>
    <Navbar />
    <main
        class="container grid min-h-screen lg:grid-cols-12 gap-x-2 bg-secondary">
        <div
            class="sticky flex-col hidden h-screen col-span-3 pr-4 mt-4 overflow-y-scroll lg:flex top-4 gap-y-4">
            <JoinedSides v-if="user" :sides="joinedSides" />
            <PopularSides :sides="popularSides" />
        </div>
        <div class="mt-4 lg:col-span-6">
            <div class="flex justify-between">
                <PostFilter
                    :defaultFilter="filteredPost.filter"
                    :on-change="
                        (filter) => {
                            router.visit('/?posts=' + filter, {
                                only: ['filteredPost'],
                            })
                        }
                    " />
                <div class="lg:hidden">
                    <HomeMenu
                        :joined-sides="joinedSides"
                        :popular-sides="popularSides" />
                </div>
            </div>
            <ul class="grid mt-4 gap-y-1 md:gap-y-2">
                <li
                    v-if="filteredPost.posts.length > 0"
                    v-for="post in filteredPost.posts"
                    :key="post.id">
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
