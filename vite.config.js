import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // Agrega tus nuevos archivos aquí:
                'resources/css/badge-editor.css', 
                'resources/js/badge-editor.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});