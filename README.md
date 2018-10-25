# Welcome to Mercury
#### YOU NEED `PHP 7+`
`we really have no time, we need to work as fast as possible`
* I might add milestones to this repo.
* and Issues;
#### Clone the app.
```git 
$ git clone https://github.com/MohammedAl-Rowad/Mercury-web-Laravel-5.6.git
```
#### Install all the PHP dependencies
* install [composer](https://getcomposer.org/download/)
* then run 
``` composer
$ composer install
```
#### Install all the JavaScript dependencies 
* install [NodeJs](https://nodejs.org/en/download/) 
* then run
``` npm
$ npm install
```
#### Configure the application
 - rename the `.env.example` to `.env` and configure the file to match your machine. see [how](https://laravel.com/docs/5.6/configuration)
 - now run
```cmd
php artisan key:generate 
```
#### Run this command to create the tables
* you need to have a database called `mercury`
```php 
$ php artisan migrate
```
#### This will run your app on port 8000
```php
$ php artisan serve
```
- if want to change the port number for some reason use : 
```php
$ sudo php artisan serve --port=8080
```
- easier options are  `laravel valet` or `homestead`
 
#### write the front-end code in `/resources/assets`
- `/resources/assets/js` please separate the js files into modules.
- `/resources/assets/sass` is for the css, and please separate the files to make if easier to read and maintain.
- You need To run the following command so the code can be compiled and bundled:
* for each change
```npm
$ npm run dev
```
* or `watch` every change and compile it automatically
```
$ npm run watch
```
#### If you want to seed the database just run the seeders in `/database/seeds`
* [how to do it](https://laravel.com/docs/5.6/seeding) 
* if you used the seed all the users password will be `secret`
#### Libraries That we are using right now
- PHP [faker](https://github.com/fzaninotto/Faker) for seeding the database;
- [AOS ](https://michalsnik.github.io/aos/) for good animation.
- [JQuery](https://jquery.com/).
- [Webpack](https://webpack.js.org/) & [Babel](https://babeljs.io/) for bundling and compiling [ES6](http://es6-features.org/#Constants) and [SASS](https://sass-lang.com/), of course using [Laravel Mix](https://laravel.com/docs/5.7/mix).
- [Materialize-css](https://materializecss.com/) for styling and making the website responsive.
- [Axios](https://github.com/axios/axios) A promise based HTTP client for the browser and node.js.
- Little bit of [Vuejs](https://vuejs.org/).
- [particlesjs](https://vincentgarreau.com/particles.js/) .
# NOTES 
* Please commit after each day of work.
# SOME ISSUES YOU MIGHT HAVE 
* You Might face som errors with the package.json file, because I'm using linux ubuntu `nodejs configuration on it is different from windows`
* if you had the problem, replace your package.json with this
```json
{
    "private": true,
    "scripts": {
        "dev": "npm run development",
        "development": "cross-env NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",
        "watch": "npm run development -- --watch",
        "watch-poll": "npm run watch -- --watch-poll",
        "hot": "cross-env NODE_ENV=development node_modules/webpack-dev-server/bin/webpack-dev-server.js --inline --hot --config=node_modules/laravel-mix/setup/webpack.config.js",
        "prod": "npm run production",
        "production": "cross-env NODE_ENV=production node_modules/webpack/bin/webpack.js --no-progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js"
    },
    "devDependencies": {
        "axios": "^0.18",
        "cross-env": "^5.2.0",
        "eslint": "^5.7.0",
        "laravel-mix": "^2.1.14",
        "lodash": "^4.17.4"
    },
    "dependencies": {
        "aos": "^3.0.0-beta.6",
        "jquery": "^3.3.1",
        "materialize-css": "^1.0.0-rc.2"
    }
}
```
