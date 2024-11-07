import gulp from 'gulp';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
import imagemin from 'gulp-imagemin';
import sourcemaps from 'gulp-sourcemaps';
import concat from 'gulp-concat';
import terser from 'gulp-terser-js';
import notify from 'gulp-notify';
import cache from 'gulp-cache';
import clean from 'gulp-clean';
import webp from 'gulp-webp';

// Asignar `sass` a `gulpSass`
const sass = gulpSass(dartSass);

// Desestructurar las funciones de `gulp`
const { src, dest, watch, series, parallel } = gulp;

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
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/css'))
        .pipe(notify({ message: 'CSS Compilado y Minificado' }));
}

// Función para minificar y concatenar JavaScript
function javascript() {
    return src(paths.js)
        .pipe(sourcemaps.init())
        .pipe(concat('bundle.js'))
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/js'))
        .pipe(notify({ message: 'JS Minificado' }));
}

// Función para optimizar imágenes
function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen Completada' }));
}

// Función para convertir imágenes a formato WebP
function versionWebp() {
    return src(paths.imagenes)
        .pipe(webp())
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen Completada' }));
}

// Función para vigilar cambios en archivos SCSS, JS e Imágenes
function watchArchivos() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.imagenes, imagenes);
    watch(paths.imagenes, versionWebp);
}

// Exportación de tareas
export const buildCss = css;
export const watchFiles = watchArchivos;
export default parallel(css, javascript, imagenes, versionWebp, watchArchivos);
