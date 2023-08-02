/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './src/**/*.{php,twig,html,js}',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                yellow: {
                    DEFAULT: '#FFC84F',
                    primary: '#FFC84F',
                    dark: '#EFB848',
                },

                black: {
                    DEFAULT: '#000000',
                },
                green: '#2E7636',
                purple: '#3F1364',
            },
            fontFamily: {
                open: ["'Open Sans'", 'sans-serif'],
                montserrat: ['Montserrat', 'sans-serif'],
            },
            screens: {
                '3xl': '2560px',
            },
        },
    },
    plugins: [require('flowbite/plugin')],
}
