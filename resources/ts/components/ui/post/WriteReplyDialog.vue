<script lang="ts">
export interface Commendable {
    id: string
    commentId: string
    replyTo?: string
    body: string
    author: {
        id: string
        username: string
    }
}
</script>
<script setup lang="ts">
import Error from '@/components/Error.vue'
import { useForm } from '@inertiajs/vue3'
import { useQueryClient } from '@tanstack/vue-query'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '../alert-dialog'
import AlertDialogHeader from '../alert-dialog/AlertDialogHeader.vue'
import { Avatar, AvatarFallback, AvatarImage } from '../avatar'
import { Card, CardContent, CardHeader, CardTitle } from '../card'
import { Textarea } from '../textarea'
const props = defineProps<{
    onReplied?: () => void
    postId: string
    replyTo?: string
    commendable: Commendable
}>()

const createReplyForm = useForm({
    body: '',
    replyTo: props.replyTo,
})

const queryClient = useQueryClient()

const submit = () => {
    createReplyForm.post(
        `/p/${props.postId}/c/${props.commendable.commentId}`,
        {
            onSuccess: () => {
                queryClient.invalidateQueries({
                    queryKey: [`replies-${props.commendable.commentId}`],
                })
                if (props.onReplied) {
                    props.onReplied()
                }
            },
        }
    )
}
</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger>
            <slot />
        </AlertDialogTrigger>
        <AlertDialogContent class="bg-secondary">
            <AlertDialogHeader>
                <AlertDialogTitle class="sr-only">Write Reply</AlertDialogTitle>
                <AlertDialogDescription class="sr-only"
                    >Write reply for comment
                    {{ commendable.id }}</AlertDialogDescription
                >
            </AlertDialogHeader>
            <Card>
                <div class="flex items-center p-2 border-b gap-x-2">
                    <Avatar>
                        <AvatarImage src="/s" />
                        <AvatarFallback>
                            <div
                                class="grid font-semibold capitalize place-items-center">
                                <p>
                                    {{ commendable.author.username.charAt(0) }}
                                </p>
                            </div>
                        </AvatarFallback>
                    </Avatar>
                    <p>{{ commendable.author.username }}</p>
                </div>
                <div class="p-2">{{ commendable.body }}</div>
            </Card>
            <Card>
                <CardHeader>
                    <CardTitle>Write Reply</CardTitle>
                </CardHeader>
                <CardContent>
                    <form class="grid gap-y-2" @submit.prevent="submit">
                        <div>
                            <Textarea v-model="createReplyForm.body"></Textarea>
                            <Error
                                v-if="createReplyForm.errors.body"
                                :message="createReplyForm.errors.body" />
                        </div>
                        <AlertDialogAction
                            type="submit"
                            as="button"
                            :disabled="createReplyForm.processing"
                            >Continue</AlertDialogAction
                        >
                        <AlertDialogCancel
                            type="reset"
                            as="button"
                            :disabled="createReplyForm.processing"
                            >Cancel</AlertDialogCancel
                        >
                    </form>
                </CardContent>
            </Card>
        </AlertDialogContent>
    </AlertDialog>
</template>
