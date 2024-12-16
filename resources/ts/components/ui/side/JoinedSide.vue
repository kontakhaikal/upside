<script lang="ts">
export const Role = {
    ADMIN: 'admin',
    MEMBER: 'member',
} as const

export interface MembershipProps {
    id: string
    role: (typeof Role)[keyof typeof Role]
    pinned: boolean
}

export interface JoinedSideProps {
    id: string
    avatar: string
    membership: MembershipProps
}
</script>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import Side from './Side.vue'

defineProps<{ side: JoinedSideProps }>()
</script>

<template>
    <Link :href="'/s/' + side.id">
        <Side :side="side" />
    </Link>
</template>
