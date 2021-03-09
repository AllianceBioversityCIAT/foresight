var package = require( './package.json' ),
    config  = {
      "dest": "./build"
    };

try {
  config = require( './config.json' );
} catch ( ex ) {
}

var destinationFolder = ( config.dest ) + '/' + package.name;

module.exports = {
  general: {
    dest: config.dest,
    package: package,
  },
  sources: {
    sourceFolder: './src',
    allJsFiles: [
      './src/static/js/**/*.js',
    ],
    allScssFiles: [
      './src/static/sass/style.scss',
    ],
    allImgFiles: [
      './src/static/images/**/*.{png,jpg,gif,svg}'
    ],
    allLibFiles: [
      // Bootstrap
      './node_modules/bootstrap/dist/css/bootstrap.min.css',
      './node_modules/bootstrap/dist/js/bootstrap.min.js',
      // Font Awesome
      './node_modules/@fortawesome/fontawesome-free/css/all.css',
      './node_modules/@fortawesome/fontawesome-free/webfonts/**',
    ],
    vendorScripts: [
      './vendor/**/*'
    ],
    scaffolding: [
      'src/**/*',
      '!src/static/sass/**',
      '!src/static/js/**',
      '!src/static/images/**'
    ],
    version: 'src/static/sass/variables-site/_version.scss',
    banner: [
      '/*!',
      'Theme Name: ' + package.name,
      'Description:' + package.description,
      'Author: ' + package.author,
      'Version: ' + package.version,
      'Tags: ' + ( package.keywords ).join( ' ' ),
      'Requires at least: 5.0',
      'Tested up to: 5.4',
      '*/',
      ''
    ]
  },
  destination: {
    destFolder: destinationFolder,
    allJsFiles: destinationFolder + '/static/js/',
    allScssFiles: destinationFolder + '/',
    allImgFiles: destinationFolder + '/static/images/',
    allLibFiles: destinationFolder + '/static/lib/',
    vendorScripts: destinationFolder + '/theme/vendor/',
    buildPackage: 'dist',
  }
};
