import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: 'https://humble-potato-4j79r7qwp5rc7j7p-9005.app.github.dev/',
    build: {
        outDir: 'public/build',
    },
    server: {
        host: '0.0.0.0', 
        port: 5173
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

