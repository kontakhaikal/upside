'use strict'
import { createInertiaApp } from '@inertiajs/vue3'
import { createApp, DefineComponent, h, Plugin } from 'vue'
import '../css/app.css'

declare global {
    interface ImportMeta {
        glob: (path: string) => Record<string, () => Promise<DefineComponent>>
    }
}

type DarkModePlugin = Plugin & {
    changeScheme: (m: MediaQueryList | MediaQueryListEvent) => void
}

const DarkMode: DarkModePlugin = {
    changeScheme(m: MediaQueryList | MediaQueryListEvent) {
        if (m.matches) {
            document.body.classList.add('dark')
        } else {
            document.body.classList.remove('dark')
        }
    },
    install() {
        const queryList = window.matchMedia('(prefers-color-scheme: dark)')
        this.changeScheme(queryList)
        queryList.addEventListener('change', this.changeScheme)
    },
}

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue')
        return pages[`./Pages/${name}.vue`]()
    },
    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props),
        })
            .use(plugin)
            .use(DarkMode)
            .mount(el)
    },
})
