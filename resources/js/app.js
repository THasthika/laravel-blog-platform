import './bootstrap';

import Alpine from 'alpinejs';

import { themeChange } from 'theme-change';

window.Alpine = Alpine;

Alpine.start();

themeChange();

// function isDarkMode() {
//     return document.documentElement.classList.contains('dark');
// }

// function toggleDarkModeState() {
//     if (isDarkMode()) {
//         document.documentElement.classList.remove('dark');
//     } else {
//         document.documentElement.classList.add('dark');
//     }
// }

// window.toggleDarkModeState = toggleDarkModeState;

// function initDarkMode() {
//     // It's best to inline this in `head` to avoid FOUC (flash of unstyled content) when changing pages or themes
//     if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
//         document.documentElement.classList.add('dark');
//     } else {
//         document.documentElement.classList.remove('dark');
//     }
// }

// // initDarkMode();