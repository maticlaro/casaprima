import {
    defineConfig
} from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: 
                [
                    ...refreshPaths,
                    'app/Livewire/**',
                    'app/Filament/**',
                    // hot reload everything in the views directory
                    'resources/views/**',
                ],
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
    },
});