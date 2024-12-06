import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import path from 'path'
import { defineConfig } from 'vite'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/ts/app.ts'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@/components': path.resolve(
                __dirname,
                path.join('resources', 'ts', 'components')
            ),
            '@/lib': path.resolve(
                __dirname,
                path.join('resources', 'ts', 'lib')
            ),
            ziggy: path.resolve('vendor/tightenco/ziggy'),
        },
    },
})
