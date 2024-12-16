<script setup lang="ts">
import { CircleAlertIcon } from 'lucide-vue-next'

defineProps<{ message: string }>()
</script>

<template>
    <div
        class="flex p-2 text-xs text-red-500 rounded-md bg-red-50 dark:text-primary dark:bg-accent gap-x-1 w-fit">
        <div class="mt-0.5">
            <CircleAlertIcon :size="12" />
        </div>
        <p>{{ message }}</p>
    </div>
</template>
