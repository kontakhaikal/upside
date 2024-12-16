<script setup lang="ts">
import Navbar from '@/components/Navbar.vue'
import { Button } from '@/components/ui/button'
import { Card, CardHeader, CardTitle } from '@/components/ui/card'
import CardContent from '@/components/ui/card/CardContent.vue'
import CardFooter from '@/components/ui/card/CardFooter.vue'
import { Post } from '@/components/ui/post'
import { provide } from 'vue'

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
    <main class="container grid grid-cols-12 pt-4">
        <div class="col-span-9">
            <ul v-if="side.posts.length > 0">
                <li v-for="post of side.posts">
                    <Post :post="{ ...post, side }" />
                </li>
            </ul>
        </div>
        <div class="col-span-3">
            <Card>
                <CardHeader>
                    <CardTitle>s/{{ side.id }}</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{{ side.name }}</p>
                    <p>{{ side.description }}</p>
                </CardContent>
                <CardFooter>
                    <Button class="w-full"> Create new post </Button>
                </CardFooter>
            </Card>
        </div>
    </main>
</template>
