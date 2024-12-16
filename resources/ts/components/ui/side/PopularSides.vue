<script setup lang="ts">
import { SquareDashedIcon } from 'lucide-vue-next'
import { Button } from '../button'
import { Card, CardContent, CardHeader, CardTitle } from '../card'
import PopularSide, { PopularSideProps } from './PopularSide.vue'

defineProps<{ sides: PopularSideProps[] }>()
</script>

<template>
    <Card class="h-min top-4">
        <CardHeader>
            <CardTitle>Popular sides</CardTitle>
        </CardHeader>
        <CardContent>
            <ul
                v-if="sides.length > 0"
                class="flex flex-col justify-between gap-y-4">
                <li v-for="side of sides" :key="side.id">
                    <PopularSide :side />
                </li>
            </ul>
            <div
                v-else
                class="grid px-2 py-6 border border-dashed rounded-md place-items-center text-muted-foreground">
                <SquareDashedIcon />
                <p class="mt-4 text-sm text-center">
                    No side have been created
                </p>
                <Button variant="outline" class="mt-4 border-dashed"
                    >Create new side</Button
                >
            </div>
        </CardContent>
    </Card>
</template>
