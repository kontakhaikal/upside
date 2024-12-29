<script lang="ts">
export interface SideProps {
    readonly id: string
    readonly name: string
    readonly description: string
}
</script>

<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
    Card,
    CardContent,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import { Link } from '@inertiajs/vue3'

defineProps<{ side: SideProps }>()
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle>s/{{ side.id }}</CardTitle>
        </CardHeader>
        <CardContent>
            <p>{{ side.name }}</p>
            <p>{{ side.description }}</p>
        </CardContent>
        <CardFooter>
            <Link class="w-full" :href="`/s/${side.id}/p`">
                <Button class="w-full"> Create new post </Button>
            </Link>
        </CardFooter>
    </Card>
</template>
