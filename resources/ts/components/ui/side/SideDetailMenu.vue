<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from '@/components/ui/sheet'
import { useTailwindResize } from '@/lib/hooks'
import { HamburgerMenuIcon } from '@radix-icons/vue'
import { ref } from 'vue'
import SideDetailCard, { SideProps } from './SideDetailCard.vue'

defineProps<{ side: SideProps }>()

const show = ref(true)

useTailwindResize((breakPoints) => {
    if (breakPoints.greaterOrEqual('lg').value) {
        show.value = false
    } else {
        show.value = true
    }
})
</script>

<template>
    <Sheet :default-open="false">
        <SheetTrigger
            ><Button variant="outline">
                <HamburgerMenuIcon />
                <p class="sr-only md:block">Menu</p>
            </Button>
        </SheetTrigger>
        <SheetContent class="w-full pt-12 sm:w-full" v-if="show">
            <SheetHeader>
                <SheetTitle class="sr-only">Menu</SheetTitle>
                <SheetDescription class="sr-only"
                    >Side detail menu</SheetDescription
                >
            </SheetHeader>
            <div>
                <SideDetailCard :side />
            </div>
        </SheetContent>
    </Sheet>
</template>
