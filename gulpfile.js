var gulp = require('gulp');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var concat = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');
var rsync = require('rsyncwrapper').rsync;

gulp.task('rsync', function() {
	rsync({
    src: './app/',
    dest: 'leonardo@leonardofaria.net:~/public_html/writingskills.leonardofaria.net',
    recursive: true,
    deleteAll: true,
    exclude: ['.DS_Store'],
    args: [ '--verbose' ]
  }, function(error, stdout, stderr, cmd) {
    console.log(stdout, 'END!');
  });
});

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