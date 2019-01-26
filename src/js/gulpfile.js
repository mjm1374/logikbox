var gulp = require('gulp');
var browserify = require('browserify');
var watch = require('gulp-watch');
var fs = require('fs');
 

  gulp.task('default', () => {
    browserify({
      entries: 'js/nodeScripts.js',
      debug: true
    })
    .bundle()
    .pipe(fs.createWriteStream('js/bundle.js'));
  });