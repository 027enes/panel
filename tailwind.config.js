/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/panel/assets/css/**/*.css",
    "./src/panel/Views/**/*.view.php",
    "./src/panel/Views/layout/**/*.php",
    "./src/panel/Views/pages/**/*.view.php",

    "./src/site/assets/css/**/*.css",
    "./src/site/Views/**/*.view.php",
    "./src/site/Views/layout/**/*.php",
    "./src/site/Views/pages/**/*.view.php",
  ],
  theme: {
    extend: {
      colors: {
        'hoylu': {
        '50': '#f9f8ed',
        '100': '#f1edd0',
        '200': '#e5dca3',
        '300': '#d6c36e',
        '400': '#c9ac46',
        '500': '#b99839',
        '600': '#9f792f',
        '700': '#805a28',
        '800': '#6b4a28',
        '900': '#5e4027',
        '950': '#352113',
    },
    
      },
    },
  },
  plugins: [],
  corePlugins: {
    preflight: false,
  },
  prefix: 'mi-',
  important: true
}

