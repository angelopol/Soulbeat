import './bootstrap';
import.meta.glob([
    '../assets/**',
    '../assets/images/**',
    '../assets/audios/**',
    '../assets/svg/**',
    '../css/chats.css',
    '../css/feedstyle.css',
    '../js/**',
]);

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
