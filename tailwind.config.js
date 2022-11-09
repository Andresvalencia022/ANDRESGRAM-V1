/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/laravel/framework/src/Illuminate/pagination/resources/views/*.blade.php", //para poder utlisar la paginacion de tailwindcss //entra a esa ruta
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
