var gulp = require('gulp');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var concat = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');

gulp.task('css', function(){
  gulp.src('assets/css/dev/*.css')
    .pipe(minifyCSS())
    .pipe(concat('style.min.css'))
    .pipe(gulp.dest('assets/css'));
});

gulp.task('default', function() {
  browserSync({
    server: {
      baseDir: 'app'
    }
  });

  gulp.src('assets/css/dev/**/*.css')
    .pipe(minifyCSS())
    .pipe(concat('style.min.css'))
    .pipe(gulp.dest('assets/css'));

  gulp.watch(['*.html', 'css/dev/*.css', 'scripts/**/*.js'], {cwd: 'assets'}, ['css', reload]);
});