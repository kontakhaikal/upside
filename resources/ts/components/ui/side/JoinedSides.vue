<script setup lang="ts">
import { SquareDashedIcon } from 'lucide-vue-next';
import { Button } from '../button';
import { Card, CardContent, CardHeader, CardTitle } from '../card';
import JoinedSide, { JoinedSideProps } from './JoinedSide.vue';

defineProps<{ sides: JoinedSideProps[] }>()
</script>

<template>
    <Card class="h-min top-4">
        <CardHeader>
            <CardTitle>Joined sides</CardTitle>
        </CardHeader>
        <CardContent>
            <ul
                v-if="sides.length > 0"
                class="flex flex-col justify-between gap-y-4">
                <li v-for="side of sides">
                    <JoinedSide :side />
                </li>
            </ul>
            <div
                v-else
                class="grid px-2 py-6 border border-dashed rounded-md place-items-center text-muted-foreground">
                <SquareDashedIcon />
                <p class="mt-4 text-sm text-center">
                    You are not joined to any side
                </p>
                <Button variant="outline" class="mt-4 border-dashed"
                    >Join side</Button
                >
            </div>
        </CardContent>
    </Card>
</template>
