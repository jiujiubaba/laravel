var fs = require('fs');
var path = require('path');
var merge = require('merge-stream');
var gulp = require('gulp');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

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
      return gulp.src(path.join(srcPath + 'js', folder, '/*.js'))
        .pipe(concat(folder + '.js'))
        .pipe(gulp.dest(destPath + 'js/'))
        .pipe(uglify())
        .pipe(rename(folder + '.min.js'))
        .pipe(gulp.dest(destPath + 'js/'));
   });

   return merge(tasks);
});

gulp.task('css', function(){
	var folders = getFolders(srcPath + 'css');

   	var tasks = folders.map(function(folder) {
      // 拼接成 foldername.js
      // 写入输出
      // 压缩
      // 重命名为 folder.min.js
      // 再一次写入输出
      return gulp.src(path.join(srcPath + 'css', folder, '/*.css'))
        .pipe(concat(folder + '.css'))
        .pipe(gulp.dest(destPath + 'css/'))
        .pipe(uglify())
        .pipe(rename(folder + '.min.css'))
        .pipe(gulp.dest(destPath + 'css/'));
   });

   return merge(tasks);
});