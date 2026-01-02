import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                // Primary colors (Blue - sesuai desain)
                primary: {
                    DEFAULT: '#135bec',
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#135bec',
                    600: '#0a4bcf',
                    700: '#0a2a47',
                    800: '#1e3a5f',
                    900: '#0a2a47',
                },
                // Secondary colors (Yellow - sesuai desain)
                secondary: {
                    DEFAULT: '#fcc404',
                    50: '#fefce8',
                    100: '#fef9c3',
                    200: '#fef08a',
                    300: '#fde047',
                    400: '#facc15',
                    500: '#fcc404',
                    600: '#dcb003',
                    700: '#a16207',
                    800: '#854d0e',
                    900: '#713f12',
                },
                // Dark mode colors
                'primary-dark': '#0a2a47',
                'secondary-dark': '#dcb003',
                'background-light': '#f6f6f8',
                'background-dark': '#101622',
                'surface-light': '#ffffff',
                'surface-dark': '#1f2937',
                'text-light': '#333333',
                'text-dark': '#e5e7eb',
                'accent-light': '#e2e8f0',
                'accent-dark': '#374151',
            },
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                display: ['Lexend', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                DEFAULT: '0.25rem',
                lg: '0.5rem',
                xl: '0.75rem',
            },
            animation: {
                'marquee': 'marquee 25s linear infinite',
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'slide-up': 'slideUp 0.5s ease-out',
            },
            keyframes: {
                marquee: {
                    '0%': { transform: 'translateX(100%)' },
                    '100%': { transform: 'translateX(-100%)' },
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
            },
        },
    },

    plugins: [forms, typography],
};
