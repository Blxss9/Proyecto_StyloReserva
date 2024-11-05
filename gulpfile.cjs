const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const notify = require('gulp-notify');
const cache = require('gulp-cache');

// Rutas de los archivos fuente
const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
};

// Función para compilar SASS a CSS
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())                       
        .pipe(sass().on('error', sass.logError))       
        .pipe(postcss([autoprefixer(), cssnano()]))    
        .pipe(sourcemaps.write('.'))                   
        .pipe(dest('public/build/css'));               
}

// Función para minificar y concatenar JavaScript
function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())               
      .pipe(concat('bundle.js'))             
      .pipe(terser())                        
      .pipe(sourcemaps.write('.'))           
      .pipe(dest('public/build/js'));        
}

// Función para optimizar imágenes con importación dinámica de gulp-imagemin
async function imagenes() {
    const imagemin = (await import('gulp-imagemin')).default;
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 }))) 
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen Completada' }));
}

// Función para convertir imágenes a formato WebP con importación dinámica de gulp-webp
async function versionWebp() {
    const webp = (await import('gulp-webp')).default;
    return src(paths.imagenes)
        .pipe(webp())                         
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen en formato WebP Completada' }));
}

// Función para vigilar cambios en archivos SCSS, JS e Imágenes
function watchArchivos() {
    watch(paths.scss, css);                 
    watch(paths.js, javascript);            
    watch(paths.imagenes, imagenes);        
    watch(paths.imagenes, versionWebp);     
}

// Exportación de tareas
exports.css = css;
exports.javascript = javascript;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.watchArchivos = watchArchivos;
exports.default = parallel(css, javascript, imagenes, versionWebp, watchArchivos);
