const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: "class",

    theme: {
        extend: {
            colors: {
                // 'primary': '#023047',
                // 'secondary': '#ee964b'
            },        
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    // daisyUI config (optional)
    daisyui: {
        styled: true,
        themes: true,
        base: true,
        utils: true,
        logs: true,
        rtl: false,
        prefix: "",
        darkTheme: "light",
    },

    plugins: [require("@tailwindcss/typography"), require('@tailwindcss/forms'), require("daisyui")],
};
