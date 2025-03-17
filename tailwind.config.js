import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    safelist: [
        {
            pattern: /bg-(gray|red|blue|green|yellow|orange|purple|cyan|pink|indigo|teal|rose)-\d{3}/,
            variants: ['hover', 'focus', 'active', 'focus:ring'],
        },
    ],

    plugins: [forms],
};
