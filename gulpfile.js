var
    browserify = require('browserify'),
    buffer = require('vinyl-buffer'),
    coffeeify = require('coffeeify'),
    gulp = require('gulp'),
    sass = require('gulp-sass'),
    source = require('vinyl-source-stream'),
    sourcemaps = require('gulp-sourcemaps'),
    uglify = require('gulp-uglify'),
    watchify = require('watchify');


function compile(watch) {
    var
        bundler = browserify('./web/app/src/index.coffee', {
            debug: true
        })
            .transform(coffeeify);

    if (watch) {
        watchify(bundler);
        bundler.on('update', function() {
            console.log('-> bundling...');
            rebundle();
        });
    }

    rebundle();

    function rebundle() {
        bundler.bundle()
            .on('error', function(err) {
                console.error(err);
                this.emit('end');
            })
            .pipe(source('app.min.js'))
            .pipe(buffer())
            .pipe(sourcemaps.init({
                loadMaps: true
            }))
            // .pipe(uglify().on('error', e => console.log(e)))
    .pipe(sourcemaps.write('./'))
            .pipe(gulp.dest('./web/app/dist'));
    }
}

function watch() {
    return compile(true);
};

gulp.task('build', function() {
    return compile();
});
gulp.task('watch', function() {
    return watch();
});

gulp.task('sass', function() {
    return gulp.src('./web/app/assets/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./web/app/dist'));
});

gulp.task('default', ['watch']);