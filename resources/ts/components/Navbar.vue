<script setup lang="ts">
import { useAuth } from '@/lib/hooks'
import { Link } from '@inertiajs/vue3'
import Logo from './Logo.vue'
import { Avatar, AvatarFallback, AvatarImage } from './ui/avatar'
import { Button } from './ui/button'

const user = useAuth()
</script>

<template>
    <div class="container flex items-center justify-between py-4 border-b">
        <Link href="/">
            <Logo class="h-8 w-min" />
        </Link>
        <nav></nav>
        <div>
            <Avatar v-if="user">
                <AvatarImage :src="user.avatar" />
                <AvatarFallback>
                    <div
                        class="grid font-semibold capitalize place-items-center">
                        <p>
                            {{ user.username.charAt(0) }}
                        </p>
                    </div>
                </AvatarFallback>
            </Avatar>
            <Link href="/auth/_login" v-else>
                <Button variant="secondary"> Login </Button>
            </Link>
        </div>
    </div>
</template>
