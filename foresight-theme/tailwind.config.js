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
                    DEFAULT: '#1F1F1F',
                    100: '#201717',
                },
                green: '#2E7636',
                purple: '#3F1364',
            },
            fontFamily: {
                open: ["'Open Sans'", 'sans-serif'],
                montserrat: ['Montserrat', 'sans-serif'],
            },
        },
        screens: {
            sm: '640px',
            // => @media (min-width: 640px) { ... }
            md: '768px',
            // => @media (min-width: 768px) { ... }
            lg: '1074px',
            // => @media (min-width: 1074px) { ... }
        },
        container: {
            center: true,
            padding: '1rem',
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
        'pld-like-dislike-wrap',
    ],
    plugins: [require('flowbite/plugin')],
}
