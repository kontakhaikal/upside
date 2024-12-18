<script setup lang="ts">
import { useAuth, useTailwindResize } from '@/lib/hooks'
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import Logo from './Logo.vue'
import { Avatar, AvatarFallback, AvatarImage } from './ui/avatar'
import { Button } from './ui/button'

const user = useAuth()

const full = ref(false)

useTailwindResize((br) => {
    if (br.greaterOrEqual('lg').value) {
        full.value = true
        return
    }
    full.value = false
})
</script>

<template>
    <div class="container flex items-center justify-between py-2 border-b">
        <Link href="/">
            <Logo :full class="w-8 h-8 lg:w-min" />
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
