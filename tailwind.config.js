/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                parchment: {
                    100: '#fdf6e3',
                    200: '#f4e8c1',
                    300: '#e8d5a5',
                    400: '#d1b882',
                    800: '#5a4624',
                    900: '#3d2b14',
                },
                blood: {
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                },
                magic: {
                    500: '#8b5cf6',
                    600: '#7c3aed',
                    700: '#6d28d9',
                }
            },
            fontFamily: {
                cinzel: ['Cinzel', 'serif'],
                lora: ['Lora', 'serif'],
            },
        },
    },
    plugins: [],
}
