# Welcome to Mercury
# :neckbeard:
#### YOU NEED `PHP 7+`
#### Clone the app.
```git 
$ git clone https://github.com/MohammedAl-Rowad/Mercury-web-Laravel-5.6.git
```
#### Install all the PHP dependencies 
``` composer
$ composer install
```
#### Install all the JavaScript dependencies 
``` npm
$ npm install
```
#### Configure the application
 - rename the `.env.example` to `.env` and configure the file to match your machine.
#### Run this command to create the tables
```php 
$ php artisan migrate
```
#### This will run your app on port 8000
```cmd
$ php artisan serve
```
- if want to change the port number for some reason use : 
```cmd
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
### I'm making these notes for future because I don't have the time to make any changes right now, and I believe I will come back to this after a month or two, and I think this will make me remember what I have done.
A Web application using  [Laravel](https://laravel.com/). The PHP Framework For Web Artisans
####  Some notes or 'Todos' :
- PHP [faker](https://github.com/fzaninotto/Faker) for generating database data for testing. :heavy_check_mark:
- [AOS ](https://michalsnik.github.io/aos/) for good animation. :heavy_check_mark:
- [JQuery](https://jquery.com/) . :heavy_check_mark:
- [Webpack](https://webpack.js.org/) & [Babel](https://babeljs.io/) for bundling and compiling [ES6](http://es6-features.org/#Constants) and [SASS](https://sass-lang.com/), of course using [Laravel Mix](https://laravel.com/docs/5.7/mix). :heavy_check_mark:
- [Materialize-css](https://materializecss.com/) for styling and making the website responsive. :heavy_check_mark:
- [Axios](https://github.com/axios/axios) A promise based HTTP client for the browser and node.js. :heavy_check_mark:
- And a little bit of [Vuejs](https://vuejs.org/). :heavy_check_mark:
- Used [particlesjs](https://vincentgarreau.com/particles.js/) . :heavy_check_mark:
- [Redis](https://redis.io/) For caching and enabling real time communication using [Pub/Sub](https://en.wikipedia.org/wiki/Publish%E2%80%93subscribe_pattern)  architecture. :heavy_multiplication_x:
* All the **CRUD** operations are in the models **(static methods)**, and the controllers are just a medium to enable interaction between requests and responses. :heavy_check_mark:
* The **Controllers** only validate the data and return what the models gave them. :heavy_check_mark:
* Almost all the JavaScript code is written in ES6, **some JQuery code only worked when I used ES5**. :heavy_check_mark:
* All The images are minified. :heavy_check_mark:
* Minify CSS and Javascript. :heavy_multiplication_x:

#### Real ' // Todos ' or Bugs :bug:
- Fix The bug in the **landing page** (welcome page), login page, and register  page **which you can't notice it the first time!**, and it won't matter but it will make the UI/UX better. :heavy_multiplication_x:
- If you have time improve on the wished posts modal **(design)** & the follow request Modal **(Performance)**. :heavy_multiplication_x:
- Implement the **Explore**, Which will take a so much Time page. :heavy_multiplication_x:
- Make the validation on the login & register uses asynchronous HTTP requests. :heavy_multiplication_x:
- Don't forget the Chat and notification, **real time** using Redis .:heavy_multiplication_x:
- Add more realistic features to the profile page. :heavy_multiplication_x:
- When the user navigate to profile => * clicks on the image * => posts,
the design here is a little bit weird and there is a bug **(the z-index bug)**. :heavy_multiplication_x:
- Implement realistic and efficient  search which could be accessed from every where. :heavy_multiplication_x:
- I believe that there is more than this   ¯\_(ツ)_/¯.

