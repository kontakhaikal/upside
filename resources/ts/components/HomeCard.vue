<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Button } from './ui/button'
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from './ui/card'
</script>

<template>
    <Card>
        <CardHeader class="bg-primary rounded-t-[inherit]">
            <CardTitle class="text-secondary">Home</CardTitle>
        </CardHeader>
        <CardContent>
            <p class="mt-4 text-sm text-muted-foreground">
                Your personal upside homepage. Come here to check in with your
                favorites sides.
            </p>
        </CardContent>
        <CardFooter class="flex flex-col gap-y-2">
            <Link class="w-full" href="/p/">
                <Button class="w-full">Create a post</Button>
            </Link>
            <Link class="w-full" href="/s/">
                <Button variant="outline" class="w-full">Create a side</Button>
            </Link>
        </CardFooter>
    </Card>
</template>
