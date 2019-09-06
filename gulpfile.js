const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js')
       .webpack('manifest.js');
});


var gulp = require('gulp'),
    imagemin = require('gulp-imagemin');

// Default Task
gulp.task('default', ['watch']);

// Watch Task
gulp.task('watch', function() {
  gulp.watch('storage/app/public/**/*', ['compress']);
});

// Compress Task
gulp.task('compress', function() {
  gulp.src('storage/app/public/**/*')
  .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
  .on('error', function(e) { console.log(e); })
  .pipe(gulp.dest('storage/app/public/'));
});