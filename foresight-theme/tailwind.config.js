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
                    100: '#201717',
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
    safelist: [
        'max-sm:ml-0',
        'max-sm:mt-6',
        'btn-white-large',
        'max-sm:ml-0',
        'max-sm:mt-6',
        'ml-6',
        'btn-primary-small',
        'btn-primary',
        'btn-primary-large',
        'btn-white-small',
        'btn-white',
        'btn-white-large',
        'btn-dark-small',
        'btn-dark',
        'btn-dark-large',
        'btn-secondary-small',
        'btn-secondary',
        'btn-secondary-large',
        'text-green',
    ],
    plugins: [require('flowbite/plugin')],
}
