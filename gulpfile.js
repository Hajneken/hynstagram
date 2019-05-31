const gulp = require('gulp');
const sass = require('gulp-sass');
const browserSync = require('browser-sync').create();

// compile SCSS into css 

function style(){
    // 1. where is my scss 
    return gulp.src('./resources/scss/main.scss')
    .pipe(sass()).pipe(gulp.dest('./templates'))
    .pipe(browserSync.stream());
}

// watch for changes and update automatically
function watch(){
    browserSync.init({
        server: {
            baseDir: './'
        }
    });
    gulp.watch('./resources/scss/**/*.scss', style);
    gulp.watch('./*.html').on('change', browserSync.reload);
    gulp.watch('./resources/js/*.js').on('change', browserSync.reload);
}

exports.style = style;
exports.watch = watch;

