<script lang="ts">
const postFilter = {
    TRENDING: 'trending',
    LATEST: 'latest',
    SUBSCRIBED: 'subscribed',
} as const

export type Filter = (typeof postFilter)[keyof typeof postFilter]
</script>

<script setup lang="ts">
import { BellIcon, FlameIcon, TrendingUpIcon } from 'lucide-vue-next'
import { ref } from 'vue'
import { Button } from '../button'

const props = withDefaults(
    defineProps<{
        defaultFilter?: Filter
        onChange?: (filter: Filter) => void
    }>(),
    { onChange: console.log, defaultFilter: 'latest' }
)
const filter = ref(props.defaultFilter)

const onClick = (postFilter: Filter) => {
    if (postFilter === filter.value) {
        return
    }
    filter.value = postFilter
    props.onChange(postFilter)
}
</script>

<template>
    <div class="flex border rounded-md shadow-sm w-min bg-card">
        <Button
            @click="() => onClick(postFilter.LATEST)"
            variant="ghost"
            class="rounded-r-none"
            :class="{
                'bg-foreground text-secondary pointer-events-none':
                    filter === postFilter.LATEST,
            }">
            <FlameIcon />
            <p
                :class="[
                    filter == postFilter.LATEST ? 'block' : 'hidden md:block',
                ]">
                Latest
            </p>
        </Button>
        <Button
            @click="() => onClick(postFilter.TRENDING)"
            variant="ghost"
            class="rounded-none border-x"
            :class="{
                'bg-foreground text-secondary pointer-events-none':
                    filter === postFilter.TRENDING,
            }">
            <TrendingUpIcon />
            <p
                :class="[
                    filter == postFilter.TRENDING ? 'block' : 'hidden md:block',
                ]">
                Trending
            </p>
        </Button>
        <Button
            @click="() => onClick(postFilter.SUBSCRIBED)"
            variant="ghost"
            class="rounded-l-none dark:rounded-none"
            :class="{
                'bg-foreground text-secondary pointer-events-none':
                    filter === postFilter.SUBSCRIBED,
            }">
            <BellIcon />
            <p
                :class="[
                    filter == postFilter.SUBSCRIBED
                        ? 'block'
                        : 'hidden md:block',
                ]">
                Subscribed
            </p>
        </Button>
    </div>
</template>
