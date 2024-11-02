import path from 'path';
import fs from 'fs';
import { glob } from 'glob';
import { src, dest, watch, series } from 'gulp';
import postcss from 'gulp-postcss';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';
import terser from 'gulp-terser';
import sharp from 'sharp';
import { deleteSync } from 'del';  // Importa deleteSync en lugar de del

// Definir rutas de archivos
const paths = {
    css: 'src/css/tailwind.css',  // Archivo fuente de Tailwind CSS
    js: 'src/js/**/*.js',          // Todos los archivos JS en src/js
    images: 'src/img/**/*.{png,jpg}'  // Todas las imágenes en src/img
};

// Tarea para limpiar las carpetas de CSS, JS, e imágenes
export async function clean() {
    deleteSync([
        'public/build/css/**', 
        'public/build/js/**', 
        'public/build/img/**', 
        '!public/build' // Mantiene la carpeta build
    ]);
}


// Tarea CSS para compilar Tailwind
export function css(done) {
    src(paths.css, { sourcemaps: true })
        .pipe(postcss([tailwindcss, autoprefixer])) // Compila Tailwind con PostCSS y Autoprefixer
        .pipe(dest('./public/build/css', { sourcemaps: '.' }));
    done();
}

// Tarea JS para minificar
export function js(done) {
    src(paths.js)
        .pipe(terser())  // Minifica JavaScript
        .pipe(dest('./public/build/js'));
    done();
}

// Tarea de procesamiento de imágenes con Sharp
export async function imagenes(done) {
    const srcDir = './src/img';
    const buildDir = './public/build/img';
    const images = await glob('./src/img/**/*');

    images.forEach(file => {
        const relativePath = path.relative(srcDir, path.dirname(file));
        const outputSubDir = path.join(buildDir, relativePath);
        procesarImagenes(file, outputSubDir);
    });
    done();
}

// Función para procesar imágenes individuales
function procesarImagenes(file, outputSubDir) {
    if (!fs.existsSync(outputSubDir)) {
        fs.mkdirSync(outputSubDir, { recursive: true });
    }
    const baseName = path.basename(file, path.extname(file));
    const extName = path.extname(file);

    if (extName.toLowerCase() === '.svg') {
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
        fs.copyFileSync(file, outputFile);
    } else {
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
        const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`);
        const outputFileAvif = path.join(outputSubDir, `${baseName}.avif`);
        const options = { quality: 80 };

        sharp(file).jpeg(options).toFile(outputFile);
        sharp(file).webp(options).toFile(outputFileWebp);
        sharp(file).avif().toFile(outputFileAvif);
    }
}

// Tarea de desarrollo para observar cambios
export function dev() {
    watch(paths.css, series(clean, css));               // Limpia y compila CSS
    watch(paths.js, series(clean, js));                 // Limpia y minifica JS
    watch(paths.images, series(clean, imagenes));       // Limpia y procesa imágenes
}

// Tarea predeterminada
export default series(clean, js, css, imagenes, dev);
