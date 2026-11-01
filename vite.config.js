import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.tsx',
            ],
            ssr: 'resources/js/ssr.tsx',
            refresh: true,
        }),
        react(),
        tailwindcss(),
    ],
    build: {
        rolldownOptions: {
            output: {
                // react-fancy's <Icon name> resolves names against the whole Lucide
                // namespace, so every Lucide icon ships whatever the site renders.
                // Keep that weight in its own long-cached chunk rather than letting
                // it fold into the app entry, which changes on every deploy.
                codeSplitting: {
                    groups: [{ name: 'lucide-react', test: /node_modules[\\/]lucide-react[\\/]/ }],
                },
            },
        },
    },
});
