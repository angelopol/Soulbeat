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
                'resources/js/app.js',
                'resources/js/chats.js',
                'resources/js/feedscript.js',
                'resources/js/landing.js',
                'resources/js/login.js',
                'resources/js/NewPosts.js',
                'resources/js/playlist.js',
                'resources/js/profilescript.js',
                'resources/js/settings.js',
                'resources/js/settingsavanced.js',
                'resources/js/showallplaylist.js',
                'resources/js/CreatePost.js',
                'resources/js/jquery.min.js',
                'resources/js/pusher.min.js',
            ],
            refresh: true,
        }),
    ],
});
