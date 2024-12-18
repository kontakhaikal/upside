<script setup lang="ts">
import Navbar from '@/components/Navbar.vue'
import { Post } from '@/components/ui/post'
import { provide } from 'vue'
import SideDetailCard from '../../components/ui/side/SideDetailCard.vue'
import SideDetailMenu from '../../components/ui/side/SideDetailMenu.vue'

interface PostProps {
    id: string
    title: string
    body: string
    author: {
        id: string
        username: string
        avatar: string
    }
    score: number
    createdAt: number
    updatedAt: number
}

interface SideProps {
    id: string
    name: string
    avatar: string
    description: string
    posts: PostProps[]
}

const props = defineProps<{
    side: SideProps
    user?: { id: string; avatar: string; username: string }
}>()

provide('user', props.user)
</script>

<template>
    <Navbar />
    <main
        class="container mx-0 grid pt-4 lg:grid-cols-12 max-w-[58rem] gap-x-4">
        <div class="hidden col-span-4 lg:block">
            <SideDetailCard :side />
        </div>
        <div class="grid col-span-8">
            <div class="mb-2 ml-auto lg:hidden">
                <SideDetailMenu :side />
            </div>
            <ul class="grid gap-y-1 md:gap-y-2" v-if="side.posts.length > 0">
                <li v-for="post of side.posts">
                    <Post :post="{ ...post, side }" />
                </li>
            </ul>
        </div>
    </main>
</template>
