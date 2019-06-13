var gulp = require('gulp');
//var cssnano = require('gulp-cssnano');
//var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify-es').default;
var babel = require('gulp-babel');
//var sourcemaps =  require('gulp-sourcemaps');
//var autoprefixer = require('gulp-autoprefixer');
//var sassdoc = require('sassdoc');

var concatCss = require('gulp-concat-css');
 
gulp.task('css', function () {
  return gulp.src('css/**/*.css')
    .pipe(concatCss("styles/bundle.css"))
    .pipe(gulp.dest(''));
});

// gulp.task('sass', function () {
//     return gulp.src('scss/*.scss')
//         .pipe(sourcemaps.init())
//         .pipe(sass())
//         .pipe(sourcemaps.write())
//         .pipe(autoprefixer())
//         .pipe(cssnano())
//         .pipe(gulp.dest('css'))
//         .pipe(sassdoc())
//         // Release the pressure back and trigger flowing mode (drain)
//         // See: http://sassdoc.com/gulp/#drain-event
//         .resume();
// });

gulp.task('js', function () {
    return gulp.src(['javascript/*.js'])
        .pipe(concat('script.min.js'))
        .on('error', onError)
        //.pipe(babel({  presets: ['@babel/env'] }))
        //.on('error', onError)
        .pipe(uglify())
        .on('error', onError)
        .pipe(gulp.dest('js'));
});

gulp.task('watch', function () {
    //gulp.watch('scss/*.scss', ['sass']);
    gulp.watch('javascript/*.js', ['js']);
    gulp.watch('css/*.css', ['css']);
});

gulp.task('default', ['js', 'css', 'watch']);

function onError(err) {
    console.log(err);
    this.emit('end');
  }