import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
				colors: {
					transparent: 'transparent',
					current: 'currentColor',
					primary: colors.amber,
					secondary: colors.emerald,
					black: colors.black,
					white: colors.white,
					gray: colors.trueGray,
					red: colors.rose,
					indigo: colors.indigo,
					yellow: colors.amber,
				}
    },

    plugins: [forms, typography],
};
