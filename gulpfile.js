var gulp = require('gulp');

var sass = require('gulp-sass');

gulp.task('sass', function() {
    return gulp.src('./resources/styles/spiral/vault/vault.scss')
        .pipe(sass())
        .pipe(gulp.dest('./resources/styles/spiral/vault/'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('resources/styles/vault/*.scss', ['sass']);
});

// Default Task
gulp.task('default', ['sass', 'watch']);
