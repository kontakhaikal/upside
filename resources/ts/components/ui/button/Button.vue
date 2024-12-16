<script setup lang="ts">
import { cn } from '@/lib/utils'
import { AsTag, Primitive, type PrimitiveProps } from 'radix-vue'
import type { HTMLAttributes } from 'vue'
import { type ButtonVariants, buttonVariants } from '.'

interface Props extends /** @vue-ignore */ PrimitiveProps {
    variant?: ButtonVariants['variant']
    size?: ButtonVariants['size']
    class?: HTMLAttributes['class']
    as?: AsTag
}

const props = withDefaults(defineProps<Props>(), {
    as: 'button',
})
</script>

<template>
    <Primitive
        :as="props.as"
        :as-child="props.asChild"
        :class="cn(buttonVariants({ variant, size }), props.class)">
        <slot />
    </Primitive>
</template>
