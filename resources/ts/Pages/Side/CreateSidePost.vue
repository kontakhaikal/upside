<script setup lang="ts">
import Error from '@/components/Error.vue'
import Navbar from '@/components/Navbar.vue'
import { Button } from '@/components/ui/button'
import { Card, CardHeader, CardTitle } from '@/components/ui/card'
import CardContent from '@/components/ui/card/CardContent.vue'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { useForm } from '@inertiajs/vue3'
import { Loader2Icon } from 'lucide-vue-next'

const props = defineProps<{ sideId: string }>()

const createPostForm = useForm({
    title: '',
    body: '',
    sideId: props.sideId,
})

const submit = () => {
    createPostForm.post('/p')
}
</script>

<template>
    <Navbar />
    <div class="container min-h-screen pt-4 bg-secondary">
        <Card class="max-w-[36rem] mx-auto">
            <CardHeader> <CardTitle> Create new post </CardTitle> </CardHeader>
            <CardContent>
                <form
                    @submit.prevent="submit"
                    id="create-post-form"
                    class="grid gap-y-3">
                    <div>
                        <Label>Title</Label>
                        <Input
                            class="mt-1"
                            v-model="createPostForm.title"
                            required />
                        <Error
                            class="mt-1"
                            v-if="createPostForm.errors.title"
                            :message="createPostForm.errors.title" />
                    </div>
                    <div>
                        <Label>Body</Label>
                        <Textarea
                            class="mt-1"
                            v-model="createPostForm.body"
                            required />
                        <Error
                            class="mt-1"
                            v-if="createPostForm.errors.body"
                            :message="createPostForm.errors.body" />
                    </div>
                    <div>
                        <Label>Side</Label>
                        <Input v-model="createPostForm.sideId" disabled />
                    </div>
                    <div class="grid mt-4 gap-y-2">
                        <Button
                            form="create-post-form"
                            type="submit"
                            class="w-full">
                            <Loader2Icon v-if="createPostForm.processing" />
                            <p>Post</p>
                        </Button>
                        <Button type="button" class="w-full" variant="outline"
                            >Cancel</Button
                        >
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
