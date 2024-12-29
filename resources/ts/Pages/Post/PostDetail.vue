<script lang="ts">
export interface SideProps {
    id: string
}

export interface AuthorProps {
    id: string
    username: string
}

export interface CommentProps {
    id: string
    body: string
    author: AuthorProps
    score: number
    replies: ReplyProps[]
}

export interface PostDetailProps {
    id: string
    title: string
    body: string
    side: SideProps
    author: AuthorProps
    createdAt: number
    updatedAt: number
}

interface ReplyProps {
    id: string
    body: string
    commentId: string
    score: number
    author: AuthorProps
    replyTo: string
}
</script>

<script setup lang="ts">
import Navbar from '@/components/Navbar.vue'
import Comment from '@/components/ui/post/Comment.vue'
import Post, { type PostProps } from '@/components/ui/post/Post.vue'
import WriteComment from '@/components/ui/post/WriteComment.vue'

const props = defineProps<{ post: PostProps; comments: CommentProps[] }>()
</script>

<template>
    <Navbar />
    <main
        class="container grid min-h-screen grid-cols-5 pt-4 bg-secondary gap-x-4">
        <div class="sticky grid col-span-2 gap-y-1 h-min top-4">
            <Post :post />
            <WriteComment :post-id="post.id" />
        </div>
        <div class="col-span-3 overflow-y-scroll">
            <ul class="max-w-[36rem] grid gap-y-2">
                <li v-for="comment in comments" :key="comment.id">
                    <Comment :comment="comment" :post-id="post.id" />
                </li>
            </ul>
        </div>
    </main>
</template>
