# Foresight Theme #

The steps necessary to execute the project, being the main subject.

### Version 3.0.0 ###


### Getting started ###

Before start project is neccesary install the following dependencies in your system:

* [Git](https://git-scm.com/)
* [NodeJs Version 14.15.1](https://nodejs.org)
* [gulp-cli](https://gulpjs.com/)

## Installation
```bash
# Clone the repository
$ git@github.com:AllianceBioversityCIAT/foresight.git

# Install the Gulp CLI
$ npm install --global gulp-cli

# Install the dependencies
$ npm install
```

## Configuration 
Create the `config.json` file, to run locally:

```.config
{
  "dest": "/wp-data/wp-content/themes"
}
```
When creating this file you must delete the example file `config.json.sample`, the destination location requested, is to display all files processed by gulp, in the WordPress themes folder.

## Plugins
For the construction of the project it is necessary to install the following two plugins:
- [foresight-instantsearch](https://github.com/AllianceBioversityCIAT/foresight/tree/main/foresight-instantsearch)
- [foresight-plugin-algolia](https://github.com/AllianceBioversityCIAT/foresight/tree/main/foresight-plugin-algolia)


## Running the app

```bash
# development watch mode
$ gulp watch --development

# production mode
$ gulp watch --production
```
## More information
- WordPress - [WordPress.org](https://developer.wordpress.org/themes/getting-started/)
- Twig Doc - [Twig](https://twig.symfony.com/doc/3.x/)
- Timber Doc - [Timber](https://timber.github.io/docs/)
- Tailwind Styles - [Tailwind](https://tailwindcss.com/docs/installation)
- Flowbite Icons - [Flowbite](https://flowbite.com/icons/)
- Coding Standards - [WordPress Coding Standards](https://codex.wordpress.org/WordPress_Coding_Standards)
    * [PHP](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/)
    * [HTML](https://make.wordpress.org/core/handbook/best-practices/coding-standards/html/)
    * [CSS](https://make.wordpress.org/core/handbook/best-practices/coding-standards/css/)
    * [JS](https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/)

## Stay in touch

- Authors - [Juan Manuel Lora] - [Miguel Buriticá] -  [Cafeto Software](https://cafeto.co/)
- Website - [https://foresight.cgiar.org/](https://foresight.cgiar.org/)
