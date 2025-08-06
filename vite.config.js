import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: true, // ← permet à Vite d'accepter toutes les connexions (dont ngrok)
        hmr: {
            host: 'localhost', // ← important pour éviter des erreurs avec HMR
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});