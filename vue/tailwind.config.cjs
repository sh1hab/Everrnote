/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './index.html',
        './pages/**/*.{html,js}',
        './src/**/*.{vue,js,ts,jsx,tsx}',
        './components/**/*.{html,js}',
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms"),
    ],
}
