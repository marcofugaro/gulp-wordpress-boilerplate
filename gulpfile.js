var gulp = require('gulp');
var jshint = require( 'gulp-jshint' );
var uglify = require( 'gulp-uglify' );
var concat = require('gulp-concat');
var gzip = require( 'gulp-gzip' );
var rename = require('gulp-rename');
var sass = require( 'gulp-sass' );
var autoprefixer = require('gulp-autoprefixer');
var imagemin = require( 'gulp-imagemin' );
var pngquant = require('imagemin-pngquant');
var del = require('del');
var runSequence = require('run-sequence');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync');



/*----------------------------------------
                STYLES
-----------------------------------------*/
gulp.task('styles', function() { 
    return gulp.src('src/scss/style.scss')  
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))  
        .pipe(autoprefixer({ browsers: ['last 2 versions', 'ie >= 9'] }))
//        .pipe(gzip())               //TODO does gzip work with wordpress theme comment? 
        .pipe(gulp.dest('build'));  
});



/*----------------------------------------
                 SCRIPTS
-----------------------------------------*/
gulp.task('scripts:vendor', function() { 
    return gulp.src(['src/js/vendor/jquery*.js', 'src/js/vendor/*.js']) //TODO HANDLE DEPENDENCIES 
        .pipe(concat('vendor.min.js'))
        .pipe(uglify())
//        .pipe(gzip())
        .pipe(gulp.dest('build/js'));  
});

gulp.task('scripts:main', function() {
    return gulp.src('src/js/main.js')
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(uglify())
//        .pipe(gzip())
        .pipe(gulp.dest('build/js'));
});

gulp.task('scripts', ['scripts:vendor', 'scripts:main']);



/*----------------------------------------
                IMAGES
-----------------------------------------*/
gulp.task( 'images', function () {
	return gulp.src('src/images/*.{png,jpg,gif}')
		.pipe( imagemin({
			optimizationLevel: 5,
			progressive: true,
            use: [pngquant()]
		}) )
		.pipe(gulp.dest('build/images'));
});




/*----------------------------------------
                BROWSER SYNC
-----------------------------------------*/
gulp.task('server', function() {
    connect.server({}, function (){
        browserSync({
            proxy: '127.0.0.1:80',
            server: './build'
        });
    });

    gulp.watch('**/*.php').on('change', function () {
        browserSync.reload();
    });
});





/*----------------------------------------
                FONTS
-----------------------------------------*/
//NEWER
//MODERNIZR
//NOTIFY
//config object with paths
//Bower or browserify


gulp.task('clean', function() { 
    return del(['build']);
});

/*----------------------------------------
                WATCH
-----------------------------------------*/
gulp.task('watch:css', function() {
    gulp.watch('src/scss/**/*.scss', ['styles']);
});

gulp.task('watch:images', function() {
    gulp.watch('src/images/*', ['images']);
});

gulp.task('watch:scripts', function() {
    gulp.watch('src/scripts/main.js', ['scripts:main']);
    gulp.watch('src/scripts/vendor/*', ['scripts:vendor']);
});



gulp.task('watch', ['watch:scripts', 'watch:css', 'watch:images']);




//gulp.task('build', gulp.series('clean', gulp.parallel('styles', 'scripts', 'images'))); //TODO use this when gulp 4.0 is out
//gulp.task('default', gulp.series('build', 'watch'));

gulp.task('build', function() {
    runSequence('clean', ['styles', 'scripts', 'images']);
});
gulp.task('default', ['build', 'watch']);