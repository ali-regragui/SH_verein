const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {

    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {

        extend: {
            gradientColorStops: theme => ({
                ...theme('colors'),
                'primary': '#3490dc',
                'secondary': '#ffed4a',
                'danger': '#e3342f',
               }),
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                black: colors.black,
                white: colors.white,
                gray: colors.trueGray,
                'gray-background': '#f7f8fc',
                'blue': '#328af1',
                'blue-hover': '#2879bd',
                'yellow' : '#ffc73c',
                'red' : '#ec454f',
                'red-100' : '#fee2e2',
                'green' : '#1aab8b',
                'green-50': '#f0fdf4',
                'purple' : '#8b60ed',
                'hgreen':'#85f5b7',
                'violetC':'#7c57b4',
                'violet-hover':'#b294de',
                'wheat':'#fdf9f7'

            },

            spacing: {
                22: '5.5rem',
                44: '11rem',
                70: '17.5rem',
                76: '19rem',
                104: '26rem',
                128: '32rem',
                175: '43.75rem',
            },
            maxWidth: {
                custom: '68.5rem',
            },
            boxShadow: {
                card: '4px 4px 15px 0 rgba(36, 37, 38, 0.08)',
                dialog: '3px 4px 15px 0 rgba(36, 37, 38, 0.22)',
            },
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                xxs: ['0.625rem', { lineHeight: '1rem' }],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            gradientColorStops: ['active', 'group-hover'],
            backgroundClip: ['hover', 'focus'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
