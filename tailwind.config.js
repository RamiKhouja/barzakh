import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                ibm: "'IBM Plex Sans Arabic', serif",
                noto: "'Noto Nastaliq Urdu', serif",
                taj: "'AlQalamTajNastaleeq', serif",
                brando: "'Brando Regular'"
            },
        },
        colors: {
            'primary' :{
                50 : '#faf7f0',
                100 : '#f7f1e4',
                150 : '#EFE9DF',
                200 : '#ebe3d6',
                300 : '#d3ccc0',
                500 : '#74411c',
                600 : '#581D17',
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
                200 : '#9EB384',
                500 : '#22c55e',
                600 : '#16a34a',
                700 : '#15803d'
            },
            'blue' : {
                100 : '#dbeafe',
                200 : '#bfdde7',
                600 : '#098db1',
                700 : '#1d4ed8'
            },
            'gray' : {
                50 : '#eeeeee',
                100 : '#d1d5db',
                200 : '#cccccc',
                300: '#777777',
                400 : '#333333',
                500 : '#222222',
                700 : '#141717',
            },
            'stone' : '#292524',
            'black' : '#000000',
            'white' : '#ffffff',
            'cancan' : '#E4CEC2',
            'stoned' : {
                500 : '#78716c',
                900 : '#1c1917'
            },
            'bordo' : '#550304'
        }
    },

    plugins: [forms],
};
