"use strict";

const gulp = require("gulp");

// var gulp = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;
const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();

//var cssnano = require('gulp-cssnano');
//var sass = require('gulp-sass');
//var sourcemaps =  require('gulp-sourcemaps');
//var autoprefixer = require('gulp-autoprefixer');
//var sassdoc = require('sassdoc');

 var concatCss = require('gulp-concat-css');
 
gulp.task('css', function () {
  return gulp.src('css/**/*.css')
    .pipe(concatCss("styles/bundle.css"))
    //.pipe(gulp.dest(''));
});

 

// gulp.task('js', function () {
//     return gulp.src(['javascript/*.js'])
//         .pipe(concat('script.min.js'))
//         .on('error', onError)
//         //.pipe(babel({  presets: ['@babel/env'] }))
//         //.on('error', onError)
//         .pipe(uglify())
//         .on('error', onError)
//         .pipe(gulp.dest('js'));
// });

gulp.task('watch', function () {
    //gulp.watch('scss/*.scss', ['sass']);
    //gulp.watch('javascript/*.js', gulp.parallel('js'));
    gulp.watch('css/*.css', gulp.parallel('css'));
    gulp.watch('js/**/*.js', gulp.parallel('concat', 'uglify'));
});



// gulp.task('browser-sync', function () {
//   browserSync.init({
//     proxy: "http://localhost:8888"
//   });
// });
//gulp.task('default', gulp.series('js', 'css', 'watch', 'browser-sync', function (done) {
gulp.task('default', gulp.series( 'css', function (done) {
      //browserSync.reload();
      done();
}));

function onError(err) {
    console.log(err);
    this.emit('end');
  }