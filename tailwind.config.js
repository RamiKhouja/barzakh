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
                ibm: "'IBM Plex Sans Arabic', serif"
            },
        },
        colors: {
            'primary' :{
                50 : '#faf7f0',
                100 : '#f7f1e4',
                200 : '#ebe3d6',
                500 : '#74411c',
                700 : '#42210b'
            },
            'red' : {
                50  : '#fef2f2',
                100 : '#fee2e2',
                500 : '#eb1f26',
                700 : '#b91c1c'
            },
            'green' : {
                50  : '#f0fdf4',
                100 : '#dcfce7',
                500 : '#22c55e',
                700 : '#15803d'
            },
            'blue' : {
                200 : '#bfdde7',
                600 : '#098db1'
            },
            'gray' : {
                50 : '#eeeeee',
                300: '#777777',
                400 : '#333333',
                700 : '#141717',
            },
            'black' : '#000000',
            'white' : '#ffffff'
        }
    },

    plugins: [forms],
};
