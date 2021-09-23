require( 'es6-promise' ).polyfill();
var buildConfig  = require( './gulp.config' ),
    gulp         = require( 'gulp' ),
    fs           = require( 'fs' ),
    babel        = require( 'gulp-babel' ),
    header       = require( 'gulp-header' ),
    sass         = require( 'gulp-sass' ),
    rtlcss       = require( 'gulp-rtlcss' ),
    postcss      = require( 'gulp-postcss' ),
    autoprefixer = require( 'gulp-autoprefixer' ),
    cssnano      = require( 'cssnano' ),
    plumber      = require( 'gulp-plumber' ),
    gutil        = require( 'gulp-util' ),
    rename       = require( 'gulp-rename' ),
    concat       = require( 'gulp-concat' ),
    sourcemaps   = require( 'gulp-sourcemaps' ),
    uglify       = require( 'gulp-uglify' ),
    imagemin     = require( 'gulp-imagemin' ),
    del          = require( 'del' ),
    bump         = require( 'gulp-bump' ),
    iconfont     = require( 'gulp-iconfont' ),
    iconfontCss  = require( 'gulp-iconfont-css' ),
    zip          = require( 'gulp-zip' ),
    mode         = require( 'gulp-mode' )();

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
  return gulp.src( buildConfig.sources.principalCSSFiles )
    .pipe( mode.development( sourcemaps.init() ) )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( header( buildConfig.sources.banner.join( '\n' ) ) )
    .pipe( sass() )
    .pipe( postcss( [ autoprefixer, cssnano ] ) )
    .pipe( ( mode.development( sourcemaps.write( '/' ) ) ) )
    .pipe( gulp.dest( buildConfig.destination.destFolder )
    );
}

/**
 * This function compiles source *.scss files and concatenates them into a single file.
 * @function css
 * @return { stream } - returns a gulp stream.
 */
function cssAll() {
  return gulp.src( buildConfig.sources.allScssFiles )
    .pipe( mode.development( sourcemaps.init() ) )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass() )
    .pipe( postcss( [ autoprefixer, cssnano ] ) )
    .pipe( ( mode.development( sourcemaps.write( '/' ) ) ) )
    .pipe( gulp.dest( buildConfig.destination.allScssFiles )
    );
}

/**
 * This function compiles source *.scss files and concatenates them into a rtl file.
 * @function cssRtl
 * @return { stream } - returns a gulp stream.
 */
function cssRtlTask() {
  return gulp.src( buildConfig.sources.principalCSSFiles )
    .pipe( mode.development( sourcemaps.init() ) )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( header( buildConfig.sources.banner.join( '\n' ) ) )
    .pipe( sass() )
    .pipe( rtlcss() )
    .pipe( rename( { basename: 'rtl' } ) )
    .pipe( postcss( [ autoprefixer, cssnano ] ) )
    .pipe( ( mode.development( sourcemaps.write( '/' ) ) ) )
    .pipe( gulp.dest( buildConfig.destination.destFolder )
    );
}

function iconFont() {
  return gulp.src( buildConfig.sources.iconFont )
    .pipe( iconfontCss( {
      path: './src/static/lib/fonts/icons_template.css',
      fontName: 'themeFont',
      targetPath: '../../lib/fonts/icons.css',
      fontPath: './'
    } ) )
    .pipe( iconfont( {
      fontName: 'themeFont', // required
    } ) )
    // .on('glyphs', function(glyphs, options) {
    //   console.log(glyphs, options);
    //   // the value for unicode in the glyphs object is a question mark in a box
    // })
    .pipe( gulp.dest( buildConfig.destination.iconFont ) );
}

/**
 * This function gets libraries *.js files.
 * @function LibrariesTask
 * @return { stream } - returns a gulp stream
 */
function LibrariesTask() {
  return gulp.src( buildConfig.sources.allLibFiles, {
    base: './node_modules/'
  } )
    .pipe( gulp.dest( buildConfig.destination.allLibFiles ) );
}

/**
 * This function concatenates source *.js files into a single file.
 * @function js
 * @return { stream } - returns a gulp stream
 */
function jsTask() {
  return gulp.src( buildConfig.sources.allJsFiles )
    .pipe( concat( 'main.js' ) )
    .pipe( mode.development( sourcemaps.init() ) )
    .pipe( babel( {
      presets: [ "@babel/preset-env" ]
    } ) )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( uglify() )
    .pipe( ( mode.development( sourcemaps.write( '/' ) ) ) )
    .pipe( gulp.dest( buildConfig.destination.allJsFiles )
    );
}

/**
 * This function minify the images and transfers them to a location.
 * @function images
 * @return { stream } - returns a gulp stream
 */
function imagesTask() {
  return gulp.src( buildConfig.sources.allImgFiles )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( imagemin( { optimizationLevel: 7, progressive: true } ) )
    .pipe( gulp.dest( buildConfig.destination.allImgFiles )
    );
}

/**
 * This function creates the theme folder tree.
 * @function scaffolding
 * @return { stream } - returns a gulp stream
 */
function scaffolding() {
  return gulp.src( buildConfig.sources.scaffolding )
    .pipe( gulp.dest( buildConfig.destination.destFolder )
    );
}

/**
 * This function appends scaffolding, js and css.
 * @function watchFiles
 */
function watchTask() {

  // Watch Php files.
  gulp.watch( buildConfig.sources.sourceFolder + '/**/*.{php,twig}', scaffolding );

  // Watch CSS files
  gulp.watch( buildConfig.sources.sourceFolder + '/static/sass/**/*.scss', cssTask, cssRtlTask, iconFont );
  gulp.watch( buildConfig.sources.sourceFolder + '/static/sass/**/*.scss', cssAll );

  // Watch Javascript files.
  gulp.watch( buildConfig.sources.sourceFolder + '/static/js/**/*.js', jsTask, LibrariesTask );

  // Watch images files.
  gulp.watch( buildConfig.sources.sourceFolder + '/static/images/**/*.{png,jpg,gif}', imagesTask );

  // Watch Algolia files.
  gulp.watch( buildConfig.sources.sourceFolder + '/static/algolia/*.{css,js,jpg,png}', scaffolding );
}

/**
 * This function clean config.destPath (delete all files in folder)
 * @function clean
 * @return { stream } - returns a gulp stream
 */
function clean( cb ) {
  del.sync( [ buildConfig.destination.destFolder + '/**/**' ], { force: true } );
  cb();
}

function prerelease() {
  return gulp.src( './package.json' )
    .pipe( bump( { type: 'prerelease' } ) )
    .pipe( gulp.dest( './' )
    );
}

function updateWpVersion( cb ) {
  var banner = buildConfig.sources.banner.join( '\n' );
  fs.writeFile( buildConfig.sources.version, banner, cb );
}

function package() {
  return gulp.src( buildConfig.destination.destFolder + '/**', { base: buildConfig.general.dest } )
    .pipe( zip( buildConfig.general.package.name + '_' + buildConfig.general.package.version + '.zip' ) )
    .pipe( gulp.dest( buildConfig.destination.buildPackage ) )
}

const build  = gulp.series(
  clean,
  scaffolding,
  gulp.parallel( cssTask, cssAll, cssRtlTask, iconFont, jsTask, LibrariesTask, imagesTask )
);
const reload = gulp.series( build, gulp.parallel( watchTask ) );

exports.watch   = reload;
exports.build   = build;
exports.default = build;
exports.package = gulp.series( updateWpVersion, build, package, prerelease );
