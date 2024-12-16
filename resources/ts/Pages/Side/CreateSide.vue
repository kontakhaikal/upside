<script setup lang="ts">
import Error from '@/components/Error.vue'
import Navbar from '@/components/Navbar.vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Link, useForm } from '@inertiajs/vue3'
import { Loader2Icon } from 'lucide-vue-next'

const props = defineProps<{ user: any }>()

const createSideForm = useForm({ id: '', name: '', description: '' })

const submit = () => {
    createSideForm.post('/s/')
}
</script>

<template>
    <Navbar />
    <main class="container min-h-screen pt-4 dark:bg-secondary">
        <Card class="max-w-[32rem] p-2">
            <CardHeader>
                <CardTitle> Create new side </CardTitle>
            </CardHeader>
            <CardContent>
                <form
                    id="create-side-form"
                    @submit.prevent="submit"
                    class="grid gap-y-2">
                    <div>
                        <Label> ID </Label>
                        <Input v-model="createSideForm.id" />
                        <Error
                            class="mt-1"
                            v-if="createSideForm.errors.id"
                            :message="createSideForm.errors.id" />
                    </div>
                    <div>
                        <Label> Name </Label>
                        <Input v-model="createSideForm.name" />
                        <Error
                            class="mt-1"
                            v-if="createSideForm.errors.name"
                            :message="createSideForm.errors.name" />
                    </div>
                    <div>
                        <Label> Description </Label>
                        <Textarea
                            v-model="createSideForm.description"></Textarea>
                        <Error
                            class="mt-1"
                            v-if="createSideForm.errors.description"
                            :message="createSideForm.errors.description" />
                    </div>
                    <div class="grid mt-4 gap-y-2">
                        <Button
                            form="create-side-form"
                            type="submit"
                            :disabled="createSideForm.processing"
                            class="w-full">
                            <Loader2Icon v-if="createSideForm.processing" />
                            <p v-else>Create</p>
                        </Button>
                        <Link href="/">
                            <Button
                                form="create-side-form"
                                type="reset"
                                :disabled="createSideForm.processing"
                                variant="outline"
                                class="w-full"
                                >Cancel</Button
                            >
                        </Link>
                    </div>
                </form>
            </CardContent>
        </Card>
    </main>
</template>
