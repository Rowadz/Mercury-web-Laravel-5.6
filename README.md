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
## **Tables**
#### **NOTE** 
> **If you just want the tables copy the below code**
> If you go to `database/SQL` you can find the same queries, **but**  with some fake data 
> download them -if you want the fake data- and import them into your database under a database called `Mercury`

* Only the `users`, `posts`, `post_images`, `tags` has fake data
* I Will keep adding fake data.

#### **keep in mind**
* I'm using `bcrypt` for the passwords.
#### `users` Table
```SQL
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `API_KEY` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `about` longtext COLLATE utf8_unicode_ci,
  `provider` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provided_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_api_key_unique` (`API_KEY`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
#### `tags` table
```SQL
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
#### `posts` Table
```SQL
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `header` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `status` enum('available','archive') COLLATE utf8_unicode_ci NOT NULL,
  `video_link` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  KEY `posts_tag_id_foreign` (`tag_id`),
  CONSTRAINT `posts_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
#### `post_images` table 
```SQL
DROP TABLE IF EXISTS `post_images`;
CREATE TABLE `post_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `location` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_images_post_id_foreign` (`post_id`),
  CONSTRAINT `post_images_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
#### `comments` table
```SQL
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `body` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_post_id_foreign` (`post_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
#### `exchange_requests` table 
``` SQL
DROP TABLE IF EXISTS `exchange_requests`;
CREATE TABLE `exchange_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL, --  who recived the request
  `owner_post_id` int(10) unsigned NOT NULL, -- the offerd Post
  `owner_id` int(10) unsigned NOT NULL, -- who sent the request
  `user_post_id` int(10) unsigned NOT NULL, -- the post for the user who recieved the request
  `status` enum('accepted','pending','removed') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exchange_requests_user_post_id_foreign` (`user_post_id`),
  KEY `exchange_requests_user_id_foreign` (`user_id`),
  KEY `exchange_requests_owner_id_foreign` (`owner_id`),
  KEY `exchange_requests_owner_post_id_foreign` (`owner_post_id`),
  CONSTRAINT `exchange_requests_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  CONSTRAINT `exchange_requests_owner_post_id_foreign` FOREIGN KEY (`owner_post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `exchange_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `exchange_requests_user_post_id_foreign` FOREIGN KEY (`user_post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

#### `followers` table
```SQL
DROP TABLE IF EXISTS `followers`;
CREATE TABLE `followers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `status` enum('pending','approved') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `followers_user_id_foreign` (`user_id`),
  KEY `followers_from_id_foreign` (`from_id`),
  CONSTRAINT `followers_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`),
  CONSTRAINT `followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

#### `messages` table
```SQL
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `body` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_user_id_foreign` (`user_id`),
  KEY `messages_from_id_foreign` (`from_id`),
  CONSTRAINT `messages_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`),
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
#### `reviews` table
``` SQL
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `header` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `value` enum('happy','sad','angry') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_from_id_foreign` (`from_id`),
  CONSTRAINT `reviews_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
#### `wishes` table
```SQL
DROP TABLE IF EXISTS `wishes`;
CREATE TABLE `wishes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishes_post_id_foreign` (`post_id`),
  KEY `wishes_user_id_foreign` (`user_id`),
  CONSTRAINT `wishes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `wishes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

#### first view
``` SQL 
CREATE VIEW users_names_for_chat AS SELECT
	DISTINCT revicer.name as revicer_name,
    revicer.id as revicer_id,
    revicer.image as revicer_image,
	sender.name as sender_name,
    sender.id as sender_id,
    sender.image as sender_image
FROM
    mercury.messages
        LEFT JOIN
    users AS revicer ON revicer.id = messages.user_id
        LEFT JOIN
    users AS sender ON sender.id = messages.from_id;
```


#### Might help you !
* to get the usres that need to be reviewed
* go to `app/ExchangeRequest => getPeopleToReview method` to see the php code ~ if you want ~
```SQL
SELECT 
    user.name as 'user_name', 
    user.id as 'user_id',
    count(reviews.id)
FROM
    mercury.exchange_requests
        INNER JOIN
    users AS user ON user.id = exchange_requests.user_id
        INNER JOIN
    users AS onwer ON onwer.id = exchange_requests.owner_id
		LEFT JOIN
	reviews ON reviews.from_id = exchange_requests.owner_id
WHERE
    onwer.id = 9
AND 
	exchange_requests.status =  'accepted'
GROUP BY user.name , user.id
having count(reviews.id) = 0
UNION 
(
SELECT 
    onwer.name as 'user_name', 
    onwer.id as 'user_id',
	count(reviews.id)
FROM
    mercury.exchange_requests
        INNER JOIN
    users AS user ON user.id = exchange_requests.user_id
        INNER JOIN
    users AS onwer ON onwer.id = exchange_requests.owner_id
		LEFT JOIN
	reviews ON reviews.user_id = exchange_requests.user_id
WHERE
    user.id = 9
AND 		
	exchange_requests.status =  'accepted'
GROUP BY onwer.name , onwer.id 
having count(reviews.id) = 0
);
```
