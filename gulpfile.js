const gulp = require('gulp');
const browserSync = require('browser-sync').create();

gulp.task('serve:euromus', (done) => {
  browserSync.init({
    proxy: 'http://euromus.local',
    port: 6001,
    host: '192.168.1.64',
  });

  gulp.watch('themes/classicNew/**/*.*').on('change', browserSync.reload);
  done();
});


gulp.task('serve:asd', (done) => {
  browserSync.init({
    proxy: 'http://asd.local',
    port: 6001,
    host: '192.168.1.64',
  });

  gulp.watch('themes/probusiness/**/*.*').on('change', browserSync.reload);
  done();
});

gulp.task('serve:asm', (done) => {
  browserSync.init({
    proxy: 'http://asm.local',
    port: 6001,
    host: '192.168.1.64',
  });

  gulp.watch('themes/ebusiness/**/*.*').on('change', browserSync.reload);
  done();
});