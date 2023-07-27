#!/bin/bash
mkdir -p $1/algolia
mv -f ./dist/app.mobile.*.css $1/algolia/app.mobile.css
mv -f ./dist/app.desktop.*.css $1/algolia/app.desktop.css
mv -f ./dist/theme.*.css $1/algolia/theme.css
mv -f ./dist/year-slider.*.css $1/algolia/year-slider.css
mv -f ./dist/app.*.js $1/algolia/app.js
mv -f ./dist/cover-desktop.*.jpg $1/algolia/
mv -f ./dist/cover-mobile.*.jpg $1/algolia/
mv -f ./dist/favicon.*.png $1/algolia/favicon.png
cp -R ./src/images/sdg/ $1/algolia/sdg/