<script setup lang="ts">
import { abbreviate } from '@/lib/utils'
import { ChevronDownIcon, ChevronUpIcon } from 'lucide-vue-next'
import { Button } from './ui/button'
const props = defineProps<{
    revokeVote: () => void
    upVote: () => void
    downVote: () => void
    score: number
    currentVote?: 'upvote' | 'downvote'
    processing: boolean
}>()
</script>

<template>
    <div class="flex items-center">
        <Button
            variant="ghost"
            class="p-3"
            :class="{
                'bg-secondary': currentVote == 'upvote',
            }"
            @click="
                () => {
                    if (currentVote == 'upvote') {
                        revokeVote()
                        return
                    }
                    upVote()
                }
            "
            :disabled="processing">
            <ChevronUpIcon />
        </Button>
        <span class="p-3">{{ abbreviate(score) }}</span>
        <Button
            variant="ghost"
            class="p-3"
            :class="{
                'bg-secondary': currentVote == 'downvote',
            }"
            @click="
                () => {
                    if (currentVote == 'downvote') {
                        revokeVote()
                        return
                    }
                    downVote()
                }
            "
            :disabled="processing">
            <ChevronDownIcon />
        </Button>
    </div>
</template>
