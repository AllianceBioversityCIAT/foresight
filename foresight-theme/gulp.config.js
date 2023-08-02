var package = require( './package.json' ),
    config  = {
      'dest': './build'
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
    principalCSSFiles: './src/static/css/style.css',
    allImgFiles: [
      './src/static/images/**/*.{png,jpg,jpeg,gif,svg}'
    ],
    allLibFiles: [
      // Font Awesome
      './node_modules/@fortawesome/fontawesome-free/css/all.min.css',
      './node_modules/@fortawesome/fontawesome-free/webfonts/**',
      // Lazysizes
      './node_modules/lazysizes/lazysizes.min.js',
      //Jquery
      './node_modules/jquery/dist/jquery.slim.min.js',
      // Flowbite
      './node_modules/flowbite/dist/flowbite.min.js',
      './node_modules/flowbite/dist/flowbite.min.css',
    ],
    scaffolding: [
      'src/**/*',
      '!src/static/css/**',
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
      'Requires at least: 6.2.2',
      'Tested up to: 6.2.2',
      '*/',
      ' '
    ],
    iconFont: './src/static/images/icons/*.svg',
  },
  destination: {
    destFolder: destinationFolder,
    allJsFiles: destinationFolder + '/static/js/',
    principalCSSFiles: destinationFolder + '/',
    allImgFiles: destinationFolder + '/static/images/',
    allLibFiles: destinationFolder + '/static/lib/',
    iconFont: destinationFolder + '/static/lib/fonts/',
    buildPackage: 'dist',
  }
};
