import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                bgray: {
                  300: '#d1d5db', // misal ini warna custom kamu
                },
                success: {
                  300: '#4ade80',
                },
                darkblack: {
                  400: '#1f2937',
                  500: '#111827'
                }
              }
        },
    },

    plugins: [forms],
};
