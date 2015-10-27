var fs = require('fs');
var path = require('path');
var merge = require('merge-stream');
var gulp = require('gulp');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var minifycss = require('gulp-minify-css');

var srcPath = './resources/assets/';
var destPath = './frontend/asset/';

function getFolders(dir) {
    return fs.readdirSync(dir)
      .filter(function(file) {
        return fs.statSync(path.join(dir, file)).isDirectory();
      });
}

gulp.task('scripts', function() {
   var folders = getFolders(srcPath + 'js');

   var tasks = folders.map(function(folder) {
      // 拼接成 foldername.js
      // 写入输出
      // 压缩
      // 重命名为 folder.min.js
      // 再一次写入输出
      return gulp.src(path.join(srcPath + 'js/', folder, '/*.js'))
        .pipe(concat(folder + '-68e3c72.js'))
        .pipe(gulp.dest(destPath + 'js/'))
        .pipe(uglify())
        .pipe(rename(folder + '-68e3c72.min.js'))
        .pipe(gulp.dest(destPath + 'js/'));
   });

   return merge(tasks);
});

gulp.task('css', function(){
	var folders = getFolders(srcPath + 'css');

   	var tasks = folders.map(function(folder) {
      return gulp.src(path.join(srcPath + 'css/', folder, '/*.css'))
        .pipe(concat(folder + '-68e3c72.css'))
        .pipe(gulp.dest(destPath + 'css/'))
        .pipe(minifycss())
        .pipe(rename(folder + '-68e3c72.min.css'))
        .pipe(gulp.dest(destPath + 'css/'));
   });

   return merge(tasks);
});

gulp.task('watch', function(){
    gulp.watch(srcPath + 'js/**/*.js', ['scripts']);
    gulp.watch(srcPath + 'css/**/*.css', ['css']);
});

gulp.task('serve', ['scripts', 'css', 'watch'], function () {
    
});