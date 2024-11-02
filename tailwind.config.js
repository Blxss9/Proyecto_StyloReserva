/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./public/**/*.php",        // Escanea todos los archivos PHP en la carpeta public
    "./src/**/*.js",            // Escanea archivos JS en src 
    "./src/**/*.css",           // Escanea archivos CSS en src
    "./views/**/*.php",         // Escanea archivos PHP en views (si usas vistas en esa carpeta)
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

