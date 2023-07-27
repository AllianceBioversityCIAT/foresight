#!/bin/bash
absolute_path=($(jq -r '.dest' config.json))
echo $absolute_path
mkdir -p $absolute_path/algolia
mv -f ./dist/app.mobile.*.css $absolute_path/algolia/app.mobile.css
mv -f ./dist/app.desktop.*.css $absolute_path/algolia/app.desktop.css
mv -f ./dist/theme.*.css $absolute_path/algolia/theme.css
mv -f ./dist/year-slider.*.css $absolute_path/algolia/year-slider.css
mv -f ./dist/app.*.js $absolute_path/algolia/app.js
mv -f ./dist/cover-desktop.*.jpg $absolute_path/algolia/
mv -f ./dist/cover-mobile.*.jpg $absolute_path/algolia/
mv -f ./dist/favicon.*.png $absolute_path/algolia/favicon.png
cp -R ./src/images/sdg/ $absolute_path/algolia/sdg