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
        },
        colors: {
            'primary' :{
                50 : '#f0e5dd',
                100 : '#f7f1e4',
                200 : '#ebe3d6',
                500 : '#74411c',
                700 : '#42210b'
            },
            'red' : '#eb1f26',
            'blue' : {
                200 : '#bfdde7',
                600 : '#098db1'
            },
            'gray' : {
                50 : '#eeeeee',
                400 : '#333333',
                700 : '#141717',
            },
            'black' : '#000000',
            'white' : '#ffffff'
        }
    },

    plugins: [forms],
};
