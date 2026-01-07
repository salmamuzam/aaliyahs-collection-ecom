import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Source Sans 3', ...defaultTheme.fontFamily.sans],
                playfair: ['Playfair Display', 'serif'],
                outfit: ['Outfit', 'sans-serif'],
            },
            colors: {
                brand: {
                    teal: '#004D61',
                    green: '#3E5641',
                    burgundy: '#822659',
                    black: '#1A1A1A',
                    beige: '#F3EDE8',
                },
            },
            keyframes: {
                'heart-filled': {
                    '0%': { transform: 'scale(0)' },
                    '25%': { transform: 'scale(1.2)' },
                    '50%': { transform: 'scale(1)', filter: 'brightness(1.5)' },
                    '100%': { transform: 'scale(1)', filter: 'brightness(1)' },
                },
                'heart-celebrate': {
                    '0%': { transform: 'scale(0)' },
                    '50%': { opacity: '1', filter: 'brightness(1.5)' },
                    '100%': { transform: 'scale(1.4)', opacity: '0', display: 'none' },
                },
            },
            animation: {
                'heart-filled': 'heart-filled 0.5s ease-in-out forwards',
                'heart-celebrate': 'heart-celebrate 0.5s ease-in-out forwards',
            },
        },
    },

    plugins: [forms, typography],
};
