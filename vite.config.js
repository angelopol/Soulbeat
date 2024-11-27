import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/chats.css',
                'resources/css/feedstyle.css',
                'resources/css/landing.css',
                'resources/css/login.css',
                'resources/css/playlist.css',
                'resources/css/profilestyle.css',
                'resources/css/settings.css',
                'resources/css/settingsavanced.css',
                'resources/css/showallplaylist.css',
                'resources/css/showreviews.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
