import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        container: {
            center: true,
            padding: '2rem',
            screens: {
                '2xl': '1400px',
            },
        },
        extend: {
            fontFamily: {
                // TRUQUE: Ambas as famílias usam Inter agora.
                // Isso sobrescreve a Playfair Display em todos os títulos antigos da Home.
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Inter', ...defaultTheme.fontFamily.sans], 
            },
            colors: {
                cielo: {
                    dark: '#1B2433',      
                    navy: '#2B3A4D',      
                    accent: '#FBAF61',    
                    terracotta: '#A6513C',
                    sand: '#C8C1B1',      
                    cream: '#EFEDE0',     
                },
                border: 'hsl(var(--border))',
                input: 'hsl(var(--input))',
                ring: 'hsl(var(--ring))',
                background: 'hsl(var(--background))',
                foreground: 'hsl(var(--foreground))',
                primary: {
                    DEFAULT: 'hsl(var(--primary))',
                    foreground: 'hsl(var(--primary-foreground))',
                },
                secondary: {
                    DEFAULT: 'hsl(var(--secondary))',
                    foreground: 'hsl(var(--secondary-foreground))',
                },
                destructive: {
                    DEFAULT: 'hsl(var(--destructive))',
                    foreground: 'hsl(var(--destructive-foreground))',
                },
                muted: {
                    DEFAULT: 'hsl(var(--muted))',
                    foreground: 'hsl(var(--muted-foreground))',
                },
                popover: {
                    DEFAULT: 'hsl(var(--popover))',
                    foreground: 'hsl(var(--popover-foreground))',
                },
                card: {
                    DEFAULT: 'hsl(var(--card))',
                    foreground: 'hsl(var(--card-foreground))',
                },
            },
            borderRadius: {
                lg: 'var(--radius)',
                md: 'calc(var(--radius) - 2px)',
                sm: 'calc(var(--radius) - 4px)',
            },
            keyframes: {
                'fade-up': {
                    from: { opacity: '0', transform: 'translateY(20px)' },
                    to: { opacity: '1', transform: 'translateY(0)' },
                },
                'fade-in': {
                    from: { opacity: '0' },
                    to: { opacity: '1' },
                },
                'reveal': {
                    '0%': { opacity: '0', filter: 'blur(10px)', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', filter: 'blur(0)', transform: 'translateY(0)' }
                },
                'marquee': {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                }
            },
            animation: {
                'fade-up': 'fade-up 0.6s ease-out',
                'fade-in': 'fade-in 0.4s ease-out',
                'reveal': 'reveal 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                'marquee': 'marquee 30s linear infinite',
            },
        },
    },

    plugins: [forms],
};