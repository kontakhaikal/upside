<script setup lang="ts">
import { useAuth, useTailwindResize } from '@/lib/hooks'
import { HamburgerMenuIcon } from '@radix-icons/vue'
import { ref } from 'vue'
import HomeCard from './HomeCard.vue'
import Button from './ui/button/Button.vue'
import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from './ui/sheet'
import {
    JoinedSideProps,
    JoinedSides,
    PopularSideProps,
    PopularSides,
} from './ui/side'

defineProps<{
    popularSides: PopularSideProps[]
    joinedSides: JoinedSideProps[]
}>()

const show = ref(true)

useTailwindResize((breakPoints) => {
    if (breakPoints.greaterOrEqual('lg').value) {
        show.value = false
    } else {
        show.value = true
    }
})

const user = useAuth()
</script>

<template>
    <Sheet :default-open="false" @resize="console.log">
        <SheetTrigger
            ><Button variant="outline">
                <HamburgerMenuIcon />
                <p class="sr-only md:block">Menu</p>
            </Button>
        </SheetTrigger>
        <SheetContent class="w-full pt-12 sm:w-full" v-if="show">
            <SheetHeader>
                <SheetTitle class="sr-only">Menu</SheetTitle>
                <SheetDescription class="sr-only">Home menu</SheetDescription>
            </SheetHeader>
            <div class="grid gap-y-1">
                <HomeCard class="rounded-sm shadow-none" />
                <JoinedSides
                    v-if="user"
                    class="rounded-sm shadow-none"
                    :sides="joinedSides" />
                <PopularSides
                    class="rounded-sm shadow-none"
                    :sides="popularSides" />
            </div>
        </SheetContent>
    </Sheet>
</template>
