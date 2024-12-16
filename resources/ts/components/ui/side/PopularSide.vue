<script lang="ts">
export interface PopularSideProps {
    id: string
    avatar: string
    isMember: string
}
</script>

<script setup lang="ts">
import { useAuth } from '@/lib/hooks'
import { Link, router } from '@inertiajs/vue3'
import { Loader2Icon } from 'lucide-vue-next'
import { ref } from 'vue'
import { Button } from '../button'
import Side from './Side.vue'

const props = defineProps<{ side: PopularSideProps }>()

const loading = ref(false)

const join = () => {
    router.post('/s/' + props.side.id + '/_join', undefined, {
        onStart: () => (loading.value = true),
        onFinish: () => (loading.value = false),
    })
}

const user = useAuth()
</script>

<template>
    <div class="flex justify-between">
        <Link :href="'/s/' + side.id">
            <Side :side="side" />
        </Link>
        <Button v-if="user && !side.isMember" variant="outline" @click="join">
            <Loader2Icon v-if="loading" class="animate-spin" />
            <p v-else>Join</p></Button
        >
    </div>
</template>
