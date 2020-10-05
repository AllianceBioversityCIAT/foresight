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
 * This function compiles source *.scss files and concatenates them into a rtl file.
 * @function cssRtl
 * @return { stream } - returns a gulp stream.
 */
function cssRtlTask() {
  return gulp.src( './src/static/sass/style.scss' )
    .pipe( sourcemaps.init() )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass() )
    .pipe( rtlcss() )
    .pipe( rename( { basename: 'rtl' } ) )
    .pipe( postcss( [ autoprefixer, cssnano ] ) )
    .pipe( sourcemaps.write( '/' ) )
    .pipe( gulp.dest( destFolder )
  );
}

/**
 * This function gets libraries *css files.
 * @function cssLibrariesTask
 * @return { stream } - returns a gulp stream.
 */
function cssLibrariesTask() {
  return gulp.src( [
      './node_modules/bootstrap/dist/css/bootstrap.min.css',
    ] )
    .pipe( gulp.dest( destFolder + '/static/lib/css/' )
  );
}

/**
 * This function gets libraries *.js files.
 * @function jsLibrariesTask
 * @return { stream } - returns a gulp stream
 */
function jsLibrariesTask() {
  return gulp.src( [
      './node_modules/bootstrap/dist/js/bootstrap.min.js',
    ] )
    .pipe( gulp.dest( destFolder + '/static/lib/js/' )
  );
}

/**
 * This function concatenates source *.js files into a single file.
 * @function js
 * @return { stream } - returns a gulp stream
 */
function jsTask() {
  return gulp.src( './src/static/js/**/*.js' )
    .pipe( concat( 'main.js' ) )
    .pipe( sourcemaps.init() )
    .pipe( babel( {
      presets: [ "@babel/preset-env" ]
    } ) )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( uglify() )
    .pipe( sourcemaps.write( '/' ) )
    .pipe( gulp.dest( destFolder + '/static/js/' )
  );
}

/**
 * This function minify the images and transfers them to a location.
 * @function images
 * @return { stream } - returns a gulp stream
 */
function imagesTask() {
  return gulp.src( './src/static/images/**/*.{png,jpg,gif,svg}' )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( imagemin( { optimizationLevel: 7, progressive: true } ) )
    .pipe( gulp.dest( destFolder + '/static/images/' )
  );
}

/**
 * This function obtains everything that keeps selling, to transfer it to the subject.
 * @function vendor
 * @return { stream } - returns a gulp stream
 */
function vendorTask() {
  return gulp.src( [
    './vendor/**/*',
  ] )
    .pipe( gulp.dest( destFolder + '/theme/vendor/' )
    );
}

/**
 * This function creates the theme folder tree.
 * @function scaffolding
 * @return { stream } - returns a gulp stream
 */
function scaffolding() {
  return gulp.src( [
      'src/**/*',
      '!src/static/sass/**',
      '!src/static/js/**',
      '!src/static/images/**'
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
  gulp.watch( './src/**/*.{php,twig}', scaffolding, vendorTask );

  // Watch CSS files
  gulp.watch( './src/static/sass/**/*.scss', cssTask, cssLibrariesTask, cssRtlTask );

  // Watch Javascript files.
  gulp.watch( './src/static/js/**/*.js', jsTask, jsLibrariesTask );

  // Watch images files.
  gulp.watch( './src/static/images/**/*.{png,jpg,gif}', imagesTask );
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

function updateWpVersion(cb){
  var pInfo = require( './package.json' );
  var banner = ['/*!',
    'Theme Name: ' + pInfo.name,
    'Description:' + pInfo.description,
    'Author: '+ pInfo.author,
    'Version: '+ pInfo.version,
    'Tags: ' + (pInfo.keywords).join(' '),
    'Requires at least: 5.0',
    'Tested up to: 5.4',
    '*/',
    ''].join('\n');
  fs.writeFile( 'src/static/sass/variables-site/_version.scss', banner, cb);
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
  vendorTask,
  gulp.parallel(cssTask, cssLibrariesTask, cssRtlTask, jsTask, jsLibrariesTask, imagesTask)
);
const reload = gulp.series( build, gulp.parallel( watchTask ) );

// Exports
exports.scaffolding = scaffolding;
exports.vendorTask = vendorTask;
exports.cssTask = cssTask;
exports.cssLibrariesTask = cssLibrariesTask;
exports.cssRtlTask = cssRtlTask;
exports.jsTask = jsTask;
exports.jsLibrariesTask = jsLibrariesTask;
exports.imagesTask = imagesTask;
exports.clean = clean;

exports.watch = reload;
exports.build = build;
exports.default = build;
exports.package = gulp.series( updateWpVersion, build, package, prerelease );
