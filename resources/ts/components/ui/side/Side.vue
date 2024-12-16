<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import type { SideProps } from '@/Pages/Home.vue'

defineProps<{ side: SideProps }>()
</script>

<template>
    <div class="group">
        <div class="flex items-center gap-x-2">
            <Avatar size="xs">
                <AvatarImage :src="side.avatar" />
                <AvatarFallback>
                    <div
                        class="grid font-semibold capitalize place-items-center hover:no-underline">
                        <p>
                            {{ side.id.charAt(0) }}
                        </p>
                    </div>
                </AvatarFallback>
            </Avatar>
            <p class="text-sm text-primary group-hover:underline">
                s/<span class="font-semibold">{{ side.id }}</span>
            </p>
        </div>
    </div>
</template>
