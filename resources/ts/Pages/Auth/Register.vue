<script setup lang="ts">
import Error from '@/components/Error.vue'
import AuthLayout from '@/components/layout/AuthLayout.vue'
import Logo from '@/components/Logo.vue'
import Button from '@/components/ui/button/Button.vue'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Link, useForm } from '@inertiajs/vue3'
import { Loader2Icon } from 'lucide-vue-next'

const registerForm = useForm({
    username: '',
    password: '',
})

const submit = () => {
    registerForm.post('/auth/_register')
}
</script>

<template>
    <AuthLayout>
        <div
            class="flex flex-col w-full gap-y-6 max-w-[22rem] mt-[4rem] h-min px-8 md:px-2">
            <div class="grid text-center place-items-center">
                <Link href="/">
                    <Logo :full="false" />
                </Link>
                <h1
                    class="mt-4 text-xl font-semibold tracking-tight text-primary">
                    Create an account
                </h1>
                <p class="mt-2 text-sm max-w-64 text-muted-foreground">
                    Enter your username and password to continue
                </p>
            </div>
            <form @submit.prevent="submit" class="w-full">
                <div class="grid gap-y-3">
                    <div class="grid gap-1">
                        <Label for="username" class="sr-only">Username</Label>
                        <Input
                            v-model="registerForm.username"
                            @input="registerForm.clearErrors('username')"
                            id="username"
                            placeholder="Username" />
                        <Error
                            v-if="registerForm.errors.username"
                            :message="registerForm.errors.username" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="password" class="sr-only">Password</Label>
                        <Input
                            v-model="registerForm.password"
                            @input="registerForm.clearErrors('password')"
                            id="password"
                            placeholder="Password" />
                        <Error
                            v-if="registerForm.errors.password"
                            :message="registerForm.errors.password" />
                    </div>
                    <Button
                        as="button"
                        type="submit"
                        :disabled="registerForm.processing"
                        class="mt-2">
                        <Loader2Icon
                            v-if="registerForm.processing"
                            class="animate-spin" />
                        <span v-else>Register</span>
                    </Button>
                </div>
            </form>
            <p class="text-sm text-center text-muted-foreground">
                Already have an account?
                <Link
                    class="font-medium underline text-primary"
                    href="/auth/_login"
                    >Login</Link
                >
            </p>
        </div>
    </AuthLayout>
</template>
