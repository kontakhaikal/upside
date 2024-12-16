import { Preview, setup } from '@storybook/vue3'
import '../resources/css/app.css'

setup((app) => {
    app.use({
        install() {
            window
                .matchMedia('(prefers-color-scheme: dark)')
                .addEventListener('change', (e) => {
                    if (e.matches) {
                        document.body.classList.add('dark')
                    } else {
                        document.body.classList.remove('dark')
                    }
                })
        },
    })
})

const preview: Preview = {
    parameters: {
        controls: {
            matchers: {
                color: /(background|color)$/i,
                date: /Date$/i,
            },
        },
    },
}

export default preview
