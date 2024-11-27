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
import plumber from 'gulp-plumber';

// Asignar `sass` a `gulpSass`
const sass = gulpSass(dartSass);

// Desestructurar las funciones de `gulp`
const { src, dest, watch, series, parallel } = gulp;

// Rutas de los archivos fuente
const paths = {
    scss: 'src/scss/**/*.scss',
    js: {
        public: 'src/js/app.js',
        admin: 'src/js/admin.js'
    },
    imagenes: 'src/img/**/*'
};

// Función para compilar SASS a CSS
function css() {
    return src(paths.scss)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/css'))
        .pipe(notify({ message: 'CSS Compilado y Minificado' }));
}

// Función para minificar JavaScript público
function javascriptPublic() {
    return src(paths.js.public, { allowEmpty: true })
        .pipe(plumber({
            errorHandler: function(err) {
                notify.onError({
                    title: "Error en JavaScript",
                    message: "Error: <%= error.message %>"
                })(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(terser({
            mangle: {
                toplevel: true
            }
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/js'))
        .pipe(notify({ message: 'JavaScript público compilado correctamente' }));
}

// Función para minificar JavaScript admin
function javascriptAdmin() {
    return src(paths.js.admin, { allowEmpty: true })
        .pipe(plumber({
            errorHandler: function(err) {
                notify.onError({
                    title: "Error en JavaScript Admin",
                    message: "Error: <%= error.message %>"
                })(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(terser({
            mangle: {
                toplevel: true
            }
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/js'))
        .pipe(notify({ message: 'JavaScript admin compilado correctamente' }));
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
        .pipe(notify({ message: 'Imagen en formato WebP Completada' }));
}

// Función para vigilar cambios
function watchArchivos() {
    watch(paths.scss, { interval: 1000 }, css);
    watch(paths.js.public, { interval: 1000 }, javascriptPublic);
    watch(paths.js.admin, { interval: 1000 }, javascriptAdmin);
    watch(paths.imagenes, { interval: 1000 }, imagenes);
    watch(paths.imagenes, { interval: 1000 }, versionWebp);
}

// Exportación de tareas
export const buildCss = css;
export const buildJsPublic = javascriptPublic;
export const buildJsAdmin = javascriptAdmin;
export const watchFiles = watchArchivos;
export default parallel(css, javascriptPublic, javascriptAdmin, imagenes, versionWebp, watchArchivos);
