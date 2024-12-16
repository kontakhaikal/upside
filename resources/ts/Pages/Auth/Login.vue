<script setup lang="ts">
import Error from '@/components/Error.vue'
import AuthLayout from '@/components/layout/AuthLayout.vue'
import { Button } from '@/components/ui/button'
import { Checkbox } from '@/components/ui/checkbox'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Link, useForm } from '@inertiajs/vue3'
import { Loader2Icon } from 'lucide-vue-next'

const loginForm = useForm({
    username: '',
    password: '',
    rememberMe: false,
})

defineProps<{ errors: typeof loginForm.errors & { auth?: string } }>()

const submit = () => {
    loginForm.post('/auth/_login')
}
</script>

<template>
    <AuthLayout>
        <div class="flex flex-col w-full gap-y-6 max-w-[22rem] mt-[6rem] h-min">
            <div class="grid text-center place-items-center">
                <h1 class="text-2xl font-semibold tracking-tight text-primary">
                    Login to account
                </h1>
                <p class="mt-2 text-sm max-w-64 text-muted-foreground">
                    Enter your username and password to continue
                </p>
            </div>
            <form @submit.prevent="submit" class="w-full">
                <Error
                    class="w-full mb-1"
                    v-if="errors.auth"
                    :message="errors.auth" />
                <div class="grid gap-y-3">
                    <div class="grid gap-1">
                        <Label for="username" class="sr-only">Username</Label>
                        <Input
                            v-model="loginForm.username"
                            @input="loginForm.clearErrors('username')"
                            id="username"
                            placeholder="Username" />
                        <Error
                            v-if="loginForm.errors.username"
                            :message="loginForm.errors.username" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="password" class="sr-only">Password</Label>
                        <Input
                            v-model="loginForm.password"
                            @input="loginForm.clearErrors('password')"
                            id="password"
                            placeholder="Password" />
                        <Error
                            v-if="loginForm.errors.password"
                            :message="loginForm.errors.password" />
                    </div>
                    <div class="flex items-center gap-x-1.5">
                        <Checkbox
                            v-model="loginForm.rememberMe"
                            class="border-muted-foreground data-[state=checked]:border-primary" />
                        <p class="text-sm -mt-0.5 text-muted-foreground">
                            Remember me?
                        </p>
                    </div>
                    <Button
                        as="button"
                        type="submit"
                        :disabled="loginForm.processing"
                        class="mt-2">
                        <Loader2Icon
                            v-if="loginForm.processing"
                            class="animate-spin" />
                        <span v-else>Login</span>
                    </Button>
                </div>
            </form>
            <p class="text-sm text-center text-muted-foreground">
                Didn't have an account?
                <Link
                    class="font-medium underline text-primary"
                    href="/auth/_register"
                    >Register</Link
                >
            </p>
        </div>
    </AuthLayout>
</template>
