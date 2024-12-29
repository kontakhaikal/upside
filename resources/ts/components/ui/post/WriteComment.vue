<script setup lang="ts">
import Error from '@/components/Error.vue'
import { useForm } from '@inertiajs/vue3'
import { Button } from '../button'
import { Card, CardContent, CardHeader, CardTitle } from '../card'
import { Textarea } from '../textarea'

const props = defineProps<{ postId: string }>()

const createCommentForm = useForm({
    postId: props.postId,
    body: '',
})

const submit = () => {
    createCommentForm.post(`/p/${props.postId}/c`)
}
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle>Write comment</CardTitle>
        </CardHeader>
        <CardContent>
            <form @submit.prevent="submit" class="grid gap-y-2">
                <div>
                    <Textarea v-model="createCommentForm.body"></Textarea>
                    <Error
                        v-if="createCommentForm.errors.body"
                        :message="createCommentForm.body" />
                </div>
                <Button type="submit">Send</Button>
            </form>
        </CardContent>
    </Card>
</template>
