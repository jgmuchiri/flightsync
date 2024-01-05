import colors from 'tailwindcss/colors'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

export default {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        "./resources/**/*.js",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
    ],
    plugins: [
        forms,
        typography,
    ],
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bdddfc',
                    300: '#90c6f8',
                    400: '#63b0f8',
                    500: '#3998f1',
                    600: '#2B95F8',
                    700: '#1e6db6',
                    800: '#165693',
                    900: '#1b5081',
                    950: '#14314b'
                },
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },
}
