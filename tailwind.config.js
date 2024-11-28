import defaultTheme from "tailwindcss/defaultTheme";
import plugin from "tailwindcss/plugin";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            transparent: "transparent",
            current: "currentColor",
            primary: colors.amber,
            green: colors.emerald,
            black: colors.black,
            white: colors.white,
            gray: colors.neutral,
            red: colors.rose,
            indigo: colors.indigo,
            orange: colors.amber,
        },
    },

    plugins: [
        forms,
        typography,
        // add custom variant for expanding sidebar
        plugin(({addVariant, e}) => {
            addVariant("sidebar-expanded", ({modifySelectors, separator}) => {
                modifySelectors(
                    ({className}) =>
                        `.sidebar-expanded .${e(
                            `sidebar-expanded${separator}${className}`
                        )}`
                );
            });
        }),
    ],
};
