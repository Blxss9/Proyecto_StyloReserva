import gulp from 'gulp';
import postcss from 'gulp-postcss';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

// Tarea para compilar CSS de Tailwind y guardarlo en build/css
gulp.task('css', () => {
    return gulp.src('src/css/tailwind.css')     // Archivo fuente
        .pipe(postcss([tailwindcss, autoprefixer]))
        .pipe(gulp.dest('public/build/css'));    // Ruta de salida
});

// Tarea de observación y compilación
gulp.task('default', () => {
    gulp.watch('src/css/**/*.css', gulp.series('css'));
});
