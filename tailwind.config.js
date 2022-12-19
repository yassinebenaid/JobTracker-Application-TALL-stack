const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/**/*.blade.php',
        './resources/views/**/**/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#0A73FE",
                "primary-2": "#4098FF",
                "primary-3": "#D4E7FF",
                secondary: "#97A7B2",
                "secondary-2": "#D2E1E7",
                "secondary-3": "#F3F9FB",

            },
        },

    },

    plugins: [require('@tailwindcss/forms')],
};


