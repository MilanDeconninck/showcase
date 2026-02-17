/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './views/**/*.{twig,html}',
        './public/**/*.php',
    ],
    safelist: [
        'dark'
    ],
    theme: {
        extend: {
            fontFamily: {
                main: ['Tomorrow', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
