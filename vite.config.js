import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/frontend.jsx',
            ],
            refresh: true,
        }),
        react(),
    ],
    server: {
        port: 5173,
    },
});
