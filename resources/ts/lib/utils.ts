import { type ClassValue, clsx } from 'clsx'
import { twMerge } from 'tailwind-merge'

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs))
}

export function abbreviate(n: number): string {
    if (n > 1_000) {
        return Math.floor(n / 1_000) + 'k'
    }
    if (n > 1_000_000) {
        return Math.floor(n / 1_000_1000) + 'm'
    }
    return n.toString()
}

export function since(ms: number): string {
    const seconds = ms / 1_000
    if (seconds < 10) {
        return 'Just now'
    }

    if (seconds < 60) {
        return seconds + ' second ago'
    }

    const minutes = seconds / 60
    if (minutes < 60) {
        return minutes + ' minute ago'
    }

    const hour = minutes / 60
    if (hour < 24) {
        return hour + ' hour ago'
    }

    const days = hour / 24
    if (days < 7) {
        return days + ' day ago'
    }

    const weeks = days / 4
    if (weeks < 4) {
        return weeks + ' week ago'
    }

    return ms.toString()
}
