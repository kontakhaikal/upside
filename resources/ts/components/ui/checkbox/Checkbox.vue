<script setup lang="ts">
import { cn } from '@/lib/utils'
import { CheckIcon } from '@radix-icons/vue'
import type { CheckboxRootProps } from 'radix-vue'
import { CheckboxIndicator, CheckboxRoot } from 'radix-vue'
import { type HTMLAttributes } from 'vue'

const props = defineProps<
    /** @vue-ignore */ CheckboxRootProps & {
        class?: HTMLAttributes['class']
    }
>()

const model = defineModel<boolean>()
</script>

<template>
    <CheckboxRoot
        v-bind="props"
        v-model:checked="model"
        :class="
            cn(
                'peer h-4 w-4 shrink-0 rounded-sm border border-primary shadow focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground',
                props.class
            )
        ">
        <CheckboxIndicator
            class="flex items-center justify-center w-full h-full text-current">
            <slot>
                <CheckIcon class="w-4 h-4" />
            </slot>
        </CheckboxIndicator>
    </CheckboxRoot>
</template>
