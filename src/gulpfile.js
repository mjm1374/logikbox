"use strict";

const gulp = require("gulp");
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;
const babel = require('gulp-babel');
const browsersync = require("browser-sync").create();
const concatCss = require('gulp-concat-css');
const cssnano = require("cssnano");
const autoprefixer = require("autoprefixer");
const postcss = require("gulp-postcss");
const plumber = require("gulp-plumber");
const sourcemaps = require('gulp-sourcemaps');

// BrowserSync
function browserSync(done) {
  browsersync.init({
      proxy: "localhost:8888",
      baseDir: "./",
      open: true,
      notify: false
  });
  done();
}

// BrowserSync Reload
function browserSyncReload(done) {
  browsersync.reload();
  done();
}

function defaultTask(done) {
  // place code for your default task here
  console.log('Gulp 4 is runnging');
  build();
  watch();
  done();
}

function watchFiles(done) {
  gulp.watch('css/*.css', css);
  gulp.watch('javascript/**/*.js', scripts);
  gulp.watch("./app/*.php").on("change", browserSyncReload);
  done();
}

// CSS task
function css() {
  return gulp
    .src('css/**/*.css')
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(concatCss("styles/bundle.css"))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('maps'))
    .pipe(gulp.dest('./'))
    // .pipe(sass({
    //   outputStyle: "expanded"
    // }))
    // .pipe(gulp.dest("./_site/assets/css/"))
    // .pipe(rename({
    //   suffix: ".min"
    // }))
    // 
    // .pipe(gulp.dest("./_site/assets/css/"))
    .pipe(browsersync.stream())
    ;
}

// Transpile, concatenate and minify scripts
function scripts() {
  return (
    gulp
    .src(['javascript/*.js'])
    .pipe(sourcemaps.init())
     .pipe(babel({
       presets: ['@babel/env']
     }))
    .pipe(plumber())
    .pipe(concat('script.min.js'))
    .on('error', onError)
    //.pipe(babel({  presets: ['@babel/env'] }))
    //.on('error', onError)
    .pipe(uglify())
    .on('error', onError)
    .pipe(sourcemaps.write('maps'))
    .pipe(gulp.dest('./js'))
    .pipe(browsersync.stream())
  );
}

function onError(err) {
  console.log(err);
  this.emit('end');
}

const watch = gulp.parallel(watchFiles, browserSync);
const js = gulp.series( scripts);
const build = gulp.series( gulp.parallel(css,js));

exports.watch = watch;
exports.build = build;
exports.js = js;
exports.default = defaultTask;