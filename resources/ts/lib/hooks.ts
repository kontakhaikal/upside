import { usePage } from '@inertiajs/vue3'
import {
    breakpointsTailwind,
    useBreakpoints,
    useResizeObserver,
} from '@vueuse/core'

type TailwindBreakPoint = keyof typeof breakpointsTailwind

type TailwindBreakPoints = ReturnType<typeof useBreakpoints<TailwindBreakPoint>>

export function useTailwindResize(
    fn: (breakPoints: TailwindBreakPoints) => void
) {
    const breakpoints = useBreakpoints(breakpointsTailwind)

    useResizeObserver(document.body, () => {
        fn(breakpoints)
    })
}

export interface User {
    id: string
    avatar: string
    username: string
}

export function useAuth(): Readonly<User> | undefined {
    const page = usePage()
    return page.props.user as Readonly<User> | undefined
}
