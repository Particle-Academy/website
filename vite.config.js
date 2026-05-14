import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // React island for /ui/demos/* interactive surfaces. Built as a
                // separate entry so the rest of the site (Livewire + Flux Blade)
                // doesn't pay the React bundle cost.
                'resources/js/ui-demos.tsx',
            ],
            refresh: true,
        }),
        react(),
        tailwindcss(),
    ],
});
