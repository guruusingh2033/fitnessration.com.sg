var gulp = require('gulp');
var stylus = require('gulp-stylus');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var nib = require('nib');

function swallowError(error) {
  console.log(error.toString());
  this.emit('end');
}

gulp.task('default', ['stylus', 'sass']);

gulp.task('stylus', function() {
  return gulp.src(['styl/**/*.styl', '!styl/**/_*.styl'])
    .pipe(sourcemaps.init())
    .pipe(stylus({
      use: [nib()],
      'include css': true,
    }))
    .on('error', swallowError)
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('css/'));
});

gulp.task('sass', function () {
  return gulp.src(['scss/**/*.scss', '!scss/**/_*.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('css/'));
});

gulp.task('watch', function() {
  gulp.watch('styl/**/*.styl', ['stylus']);
  gulp.watch('scss/**/*.scss', ['sass']);
});
