<script setup lang="ts">
import Logo from '@/components/Logo.vue'
</script>

<template>
    <main class="min-h-screen grid-cols-2 md:grid">
        <div class="hidden p-8 bg-primary md:block">
            <Logo class="h-[2rem] w-min text-secondary" />
        </div>
        <div class="flex justify-center px-1">
            <slot />
        </div>
    </main>
</template>
