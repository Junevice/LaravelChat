const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                green: '#62BE93',
                background: '#E3E4F1',
                primary: '#707070',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
