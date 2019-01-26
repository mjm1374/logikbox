var gulp = require('gulp');
var browserify = require('browserify');
//var watch = require('gulp-watch');
var fs = require('fs');
var source = require('vinyl-source-stream');

 
  gulp.task('browserify', function () {
    var bundle = browserify({
      entries: ['js/nodeScripts.js'],
      debug: true
    });

    return bundle.bundle()
    .pipe(source('js/nodeScripts.js'))
    .pipe(gulp.dest('./jsbundle.js'));
    
});

  gulp.task('watch', function () {
    gulp.watch('js/nodeScripts.js', ['browserify']);
   // gulp.watch('javascript/*.js', ['js']);
});

gulp.task('default', ['browserify', 'watch']);

