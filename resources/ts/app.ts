import { createInertiaApp } from '@inertiajs/vue3'
import { createApp, DefineComponent, h } from 'vue'
import '../css/app.css'

declare global {
    interface ImportMeta {
        glob: (path: string) => Record<string, () => Promise<DefineComponent>>
    }
}

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue')
        return pages[`./Pages/${name}.vue`]()
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use({
                install() {
                    window
                        .matchMedia('(prefers-color-scheme: dark)')
                        .addEventListener('change', () => {
                            document.body.classList.toggle('dark')
                        })
                },
            })
            .mount(el)
    },
})
