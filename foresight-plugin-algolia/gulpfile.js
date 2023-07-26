require( 'es6-promise' ).polyfill();

var config = {
  "dest": "./build"
};

try {
    var config = require('./config.json');
} catch (ex) {
}

var projectInfo = require( './package.json' ),
    destFolder = (config.dest) + '/' + projectInfo.name;

var gulp =        require( 'gulp' ),
  fs =            require( 'fs' ),
  babel =         require( 'gulp-babel' ),
  sass =          require( 'gulp-sass' ),
  rtlcss =        require( 'gulp-rtlcss' ),
  postcss =       require( 'gulp-postcss' ),
  autoprefixer =  require( 'gulp-autoprefixer' ),
  cssnano =       require( 'cssnano' ),
  plumber =       require( 'gulp-plumber' ),
  gutil =         require( 'gulp-util' ),
  rename =        require( 'gulp-rename' ),
  concat =        require( 'gulp-concat' ),
  sourcemaps =    require( 'gulp-sourcemaps' ),
  uglify =        require( 'gulp-uglify' ),
  imagemin =      require( 'gulp-imagemin' ),
  del =           require( 'del' ),
  bump =          require( 'gulp-bump' ),
  zip =           require('gulp-zip');

var onError = function ( err ) {
  console.log( 'An error occurred:', gutil.colors.magenta( err.message ) );
  gutil.beep();
  this.emit( 'end' );
};

/**
 * This function compiles source *.scss files and concatenates them into a single file.
 * @function css
 * @return { stream } - returns a gulp stream.
 */
function cssTask() {
  return gulp.src( './src/static/sass/style.scss' )
    .pipe( sourcemaps.init() )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass() )
    .pipe( postcss( [ autoprefixer, cssnano ] ) )
    .pipe( sourcemaps.write( '/' ) )
    .pipe( gulp.dest( destFolder )
  );
}

/**
 * This function creates the plugin folder tree.
 * @function scaffolding
 * @return { stream } - returns a gulp stream
 */
function scaffolding() {
  return gulp.src( [
      'src/**/*',
    ] )
    .pipe( gulp.dest( destFolder )
  );
}

/**
 * This function appends scaffolding, js and css.
 * @function watchFiles
 */
function watchTask() {

  // Watch Php files.
  gulp.watch( './src/**/*.{php,twig}', scaffolding );

}

/**
 * This function clean config.destPath (delete all files in folder)
 * @function clean
 * @return { stream } - returns a gulp stream
 */
function clean( cb ) {
  del.sync( [ destFolder + '/**/**' ], { force: true } );
  cb();
}

function prerelease(){
  return gulp.src('./package.json')
    .pipe(bump({type:'prerelease'}))
    .pipe(gulp.dest('./')
  );
}

function package(){
  var pInfo = require( './package.json' );
  return gulp.src( destFolder + '/**', {base: config.dest} )
		.pipe(zip( pInfo.name + '_' + pInfo.version + '.zip'))
		.pipe(gulp.dest('dist'))
}

const build = gulp.series(
  clean,
  scaffolding,
  gulp.parallel(cssTask)
);
const reload = gulp.series( build, gulp.parallel( watchTask ) );

// Exports
exports.scaffolding = scaffolding;
exports.cssTask = cssTask;
exports.clean = clean;

exports.watch = reload;
exports.build = build;
exports.default = build;
exports.package = gulp.series( build, package, prerelease );